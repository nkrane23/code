<?php get_header(); ?>
    <div class="wrap">
        <div id="primary" class="content-area template-<?= Roxanne::template_name(); ?>">
            <main id="main" class="site-main" role="main">
                <div class="posts-wrapper">
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part('parts/single/single', get_post_type()); ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <?php get_template_part('parts/nothing/nothing');?>
                    <?php endif; ?>
                </div>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->
<?php get_footer();