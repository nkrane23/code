<?php
$pathmap = [
    'one_column' => 'builder/slider/columns/one-column',
    'two_column' => 'builder/slider/columns/two-column'
];

$class = 'slider-layout-' . str_replace('_', '-', get_row_layout());
?>

<?php if (isset($pathmap[get_row_layout()])): ?>
    <div class="builder-layout <?= $class ?>">
        <?php get_template_part( $pathmap[get_row_layout()] ); ?>
    </div>
<?php else : ?>
    <?php get_template_part('parts/error'); ?>
<?php endif; ?>