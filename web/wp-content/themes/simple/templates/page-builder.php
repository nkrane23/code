<?php
/**
 * Template Name: Page Builder
 **/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php if( have_rows('page_builder') ):?>
            <?php while ( have_rows('page_builder') ) : the_row(); ?>

                <section class="builder-section <?= classes();?>" style="<?= styles();?>" <?php sec_ID();?>>
                    <?php jump_link();?>
                    <?php if( have_rows('layout') ):?>
                        <?php while ( have_rows('layout') ) : the_row(); ?>
                            <?php include get_template_directory() . '/builder/builder-layouts.php';?>
                        <?php endwhile;?>
                    <?php endif;?>
                </section>

            <?php endwhile;?>
        <?php endif;?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();