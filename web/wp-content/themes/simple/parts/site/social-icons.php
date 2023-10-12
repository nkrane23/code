<div class="social-icons">
	<?php if(get_field('instagram_link', 'option')):?>
        <div class="instagram">
            <a href="<?php the_field('instagram_link', 'option');?>" target="_blank" aria-label="Instagram">
                <img src="<?= get_template_directory_uri();?>/images/instagram-logo.webp" alt="Instagram">
            </a>
        </div>
	<?php endif;?>

	<?php if(get_field('linkedin_link', 'option')):?>
        <div class="linkedin">
            <a href="<?php the_field('linkedin_link', 'option');?>" target="_blank" aria-label="LinkedIn">
                <img src="<?= get_template_directory_uri();?>/images/linkedin-logo.webp" alt="LinkedIn">
            </a>
        </div>
	<?php endif;?>

	<?php if(get_field('pdf_link', 'option')):?>
        <div class="pdf">
            <a href="<?php the_field('pdf_link', 'option');?>" target="_blank" aria-label="PDF Resume">
                <img src="<?= get_template_directory_uri();?>/images/pdf-logo.webp" alt="PDF Resume">
            </a>
        </div>
	<?php endif;?>
</div>