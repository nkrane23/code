<?php

$c_path = [
    'wysiwyg' => 'builder/components/wysiwyg',
    'title'   => 'builder/components/title',
    'image'   => 'builder/components/image',
    'button'  => 'builder/components/button',
    'spacer'  => 'builder/components/spacer'
];
?>

<?php if (have_rows('block_components')): ?>
    <?php while (have_rows('block_components')) : the_row(); ?>
        <?php if (isset($c_path[get_row_layout()])): ?>
            <?php get_template_part($c_path[get_row_layout()]); ?>
        <?php else : ?>
            <?php get_template_part('parts/error'); ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>