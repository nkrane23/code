<div class="u-container-width">
    <div class="row">
        <?php if( have_rows('left_column') ):?>
            <?php while ( have_rows('left_column') ) : the_row(); ?>
                <div class="builder-col col-md-6">
                    <?php get_template_part( 'builder/slider/slider-components' ); ?>
                </div>
            <?php endwhile;?>
        <?php endif;?>

        <?php if( have_rows('right_column') ):?>
            <?php while ( have_rows('right_column') ) : the_row(); ?>
                <div class="builder-col col-md-6">
                    <?php get_template_part( 'builder/slider/slider-components' ); ?>
                </div>
            <?php endwhile;?>
        <?php endif;?>
    </div>
</div>