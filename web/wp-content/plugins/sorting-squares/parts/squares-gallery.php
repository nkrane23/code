<?php
// The Query
$the_query = new WP_Query(
    $args = array(
        'post_type' => 'sorting-squares',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'order'   => 'DESC'
    )); ?>

<div class="sorting-squares">
    <div class="u-container-width">

        <?php if ($the_query->have_posts()) : ?>
        <div class="tiles-row">
            <?php while ($the_query->have_posts()): ?>

                <?php
                $the_query->the_post();
                $terms = get_the_terms(get_the_ID(), 'square-categories');

                $filter = '';

                if(!empty($terms)) {
					foreach ($terms as $term) {
						$filter .= $term->slug;
					}
				}
                ?>

                <div class="gutter-sizer"></div>

                <div class="single-tile <?= $filter;?>">
                    <div class="inner-wrap">
                        <figure class="effect hover-<?php the_field('hover_color');?>">
                            <?php the_post_thumbnail();?>

                            <figcaption>
                                <h2><?php the_title();?></h2>
                                <?php the_content();?>
                            </figcaption>
                        </figure>
                    </div>
                </div>

                <?php wp_reset_postdata(); ?>

            <?php endwhile; ?>
        </div>

        <?php else : // No posts ?>
            <div class="u-container-width">
                <div class="no-posts">
                    <h2>No sorting squares found!</h2>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>