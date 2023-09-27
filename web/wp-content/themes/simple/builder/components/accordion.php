<?php if( have_rows('single_accordion') ): ?>
    <?php while ( have_rows('single_accordion') ) : the_row(); ?>
        <div class="builder-component builder-component-single-accordion">
            <div class="acc-header">
                <h2><?php the_sub_field('title');?></h2>
            </div>

            <div class="acc-content">
                <?php the_sub_field('content');?>
            </div>
        </div>
    <?php endwhile;?>
<?php endif;?>