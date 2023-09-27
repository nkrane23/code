<nav class="primary u-max u-flex" role="navigation">
    <?php if(have_rows('main_menu', 'option')): ?>
        <ul class="menu u-max">
            <?php while(have_rows('main_menu', 'option')): the_row(); ?>
                <?php
                $linkClasses = '';
                $linkType = '';
                $target = '';

                if (get_sub_field('use_custom_url') == true) {
                    $linkType = get_sub_field('custom_link');
                    $target = 'target="_self"';
                } else {
                    $linkType = get_sub_field('link');
                }

                if(get_row_layout() == 'simple') {
                    $no_submenu = '';
                    if(get_sub_field('use_submenu') == false) {
                        $no_submenu = 'no-submenu';
                    }
                    $linkClasses = 'menu-item u-flex u-flex-valign--mid menu-top-level-item menu-type--simple ' . $no_submenu;
                } elseif (get_row_layout() == 'fatnav') {
                    $linkClasses = 'menu-item u-flex u-flex-valign--mid menu-top-level-item menu-type--fatnav';
                }
                ?>

                <li class="<?= $linkClasses; ?>">
                    <div class="menu-item--wrapper">
                        <a href="<?= $linkType ?>" target="<?= get_sub_field('open_new_window') ? '_blank' : '_self' ?>">
                            <?= get_sub_field('link_text') ?>
                        </a>
                    </div>

                    <?php if(get_row_layout() == 'simple'): ?>
                        <?php if(get_sub_field('sub_menu')): ?>
                            <div class="menu-dropdown">
                                <?php wp_nav_menu(['menu' => get_sub_field('sub_menu')]); ?>
                            </div>
                        <?php endif; ?>

                    <?php else: ?>
                        <div class="menu-dropdown">
                            <div class="top">
                                <?php if(have_rows('columns')): ?>
                                    <div class="submenus">
                                        <?php while(have_rows('columns')): the_row(); ?>
                                            <?php if(get_sub_field('sub_menu')): ?>
                                                <?php get_template_part('parts/nav/fat-nav');?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
</nav>