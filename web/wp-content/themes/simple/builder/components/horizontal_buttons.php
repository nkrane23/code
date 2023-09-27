<?php $align = 'align-' . get_sub_field('alignment'); ?>
<div class="builder-component builder-component-horizontal-buttons">
    <?php if( have_rows('single_button') ): ?>
        <div class="buttons-row <?= $align;?>">
            <?php while ( have_rows('single_button') ) : the_row(); ?>
                <?php
                $link = get_sub_field('link');
                $custom = get_sub_field('allow_external_links');
                $link_type = get_sub_field('link_type');

                if( $custom == true) {
                    $link = get_sub_field('url');
                } elseif ($custom == false && $link_type == false) {
                    $link = get_sub_field('page_link');
                } elseif ($custom == false && $link_type == true) {
                    $link = get_term_link(get_sub_field('category_link'));
                } ?>

                <div class="single-button">
                    <a href="<?= $link;?>"
                       class="<?= the_sub_field('style');?>"
                       target="<?= get_sub_field('open_in_new_window') ? '_blank' : '_self'; ?>">
                        <?php the_sub_field('text');?>
                    </a>
                </div>
            <?php endwhile;?>
        </div>
    <?php endif;?>
</div>