<div class="u-container-width">
    <div class="row">
        <?php if( have_rows('large_column') ):?>
            <?php while ( have_rows('large_column') ) : the_row(); ?>
                <div class="builder-col col-md-8">
                    <?php get_template_part( 'builder/components-main' ); ?>
                </div>
            <?php endwhile;?>
        <?php endif;?>

        <?php if( have_rows('small_column') ):?>
            <?php while ( have_rows('small_column') ) : the_row(); ?>
                <div class="builder-col col-md-4">
                    <?php get_template_part( 'builder/components-main' ); ?>
                </div>
            <?php endwhile;?>
        <?php endif;?>
    </div>
</div>