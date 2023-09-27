<div class="u-container-width">
    <div class="row">
        <?php if( have_rows('1st_column') ):?>
            <?php while ( have_rows('1st_column') ) : the_row(); ?>
                <div class="builder-col col-md-3">
                    <?php get_template_part( 'builder/components-main' ); ?>
                </div>
            <?php endwhile;?>
        <?php endif;?>

        <?php if( have_rows('2nd_column') ):?>
            <?php while ( have_rows('2nd_column') ) : the_row(); ?>
                <div class="builder-col col-md-3">
                    <?php get_template_part( 'builder/components-main' ); ?>
                </div>
            <?php endwhile;?>
        <?php endif;?>

        <?php if( have_rows('3rd_column') ):?>
            <?php while ( have_rows('3rd_column') ) : the_row(); ?>
                <div class="builder-col col-md-3">
                    <?php get_template_part( 'builder/components-main' ); ?>
                </div>
            <?php endwhile;?>
        <?php endif;?>

        <?php if( have_rows('4th_column') ):?>
            <?php while ( have_rows('4th_column') ) : the_row(); ?>
                <div class="builder-col col-md-3">
                    <?php get_template_part( 'builder/components-main' ); ?>
                </div>
            <?php endwhile;?>
        <?php endif;?>
    </div>
</div>