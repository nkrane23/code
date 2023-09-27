<?php if(get_sub_field('use_carousel_effect') == true) : ?>
<div class="u-container-width">
    <div class="slider-wrapper">
        <div class="owl-carousel icons-slider">
            <?php if( have_rows('single_icon') ): ?>
                <?php while ( have_rows('single_icon') ) : the_row(); ?>
                    <?php $img = get_sub_field('icon'); ?>
                    <div class="single-icon">
                        <div class="img-container"
                             style="background-image: url('<?= $img['url'];?>');">
                            <img src="https://placehold.it/155x90" style="visibility: hidden;">
                        </div>
                    </div>
                <?php endwhile;?>
            <?php endif;?>
        </div>

        <div class="custom-nav owl-nav"></div>
    </div>
</div>

<?php else : ?>
    <div class="u-container-width">
        <?php if( have_rows('single_icon') ): ?>
            <div class="icons-flexed-row">
                <?php while ( have_rows('single_icon') ) : the_row(); ?>
                    <div class="single-icon">
                        <?php $img = get_sub_field('icon'); ?>
                        <?= Roxanne::srcsetImg($img['ID']);?>
                    </div>
                <?php endwhile;?>
            </div>
        <?php endif;?>
    </div>
<?php endif;?>