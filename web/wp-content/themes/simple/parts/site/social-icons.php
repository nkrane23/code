<div class="social-icons">
    <?php if(get_field('instagram_link', 'option')):?>
        <a href="<?php the_field('instagram_link', 'option');?>" target="_blank" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
        </a>
    <?php endif;?>

    <?php if(get_field('linkedin_link', 'option')):?>
        <a href="<?php the_field('linkedin_link', 'option');?>" target="_blank" aria-label="LinkedIn">
            <i class="fab fa-linkedin"></i>
        </a>
    <?php endif;?>

    <?php if(get_field('pdf_link', 'option')):?>
        <a href="<?php the_field('pdf_link', 'option');?>" target="_blank" aria-label="PDF Resume">
            <i class="far fa-file-pdf"></i>
        </a>
    <?php endif;?>
</div>