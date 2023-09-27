<div class="u-container-width">
    <div class="no-posts">
        <?php if(is_category()): ?>
            <h2>Sorry, but there aren't any posts in the <?php echo single_cat_title('', false); ?> category yet.</h2>
        <?php elseif(is_date()): ?>
            <h2>Sorry, but there aren't any posts in this date range.</h2>
        <?php elseif(is_author()): ?>
            <h2>Sorry, but there aren't any posts by this author yet.</h2>
        <?php else: ?>
            <h2>No posts found.</h2>
        <?php endif; ?>
        <?php get_search_form(); ?>
    </div>
</div>