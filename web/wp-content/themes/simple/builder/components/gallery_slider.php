<?php if( have_rows('single_image') ): ?>
    <div class="builder-component-gallery-slider">
        <div class="main-slideshow">
            <?php while ( have_rows('single_image') ) : the_row(); ?>
                <div class="slide-image">
                    <div class="inner-wrapper">
                        <?= Roxanne::progressiveImage(get_sub_field('image'));?>

                        <?php if(get_sub_field('caption')):?>
                            <div class="caption-wrap">
                                <?php the_sub_field('caption');?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            <?php endwhile;?>
        </div>
    </div>
<?php endif;?>