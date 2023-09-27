<div class="u-container-width">
    <div class="card-wrap animate__animated animate__fadeInRight">
        <div class="background-image">
            <?= Roxanne::progressiveImage(get_sub_field('background_image'));?>
        </div>

        <div class="flexed-row">
            <div class="right-half">

                <div class="title-wrap">
                    <h2 class="animate__animated animate__fadeInDown"><?php the_sub_field('intro_line');?></h2>

                    <?php if( have_rows('animated_lines') ): ?>
                        <div class="animated-lines">
                            <?php while ( have_rows('animated_lines') ) : the_row(); ?>
                                <h4 class="animate__animated <?php the_sub_field('animation_style');?>">
                                    <?php the_sub_field('single_line');?>
                                </h4>
                            <?php endwhile;?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>