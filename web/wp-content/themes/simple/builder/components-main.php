<?php

$c_path = [
    'wysiwyg' => 'builder/components/wysiwyg',
    'title' => 'builder/components/title',
    'image' => 'builder/components/image',
    'button' => 'builder/components/button',
    'spacer' => 'builder/components/spacer',
    'html' => 'builder/components/html',
    'horizontal_buttons' => 'builder/components/horizontal_buttons',
    'jump_link' => 'builder/components/jump_link',
    'accordion' => 'builder/components/accordion',
    'gallery_slider' => 'builder/components/gallery_slider'
];
?>
<?php if( have_rows('components') ):?>
    <?php while ( have_rows('components') ) : the_row(); ?>
        <?php if (isset($c_path[get_row_layout()])): ?>
            <?php get_template_part( $c_path[get_row_layout()] ); ?>
        <?php else : ?>
            <?php get_template_part('builder/error'); ?>
        <?php endif; ?>
    <?php endwhile;?>
<?php endif;