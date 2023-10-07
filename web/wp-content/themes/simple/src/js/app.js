require("./lib/waypoints/waypoint");
require("./lib/waypoints/group");
require("./lib/waypoints/context");
require("./lib/waypoints/adapters/jquery");
require("./lib/waypoints/shortcuts/inview");

const project = require('../../settings');
const utils = require('./lib/even-height');

/* Event Handlers */
(function ($) {
    const viewportWidth = window.innerWidth;

    if (viewportWidth < 991) {
        const $header = $('.header-wrap');
        const $clone = $header.clone().addClass("clone").removeClass('main');
        $header.before($clone);

        $(window).on('scroll', function() {
            const scroll = $(window).scrollTop();
            const $target = $header.height();

            if (scroll >= $target) {
                $clone.addClass('sticky');
                $header.addClass('u-hidden');
            } else if (scroll <= $target) {
                $clone.removeClass('sticky');
                $header.removeClass('u-hidden');
            }
        });

        $('.header-wrap button.hamburger').on('click', function () {
            const $button = $('button.hamburger');
            const $menu = $('.mobile-nav');

            $button.toggleClass('is-active');

            $menu.slideToggle({
                duration: 250,
                progress: function () {
                    $(window).trigger('resize');
                }
            });
        });
    }

    function ScrollToHash(hash, child, offset, speed) {
        offset = offset || 0;
        hash = encodeURIComponent(hash.replace('#', ''));
        speed = speed || 800;
        let element = $('[data-scroll="' + hash + '"]');

        if (child && $(element).find(child).length > 0) {
            element = $(element).find(child);
        }

        if ($(element).length > 0) {
            if (!element.hasClass('recent-scroll')) {
                element.addClass('scroll-target').addClass('recent-scroll');
            }

            $('html, body').animate({
                scrollTop: (
                    element.offset().top - (200 + offset)
                )
            }, {
                complete: function () {
                    setTimeout(function () {
                        element.removeClass('scroll-target');
                    }, 500);

                    setTimeout(function () {
                        element.removeClass('recent-scroll');
                    }, 5000);
                }
            }, speed);
            return true;
        }

        return false;
    }

    const scroll_offset = -80;
    const scroll_speed = 1000;

    if (location.hash) {
        $(window).load(function () {
            ScrollToHash(location.hash, null, scroll_offset, scroll_speed);
        });
    }

    $('.builder-layout-hover-gallery .inner-wrap').show();
    $('.builder-layout-parallax-section .parallax').parallax();

    const $packery_gallery = $('.builder-layout-packery-gallery .packery-row').isotope({
        itemSelector: '.packery-item',
        layoutMode: 'packery',
        packery: {
            gutter: '.gutter-sizer'
        },
        percentPosition: true
    });

    if($packery_gallery.length >= 1) {
        $(window).load(function() {
            const intervalFunction = setInterval(function() {
                $grid_filter.isotope('layout');
                //console.log($grid_filter);
            }, 900);

            setTimeout(function() {
                clearInterval(intervalFunction);
            }, 10000);
        });
    }

    // init Isotope
    const $grid_filter = $('.builder-layout-hover-gallery .tiles-row').isotope({
        itemSelector: '.single-tile',
        layoutMode: 'packery',
        packery: {
            gutter: '.gutter-sizer'
        },
    });

    if($grid_filter.length >= 1) {
        $(window).load(function() {
            const intervalFunction = setInterval(function() {
                $grid_filter.isotope('layout');
                // console.log($grid_filter);
            }, 900);

            setTimeout(function() {
                clearInterval(intervalFunction);
            }, 10000);
        });
    }

    // bind filter button click
    $('.sort-btns').on( 'click', 'button', function() {
        const filterValue = $(this).attr('data-filter');
        $grid_filter.isotope({ filter: filterValue });
    });

    // change is-checked class on buttons
    $('.sort-btns').each( function(i, buttonGroup) {
        const $buttonGroup = $(buttonGroup);
        $buttonGroup.on( 'click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });

    $('.the-progressive-image').each(function(i, el) {
        $(this).data('waypoint', new Waypoint({
            element: $(el),
            offset: "200%",
            handler: function() {
                if(!$(el).hasClass('loaded')) {
                    let size = 0;

                    const sizes = [
                        JSON.parse($(el).attr('data-small')),
                        JSON.parse($(el).attr('data-med')),
                        JSON.parse($(el).attr('data-large')),
                        JSON.parse($(el).attr('data-full'))
                    ];

                    for(const i in sizes) {
                        if(sizes.hasOwnProperty(i)) {
                            size = i;

                            if(sizes[i].width >= window.innerWidth) {
                                break;
                            }
                        }
                    }

                    $('<img/>').attr('src', sizes[size].src).on('load', function() {
                        $(this).remove(); // prevent memory leaks
                        $(el).css('background-image', 'url('+sizes[size].src+')');

                        //$(el).parents('.gallery-image').featherlight(sizes[sizes.length-1].src);

                        $(el).addClass('loaded');
                    });
                }
            }
        }));
    });

    var $slider = $('#auto-slider');

    if($slider.length >= 1) {
        /*const waypoint = new Waypoint({
            element: $slider,
            handler: function() {
                $(window).scroll(function() {
                    const scrollDistance = $(window).scrollTop();
                    const scrollPoint = ($slider.offset().top - 130);

                    if (scrollPoint <= scrollDistance) {
                        console.log("Testing");
                        $('.builder-component-gallery-slider .main-slideshow').flickity({
                            // options
                            contain: true,
                            autoPlay: 5000,
                            prevNextButtons: false,
                            pageDots: true,
                            wrapAround: true,
                            setGallerySize: false
                        });
                    }
                }).scroll();
            },
            offset: '100'
        })*/

        const inview = new Waypoint.Inview({
            element: $('#auto-slider')[0],
            enter: function(direction) {
                $('.builder-component-gallery-slider .main-slideshow').flickity({
                    // options
                    contain: true,
                    autoPlay: 5000,
                    prevNextButtons: false,
                    pageDots: true,
                    wrapAround: true,
                    setGallerySize: false
                });
            }
        });
    }

    $(window).on("load", function () {
        $('.builder-component-image .image-container').each(function (i, el) {
            const img = $(el).find('img')[0];
            const bg = img.currentSrc || img.src;
            $(el).css('background-image', 'url(' + bg + ')');
        });

        utils.equalHeight('.equal');
        $(window).trigger('resize').trigger('scroll');

        setInterval(function () {
            jQuery(window).trigger('resize').trigger('scroll');
        }, 1000);
    });

    $(window).on('hashchange', function (e) {
        if (location.hash) {
            if (!ScrollToHash(location.hash, null, scroll_offset, scroll_speed)) {
                e.preventDefault();
            }
        }
    });

    $('.single-accordion .acc-header, .builder-component-single-accordion .acc-header').on('click', function () {
        var $column = $(this).parent();
        $column.toggleClass('open');
        $column.find('.acc-content').slideToggle({
            duration: 250,
            progress: function () {
                $(window).trigger('resize');
            }
        });
    });
})(jQuery);