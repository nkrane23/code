<?php
$width = get_sub_field('width') ? ('width: '.get_sub_field('width').'px;') : '';
$height = get_sub_field('height') ? ('height: '.get_sub_field('height').'px;') : '';

if(!empty($height) && get_sub_field('sizing') === 'normal') {
    $height = 'max-'.$height;
}

$sizing = get_sub_field('sizing');
$class = get_sub_field('custom_class');
$options = $sizing . ' ' . $class;
$image_data = get_sub_field('image');

$link_type = get_sub_field('link_type');
$link = '';
$target = '';

if ($link_type == true) {
    $link = get_sub_field('url');
    $target = 'target="_blank"';
} elseif ($link_type == false) {
    $link = get_sub_field('page_link');
} ?>
<div class="builder-component builder-component-image <?= $options;?>">
    <?php if($link != ''): ?>
        <a href="<?= $link;?>" <?= $target;?>>
            <div class="image-container" style="<?= $width.$height ?>">
                <?= Roxanne::srcsetImg($image_data['ID']);?>
            </div>
        </a>
    <?php else: ?>
        <div class="image-container" style="<?= $width.$height ?>">
            <?= Roxanne::srcsetImg($image_data['ID']);?>
        </div>
    <?php endif;?>
</div>