(function($) {
    'use strict';

    $(document).ready(function() {

		
		 // Preloader
		function preloader() {        
			setTimeout(function(){
				$(".preloader").fadeOut();
			},100);
		}
		preloader();
		
        //Search TRAP
        var searchTrap = function(elem) {
            let tabbable = elem.find('select, input, textarea, button, a,button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])').filter(':visible');
            let firstTabbable = tabbable.first();
            let lastTabbable = tabbable.last();
            /*set focus on first input*/
            firstTabbable.focus();
            //redirect last tab to first input/
            lastTabbable.on('keydown', function(e) {
                if ((e.which === 9 && !e.shiftKey)) {
                    e.preventDefault();
                    firstTabbable.focus();
                }
            });
            //redirect first shift+tab to last input/
            firstTabbable.on('keydown', function(e) {
                if ((e.which === 9 && e.shiftKey)) {
                    e.preventDefault();
                    lastTabbable.focus();
                }
            });

            // header-search popup
            $(document).on('click', '.header-search-toggle', function(e) {
                $("body").addClass('header-search-active');
                $("body").addClass("overlay-enabled");
                searchTrap($('.header-search-popup'));
            });
            // header-close-button
            $(document).on('click', '.header-search-close', function(e) {
                $("body").removeClass('header-search-active');
                $("body").removeClass("overlay-enabled");
                return this;
            });
        }

        //   mobile menu
        $(".mobile-collapsed").on("click", function(e) {
            e.preventDefault();
            $(this).parent().toggleClass("current");
            $(this).next().slideToggle();
        });

        $('.counter-count').each(function() {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {

                //chnage count up speed here
                duration: 4000,
                easing: 'swing',
                step: function(now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });

        // filter tab
        // $(window).on('load', function () {
        activePostFilter();

        function activePostFilter() {
            var postFilter = $('.st-filter-init');
            $.each(postFilter, function(index, value) {
                var el = $(this);
                var parentClass = $(this).parent().attr('class');
                var $selector = $('#' + el.attr('id'));
                $($selector).imagesLoaded(function() {
                    var festivarMasonry = $($selector).isotope({
                        itemSelector: '.st-filter-item',
                        percentPosition: true,
                        masonry: {
                            columnWidth: 0,
                            gutter: 0
                        }
                    });
                    $('.collapse').on('shown.bs.collapse hidden.bs.collapse', function() {
                        festivarMasonry.isotope('layout');
                    });
                    $(document).on('click', '.' + parentClass + ' .st-tab-filter a', function() {
                        var filterValue = $(this).attr('data-filter');
                        festivarMasonry.isotope({
                            filter: filterValue,
                            animationOptions: {
                                duration: 450,
                                easing: "linear",
                                queue: false,
                            }
                        });
                        return false;
                    });
                    $('.st-filter-wrapper-2 .st-tab-filter a:first-child').click();
                });
            });
        }
        $(document).on('click', '.st-tab-filter a', function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });


        // scroll top scrollingup
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 200) {
                $('.scrollingUp').addClass('is-active');
            } else {
                $('.scrollingUp').removeClass('is-active');
            }
        });
        $('.scrollingUp').on('click', function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });




        //Mobile TRAP
        var $mob_menu = $("body");
        $(".close-style").on("click", function() {
            $mob_menu.removeClass("header-menu-active");
            $mob_menu.removeClass("overlay-enabled");
        });

        var mobileTrap = function(elem) {
            let tabbable = elem.find('select, input, textarea, button, a,button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])').filter(':visible');
            let firstTabbable = tabbable.first();
            let lastTabbable = tabbable.last();
            /set focus on first input/
            firstTabbable.focus();
            //redirect last tab to first input/
            lastTabbable.on('keydown', function(e) {
                if ((e.which === 9 && !e.shiftKey)) {
                    e.preventDefault();
                    firstTabbable.focus();
                }
            });
            //redirect first shift+tab to last input/
            firstTabbable.on('keydown', function(e) {
                if ((e.which === 9 && e.shiftKey)) {
                    e.preventDefault();
                    lastTabbable.focus();
                }
            });
        };

        //mobile Menu
        $(".navbar-toggler").on("click", function() {
            $mob_menu.addClass("header-menu-active");
            $mob_menu.addClass("overlay-enabled");
            mobileTrap($('.navbar-collapse'));
        });




        // blog masonry
        var $grid = $(".grid").masonry({
            // options
            itemSelector: ".grid-item",
            columnWidth: ".grid-item",
            // percentPosition: true,0

            gutter: 0,
            fitWidth: false
        });

        $grid.imagesLoaded().progress(function() {
            $grid.masonry("layout");
        });


        function activeMenu() {
            var url = window.location.pathname,
                urlRegExp = new RegExp(url.replace(/\/$/, '') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
            // now grab every link from the navigation
            $('.navbar-nav li a').each(function() {
                // alert(url);
                // and test its normalized href against the url pathname regexp
                if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
                    $(this).addClass('active');
                }
            });
        }
        activeMenu();


        // ------------ Magnific Popup ----------------------//
        function youtubeVideo() {
            if ($("a").hasClass("youtube")) {
                $('.youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                })
            }
        }
        youtubeVideo()
            // ---------- End ---------------------



        // Sticky Header
        if ($(".is-sticky-on").length > 0) {
            $(window).on('scroll', function() {
                if ($(window).scrollTop() >= 250) {
                    $('.is-sticky-on').addClass('is-sticky-menu');
                } else {
                    $('.is-sticky-on').removeClass('is-sticky-menu');
                }
            });
        }


    });






    $('.slide-sponsor').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }]
    });
	
	
	$(function() {
		$(".footer-section").hover(function() {
			blurEffect('footer');
		});
		$("#breadcrumb-section").hover(function() {
			blurEffect('breadcrumb');
		});
	});
})(jQuery);

function blurEffect(e) {
    const svg = document.documentElement;
    const pane = document.getElementById(`${e}-effect`);
    const mx = pane.getScreenCTM().inverse();

    const ongrow = event => {
        const at = new DOMPoint(event.clientX, event.clientY).matrixTransform(mx);

        const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
        circle.setAttribute('cx', at.x);
        circle.setAttribute('cy', at.y);

        pane.append(circle);
        setTimeout(() => {
            circle.classList.add('grow');
            svg.addEventListener("mousemove", onshrink.bind(null, circle), {
                once: true
            });
        }, 1);
    }

    const onshrink = circle => {
        circle.classList.remove('grow');
        circle.classList.add('shrink');
        setTimeout(() => circle.remove(), 12000);

    }

    svg.addEventListener("mousemove", ongrow);
}
