<div class="u-container-width-nope">
    <?php if( have_rows('packery_item') ): ?>
        <div class="packery-row">
            <?php while ( have_rows('packery_item') ) : the_row(); ?>
                <div class="gutter-sizer"></div>
                <div class="packery-item">
                    <div class="image-wrap">
                        <div class="image-area"
                             style="background-image: url('<?php the_sub_field('image');?>');"></div>
                    </div>

                    <div class="overlay">
                        <div class="inner-wrap">
                            <h3 class="animate__animated animate__fadeInDown"><?php the_sub_field('heading');?></h3>
                            <div class="line"></div>
                            <h4 class="animate__animated animate__fadeInUp"><?php the_sub_field('sub_heading');?></h4>
                        </div>
                    </div>

                </div>
            <?php endwhile;?>
        </div>
    <?php endif;?>
</div>