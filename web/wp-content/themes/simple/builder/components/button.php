<?php
    $link = get_sub_field('link');
    $custom = get_sub_field('allow_external_links');
    $link_type = get_sub_field('link_type');

    if( $custom == true) {
        $link = get_sub_field('url');
    } elseif ($custom == false && $link_type == false) {
        $link = get_sub_field('link');
    } elseif ($custom == false && $link_type == true) {
        $link = get_term_link(get_sub_field('category_link'));
    }

    $anchor = '#' . get_sub_field('url');
    //$scroll = 'data-scroll="' . $anchor . '"';
?>

<div <?= btn_classes();?> <?= btn_opts();?>>
    <?php if(get_sub_field('enable_anchor')): ?>
        <a href="<?= $anchor;?>"
           class="<?= the_sub_field('style');?>">
            <?php the_sub_field('text');?>
        </a>

    <?php else : ?>
        <a href="<?= $link;?>"
           class="<?= the_sub_field('style');?>"
           target="<?= get_sub_field('open_in_new_window') ? '_blank' : '_self'; ?>">
            <span><?php the_sub_field('text');?></span>
        </a>
    <?php endif; ?>
</div>
