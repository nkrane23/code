<?php
class Roxanne {
    static function progressiveImage($id, $manual_color = null, $args = []) {
        $wpImageData = (object)wp_get_attachment_metadata($id);
        $uploadsDir = (object)wp_get_upload_dir();

        $imagePath = $uploadsDir->basedir . '/' . $wpImageData->file;

        $fullImage = $smallImage = $mediumImage = $largeImage = (object)[
            'src' => $uploadsDir->baseurl . '/' . $wpImageData->file,
            'width' => $wpImageData->width,
            'height' => $wpImageData->height
        ];

        if (isset($wpImageData->sizes['medium'])) {
            $imagePath = $uploadsDir->basedir . '/' . dirname($wpImageData->file) . '/' . $wpImageData->sizes['medium']['file'];
            $smallImage = (object)[
                'src' => $uploadsDir->baseurl . '/' . dirname($wpImageData->file) . '/' . $wpImageData->sizes['medium']['file'],
                'width' => $wpImageData->sizes['medium']['width'],
                'height' => $wpImageData->sizes['medium']['height']
            ];
        }

        if (isset($wpImageData->sizes['medium-large'])) {
            $mediumImage = (object)[
                'src' => $uploadsDir->baseurl . '/' . dirname($wpImageData->file) . '/' . $wpImageData->sizes['medium-large']['file'],
                'width' => $wpImageData->sizes['medium-large']['width'],
                'height' => $wpImageData->sizes['medium-large']['height']
            ];
        }

        if (isset($wpImageData->sizes['large'])) {
            $largeImage = (object)[
                'src' => $uploadsDir->baseurl . '/' . dirname($wpImageData->file) . '/' . $wpImageData->sizes['large']['file'],
                'width' => $wpImageData->sizes['large']['width'],
                'height' => $wpImageData->sizes['large']['height']
            ];
        }

        $gdImage = false;
        $color = '#eaeaea';

        // Only find aggregate color if no manual color is specified
        if (is_null($manual_color)) {
            // If image exists locally, pick between supported formats
            if (file_exists($imagePath)) {
                if (get_post_mime_type($id) == 'image/png') {
                    $gdImage = imagecreatefrompng($imagePath);
                } elseif (get_post_mime_type($id) == 'image/jpeg') {
                    $gdImage = imagecreatefromjpeg($imagePath);
                }
            }

            // Find primary color of image
            if ($gdImage) {
                $tempImage = imagecreatetruecolor(1, 1);

                // Fill with white, this seems to effect how images with transparent backgrounds are handled - providing a better color.
                imagefill($tempImage, 0, 0, imagecolorallocate($tempImage, 255, 255, 255));

                imagecopyresampled($tempImage, $gdImage, 0, 0, 0, 0, 1, 1, imagesx($gdImage), imagesy($gdImage));

                $color = sprintf('#%06s', strtoupper(dechex(imagecolorat($tempImage, 0, 0))));

                imagedestroy($tempImage);
            }
        } else {
            $color = $manual_color;
        }

        // Create small transparent placeholder with same width:height ratio of main image

        // Find ratio using greatest common denominator progressiveImage
        if (function_exists('gmp_gcd')) {
            $gcd = gmp_strval(gmp_gcd($wpImageData->width, $wpImageData->height));
        } else {
            $gcd = static::gcd($wpImageData->width, $wpImageData->height);
        }

        // Use GCD to create as small an image as possible to send to the client
        $placeholder = imagecreatetruecolor($wpImageData->width / $gcd, $wpImageData->height / $gcd);
        imagesavealpha($placeholder, true);
        imagefill($placeholder, 0, 0, imagecolorallocatealpha($placeholder, 0, 0, 0, 127));

        ob_start();
        imagepng($placeholder);
        $src = base64_encode(ob_get_clean());
        imagedestroy($placeholder);

        // Set alt attribute automatically if not provided
        if (empty($args['alt'])) {
            $alt = get_post_meta($id, '_wp_attachment_image_alt', true);

            if (empty($alt)) {
                $alt = ucwords(str_replace('_', ' ', str_replace('-', ' ', get_the_title($id))));
            }

            $args['alt'] = $alt;
        }

        $extra_args = '';

        foreach ($args as $name => $value) {
            $extra_args .= "{$name}='{$value}' ";
        }

        $extra_args = rtrim($extra_args);

        // Organize everything into an object for filtering and ease of use
        $image = (object)[
            'id' => $id,
            'color' => $color,
            'full' => $fullImage,
            'large' => $largeImage,
            'medium' => $mediumImage,
            'small' => $smallImage,
            'src' => $src,
            'gcd' => $gcd,
            'args' => (object)[
                'raw' => $args,
                'rendered' => $extra_args
            ]
        ];

        return
            "<div class='the-progressive-image' style='background-color: {$image->color};' data-full='" . json_encode($image->full) . "' data-large='" . json_encode($image->large) . "' data-med='" . json_encode($image->medium) . "' data-small='" . json_encode($image->small) . "'>" .
            "<img src='data:image/png;base64,{$image->src}' width='{$image->full->width}' height='{$image->full->height}' {$image->args->rendered} />" .
            "</div>";
    }

    /**
     * Fallback greatest common denominator function, if GMP extension is not available
     *
     * @param $a
     * @param $b
     *
     * @return mixed
     */
    static protected function gcd($a, $b) {
        return $b ? static::gcd($b, $a % $b) : $a;
    }

    public static function src($id, $size = "medium") {
        $image = wp_get_attachment_image_src($id, $size);
        return $image[0];
    }

    public static function srcsetImg($id, $img_atts = '', $sizes = array()) {
        // Might add check for SVG to auto set minimum size?
        // $image_ext = wp_check_filetype($img[0]);
        //
        // if($image_ext['ext'] == 'svg') {
        // return "<img {$img_atts} src='{$img[0]}' width='80' />";
        // } else {

        $srcset = wp_get_attachment_image_srcset($id, 'full');
        $img = wp_get_attachment_image_src($id, 'full');

        $default_sizes = array(
            'full' => "1200px",
            'large' => "768px",
            'medium_large' => "300px",
            //'medium_large' => "500px",
            'medium' => "0px"
        );

        if (strpos($img_atts, 'alt=') === false) {
            $alt = self::img_alt_text($id);
            $img_atts .= " alt='{$alt}'";
        }

        if ($srcset) {
            $img_sizes = '';

            foreach (self::array_merge_recursive_distinct($default_sizes, $sizes) as $size => $max_width) {
                $data = wp_get_attachment_image_src($id, $size);
                $img_sizes .= "(min-width: {$max_width}) {$data[1]}px, ";
            }

            $img_sizes .= '100vw';

            return "<img {$img_atts} src='{$img[0]}' width='{$img[1]}' height='{$img[2]}' srcset='{$srcset}' sizes='{$img_sizes}' />";
        } else {
            return "<img {$img_atts} src='{$img[0]}' width='{$img[1]}' height='{$img[2]}' />";
        }
    }

    public static function img_alt_text($id) {
        $alt = get_post_meta($id, '_wp_attachment_image_alt', true);

        if (empty($alt)) {
            $alt = get_the_title($id);
        }

        return $alt;
    }

    /**
     * array_merge_recursive does indeed merge arrays, but it converts values with duplicate
     * keys to arrays rather than overwriting the value in the first array with the duplicate
     * value in the second array, as array_merge does. I.e., with array_merge_recursive,
     * this happens (documented behavior):
     *
     * array_merge_recursive(array('key' => 'org value'), array('key' => 'new value'));
     *     => array('key' => array('org value', 'new value'));
     *
     * array_merge_recursive_distinct does not change the datatypes of the values in the arrays.
     * Matching keys' values in the second array overwrite those in the first array, as is the
     * case with array_merge, i.e.:
     *
     * array_merge_recursive_distinct(array('key' => 'org value'), array('key' => 'new value'));
     *     => array('key' => array('new value'));
     *
     * Parameters are passed by reference, though only for performance reasons. They're not
     * altered by this function.
     *
     * @param array $array1
     * @param array $array2
     * @return array
     * @author Daniel <daniel (at) danielsmedegaardbuus (dot) dk>
     * @author Gabriel Sobrinho <gabriel (dot) sobrinho (at) gmail (dot) com>
     */
    public static function array_merge_recursive_distinct(array &$array1, array &$array2) {
        $merged = $array1;

        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset ($merged [$key]) && is_array($merged [$key])) {
                $merged [$key] = static::array_merge_recursive_distinct($merged [$key], $value);
            } else {
                $merged [$key] = $value;
            }
        }

        return $merged;
    }

    public static function template_name() {
        $template = 'page';

        if (is_home()) {
            $template = 'index';
        } elseif (is_author()) {
            $template = 'author';
        } elseif (is_post_type_archive()) {
            $template = 'archive-' . get_query_var('post_type');
        } elseif (is_tax()) {
            $template = 'archive-' . get_query_var('taxonomy');
        } elseif (is_archive()) {
            $template = 'archive';
        } elseif (is_404()) {
            $template = '404';
        } elseif (is_singular() && !is_page()) {
            $template = get_post_type();
        } else {
            $template = str_replace('.php', '', basename(get_page_template()));
        }

        return apply_filters('theme_template_name', $template);
    }

    public static function pagination($options = array(), \WP_Query $query = null) {
        global $wp_query, $wp_rewrite;

        if (is_null($query)) {
            $query = $wp_query;
        }

        $current = get_query_var('paged') > 1 ? get_query_var('paged') : 1;

        $pagination = array_merge(array(
            'base' => add_query_arg('paged', '%#%'),
            'current' => $current,
            'total' => $query->max_num_pages,
            'type' => 'list',
            'end_size' => 2,
            'mid_size' => 2,
            'prev_text' => 'Previous',
            'next_text' => '→'
        ), $options);

        if ($wp_rewrite->using_permalinks() && empty($options['base'])) {
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
        }

        if (!empty($wp_query->query_vars['s'])) {
            $pagination['add_args'] = array('s' => get_query_var('s'));
        }

        echo paginate_links($pagination);
    }

    public static function the_page_title() {
        if (is_category()) {
            single_cat_title();
        } elseif (is_tag()) {
            single_tag_title();
        } elseif (is_author()) {
            echo 'Posts by ' . get_the_author();
        } elseif (is_tax()) {
            single_term_title();
        } elseif (is_search()) {
            echo apply_filters('theme_search_title', 'Search Results');
        } elseif (is_post_type_archive()) {
            post_type_archive_title();
        } elseif (is_home()) {
            echo get_the_title(get_option('page_for_posts'));
        } else {
            the_title();
        }
    }

    /**
     * Returns the slug of the current page, if the page is an automatically generated page
     * the slug will be the name of the template that is generating it (such as "archive", "index", etc).
     * @api
     * @return string
     * @filter theme_page_slug
     */
    public static function page_slug() {
        global $post;
        $slug = '';

        if(is_home()) {
            $slug = 'index';
        } elseif(is_author()) {
            $slug = 'author';
        } elseif(is_post_type_archive()) {
            $slug = 'archive-'.get_query_var('post_type');
        } elseif (is_tax()) {
            $slug = 'archive-'.get_query_var('taxonomy');
        } elseif(is_archive()) {
            $slug = 'archive';
        } elseif(is_404()) {
            $slug = '404';
        } elseif(is_search()) {
            $slug = 'search';
        } else {
            $slug = $post->post_name;
        }

        return apply_filters('theme_page_slug', $slug);
    }
}