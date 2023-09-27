<?php
    $tag = get_sub_field('style');

    $align = get_sub_field('alignment');

    $class = get_sub_field('custom_class');
?>

<div class="builder-component builder-component-title <?= $class; ?>" style="text-align: <?= $align;?>;">
    <<?= $tag;?> class="col-title">
        <?= the_sub_field('text');?>
    </<?= $tag;?>>
</div>