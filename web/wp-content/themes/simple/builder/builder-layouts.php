<?php

$pathmap = [
    'one_column'        => 'builder/columns/one-column',
    'two_column'        => 'builder/columns/two-column',
    'three_column'      => 'builder/columns/three-column',
    'four_column'       => 'builder/columns/four-column',
    'one_third_column'  => 'builder/columns/one-third-column',
    'two_thirds_column' => 'builder/columns/two-thirds-column',
    'spacer'            => 'builder/layouts/spacer',
    'icons_row'         => 'builder/layouts/icons-row',
    'slider'            => 'builder/layouts/slider',
    'accordion'         => 'builder/layouts/accordion',
    'banner_card'       => 'builder/layouts/banner-card',
    'hover_gallery'     => 'builder/layouts/hover-gallery',
    'packery_gallery'   => 'builder/layouts/packery-gallery',
    'parallax_section'  => 'builder/layouts/parallax'
];

$class = 'builder-layout-' . str_replace('_', '-', get_row_layout());
?>

<?php if (isset($pathmap[get_row_layout()])): ?>
    <div class="builder-layout <?= $class ?>">
        <?php get_template_part( $pathmap[get_row_layout()] ); ?>
    </div>
<?php else : ?>
    <?php get_template_part('builder/error'); ?>
<?php endif; ?>