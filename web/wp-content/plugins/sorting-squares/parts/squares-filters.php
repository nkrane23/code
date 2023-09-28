<div class="u-container-width">
    <div class="sort-btns">
        <button class="all waves-effect waves-light is-checked" data-filter="*">All</button>

        <?php
        $terms = get_terms(array(
            'taxonomy' => 'square-categories',
            'hide_empty' => true,
        ));

        foreach ($terms as $term) :
            $squares = get_posts(array(
                'post_type' => 'sorting-squares',
                'numberposts' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'square-categories',
                        'field' => 'id',
                        'terms' => $term->term_id,
                        'include_children' => false
                    )
                )
            )); ?>
            <button class="waves-effect waves-light" data-filter=".<?= $term->slug; ?>"><?= $term->name; ?></button>
        <?php endforeach; ?>
    </div>
</div>