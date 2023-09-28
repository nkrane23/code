<div class="builder-layout parallax-container" style="min-height:<?php the_sub_field('window_height');?>px;">
    <?php if (get_sub_field('use_overlay')) :
        $style = 'style="background-color: ' . get_sub_field('overlay_color') . ';"'; ?>
        <div class="overlay" <?= $style ;?>></div>
    <?php endif;?>

    <div class="parallax">
        <img class="pos-<?php the_sub_field('bottom_position');?>" src="<?= get_sub_field('background_image')['url'];?>"
        alt="<?= get_sub_field('background_image')['title'];?>">
    </div>

    <div class="content-wrap">
        <div class="builder-col">
            <?php if( have_rows('column') ):?>
                <div class="container-fluid">
                    <?php while ( have_rows('column') ) : the_row(); ?>
                        <?php get_template_part( 'builder/components-main' ); ?>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>