<?php if( have_rows('column') ):?>
    <div class="u-container-width">
        <div class="row">
            <?php while ( have_rows('column') ) : the_row(); ?>
                <div class="builder-col col-md-12">
                    <?php get_template_part( 'builder/slider/slider-components' ); ?>
                </div>
            <?php endwhile;?>
        </div>
    </div>
<?php endif;?>