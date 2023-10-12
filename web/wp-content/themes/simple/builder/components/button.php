<?php
$link = '';

if( get_sub_field('allow_external_links') ) {
	$link = get_sub_field('url');
} elseif (!get_sub_field('allow_external_links')) {
	$link = get_sub_field('link');
}
?>

<div class="builder-component builder-component-button" style="text-align: <?php the_sub_field('alignment');?>">
    <a href="<?= $link;?>"
       class="<?= the_sub_field('style');?>"
       target="<?= get_sub_field('open_in_new_window') ? '_blank' : '_self'; ?>">
        <span><?php the_sub_field('text');?></span>
    </a>
</div>