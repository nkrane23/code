<?php
$post_object = get_sub_field('slider_select');

if( $post_object ):
    // override $post
    global $post;
    $post = $post_object;
    setup_postdata( $post ); ?>

    <div class="cycle-slideshow"
         data-cycle-fx="scrollHorz"
         data-cycle-timeout="6000"
         data-cycle-swipe="true"
         data-cycle-pause-on-hover="true"
         data-cycle-slides="> .single-slide">

        <?php if(get_sub_field('use_arrows') == true): ?>
            <div class="cycle-prev"><i class="fas fa-chevron-left"></i></div>
            <div class="cycle-next"><i class="fas fa-chevron-right"></i></div>
        <?php endif;?>

        <?php if( have_rows('block_builder') ): ?>
            <?php while ( have_rows('block_builder') ) : the_row(); ?>
                <?php
                $bg_image = 'background-image:url('.get_sub_field("background_image").');';
                $bg_position = 'background-position: '.get_sub_field("background_position").';';
                $bg_color = 'background-color: ' .get_sub_field("background_color").';';
                $bg_options = 'style="' . $bg_color . $bg_image . $bg_position . '"';
                $col_align = 'slide-col-align-' . get_sub_field('col_align');
                $slide_top_padding = ' slide-padding-top-' . get_sub_field('slide_padding_top');
                $slide_bottom_padding = ' slide-padding-bottom-' . get_sub_field('slide_padding_bottom');

                $classes = $col_align . $slide_top_padding . $slide_bottom_padding;
                ?>

                <div class="single-slide <?= $classes;?>" <?= $bg_options;?>>
                    <div class="inner-slide equal style-<?php the_sub_field('font_theme');?>">
                        <?php if( have_rows('content') ): ?>
                            <?php while ( have_rows('content') ) : the_row(); ?>
                                <?php include get_template_directory() . '/builder/slider/slider-layouts.php';?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php if(get_sub_field('use_pagers') == true): ?>
            <div class="cycle-pager"></div>
        <?php endif;?>
    </div>

    <?php wp_reset_postdata();?>
<?php endif; ?>