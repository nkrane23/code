(function ($) {
    $(document).ready(function() {
        $('.sorting-squares .single-tile .inner-wrap').show();

        // init Isotope
        var $grid_filter = $('.sorting-squares .tiles-row').isotope({
            itemSelector: '.single-tile',
            layoutMode: 'packery',
            packery: {
                gutter: '.gutter-sizer'
            },
        });

        if($grid_filter.length >= 1) {

            $(window).load(function() {
                $grid_filter.isotope('layout');
            });
        }

        // bind filter button click
        $('.sort-btns').on( 'click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid_filter.isotope({ filter: filterValue });
        });

        // change is-checked class on buttons
        $('.sort-btns').each( function(i, buttonGroup) {
            var $buttonGroup = $(buttonGroup);
            $buttonGroup.on( 'click', 'button', function() {
                $buttonGroup.find('.is-checked').removeClass('is-checked');
                $(this).addClass('is-checked');
            });
        });
    });
})(jQuery);