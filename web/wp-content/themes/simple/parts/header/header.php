<header>
    <div class="header-wrap main">
        <div class="sidebar">
            <?php get_template_part('parts/logo/logo'); ?>

            <nav>
				<?php wp_nav_menu(array('theme_location' => 'main-nav')); ?>
            </nav>

            <?php get_template_part('parts/site/social-icons');?>

            <button class="hamburger hamburger--spring js-hamburger" type="button" aria-label="mobile-menu">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>

    <div id="menu-wrapper" class="mobile-nav" role="navigation">
        <?php wp_nav_menu(array('theme_location' => 'main-nav')); ?>

        <?php get_template_part('parts/site/social-icons');?>
    </div>
</header>