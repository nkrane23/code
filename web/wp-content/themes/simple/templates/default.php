<?php
/**
 * @package WordPress
 * @subpackage simple
 *
 * This is the default WordPress template - unless otherwise edited, this
 * is compatible with the OnePager template. This is loaded via page.php
 * by default.
 */
get_header(); ?>
<?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>
        <div class="content-area">
            <div class="u-container-width">
                <?php the_content();?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer();