<?php if(get_sub_field('use_filter') == true):?>
<div class="u-container-width">
    <div class="sort-btns">
        <button class="all waves-effect waves-light is-checked" data-filter="*">All</button>
        <button class="one waves-effect waves-light" data-filter=".one">Languages</button>
        <button class="two waves-effect waves-light" data-filter=".two">Libraries/Frameworks</button>
        <button class="three waves-effect waves-light" data-filter=".three">CMS/Plugins</button>
        <button class="four waves-effect waves-light" data-filter=".four">Software</button>
        <button class="five waves-effect waves-light" data-filter=".five">Services</button>
    </div>
</div>
<?php endif;?>

<div class="u-container-width">
    <?php if( have_rows('single_hover_item') ): ?>
        <div class="tiles-row">
            <?php while ( have_rows('single_hover_item') ) : the_row(); ?>
                <div class="gutter-sizer"></div>

                <div class="single-tile <?php the_sub_field('tile_category');?>">
                    <div class="inner-wrap">
                        <figure class="effect-layla hover-<?= the_sub_field('hover_color');?>">
                            <img src="<?php the_sub_field('image');?>" alt="Image">

                            <figcaption>
                                <h2><?php the_sub_field('heading');?></h2>
                                <p><?php the_sub_field('description');?></p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            <?php endwhile;?>
        </div><!--/. flex-row -->
    <?php endif;?>
</div><!-- container-->