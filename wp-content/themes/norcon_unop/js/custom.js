/* ----------------------------------------------------------------

[ Custom code ]

01. ScrollIt
02. Preloader
03. Navbar scrolling background
04. Close navbar-collapse when a clicked
05. Sections background image from data background 
06. Animations
07. YouTubePopUp
08. CountUp Numbers
09. Projects owlCarousel
10. Testimonials owlCarousel
11. News owlCarousel
12. Team owlCarousel
13. Clients owlCarousel
14. Services owlCarousel
15. MagnificPopup (Image, Youtube, Vimeo and custom popup)
16. Scroll back to top
17. Slider
18. Accordion Box

------------------------------------------------------------------- */

jQuery(function() {
    "use strict";
    var wind = jQuery(window);
    
    // ScrollIt
    jQuery.scrollIt({
      upKey: 38,                // key code to navigate to the next section
      downKey: 40,              // key code to navigate to the previous section
      easing: 'swing',          // the easing function for animation
      scrollTime: 600,          // how long (in ms) the animation takes
      activeClass: 'active',    // class given to the active nav element
      onPageChange: null,       // function(pageIndex) that is called when page is changed
      topOffset: -70            // offste (in px) for fixed top navigation
    });
    
    // Preloader
	jQuery("#preloader").fadeOut(900);
	jQuery(".preloader-bg").delay(800).fadeOut(900);
	var wind = jQuery(window);  
    
    // Navbar scrolling background
    wind.on("scroll",function () {
        var bodyScroll = wind.scrollTop(),
            navbar = jQuery(".navbar"),
            logo = jQuery(".navbar .logo> img");
        if(bodyScroll > 100){
            navbar.addClass("nav-scroll");
            logo.attr('src', 'http://servintegralms.com/wp-content/uploads/2023/01/Logo1.png');
        }else{
            navbar.removeClass("nav-scroll");
            logo.attr('src', 'http://servintegralms.com/wp-content/uploads/2023/01/Logo1.png');
        }
    });
    
    // Close navbar-collapse when a clicked
    jQuery(".navbar-nav .dropdown-item a").on('click', function () {
        jQuery(".navbar-collapse").removeClass("show");
    });
    
    // Sections background image from data background
    var pageSection = jQuery(".bg-img, section");
    pageSection.each(function(indx){
        if (jQuery(this).attr("data-background")){
            jQuery(this).css("background-image", "url(" + jQuery(this).data("background") + ")");
        }
    });
    
    // Animations
    var contentWayPoint = function () {
        var i = 0;
        jQuery('.animate-box').waypoint(function (direction) {
            if (direction === 'down' && !jQuery(this.element).hasClass('animated')) {
                i++;
                jQuery(this.element).addClass('item-animate');
                setTimeout(function () {
                    jQuery('body .animate-box.item-animate').each(function (k) {
                        var el = jQuery(this);
                        setTimeout(function () {
                            var effect = el.data('animate-effect');
                            if (effect === 'fadeIn') {
                                el.addClass('fadeIn animated');
                            }
                            else if (effect === 'fadeInLeft') {
                                el.addClass('fadeInLeft animated');
                            }
                            else if (effect === 'fadeInRight') {
                                el.addClass('fadeInRight animated');
                            }
                            else {
                                el.addClass('fadeInUp animated');
                            }
                            el.removeClass('item-animate');
                        }, k * 200, 'easeInOutExpo');
                    });
                }, 100);
            }
        }, {
            offset: '85%'
        });
    };
    jQuery(function () {
        contentWayPoint();
    });
    
    // YouTubePopUp
    jQuery("a.vid").YouTubePopUp();
    
    // CountUp Numbers
    jQuery('.numbers .count').countUp({
        delay: 10,
        time: 1500
    });
    
    // Projects owlCarousel
    jQuery('.projects .owl-carousel').owlCarousel({
        loop:true,
        margin: 30,
        mouseDrag:true,
        autoplay: false,
        dots: true,
        nav: false,
        navText: ["<span class='lnr ti-angle-left'></span>","<span class='lnr ti-angle-right'></span>"],
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });
    
    // Testimonials owlCarousel
    jQuery('.testimonials .owl-carousel').owlCarousel({
        loop:true,
        margin: 30,
        mouseDrag:true,
        autoplay: false,
        dots: true,
        nav: false,
        navText: ["<span class='lnr ti-angle-left'></span>","<span class='lnr ti-angle-right'></span>"],
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });
    
    // News owlCarousel *
    jQuery('.news .owl-carousel').owlCarousel({
        loop: true,
        margin: 30,
        mouseDrag: true,
        autoplay: false,
        dots: true,
        nav: false,
        navText: ["<span class='lnr norcon-small-left'></span>","<span class='lnr norcon-small-right'></span>"],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                dots: true,
                nav: false
            },
            600: {
                items: 2,
                dots: true,
                nav: false
            },
            1000: {
                items: 3
            }
        }
    });
    
    // Team owlCarousel *
    jQuery('.team .owl-carousel').owlCarousel({
        loop: true,
        margin: 30,
        mouseDrag: true,
        autoplay: false,
        dots: false,
        nav: false,
        navText: ["<span class='lnr norcon-small-left'></span>","<span class='lnr norcon-small-right'></span>"],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                dots: true,
                nav: false
            },
            600: {
                items: 2,
                dots: true,
                nav: false
            },
            1000: {
                items: 3
            }
        }
    });
    
    // Clients owlCarousel
    jQuery('.clients .owl-carousel').owlCarousel({
        loop: true
        , margin: 10
        , mouseDrag: true
        , autoplay: false
        , dots: false
        , responsiveClass: true
        , responsive: {
            0: {
                margin: 10
                , items: 2
            }
            , 600: {
                items: 3
            }
            , 1000: {
                items: 4
            }
        }
    });
    
    // Services owlCarousel
    jQuery('.services .owl-carousel').owlCarousel({
		loop: true
		, margin: 30
		, mouseDrag: true
		, autoplay: false
		, dots: true
		, autoplayHoverPause: true
		, responsiveClass: true
		, responsive: {
			0: {
				items: 1
			, }
			, 600: {
				items: 2
			}
			, 1000: {
				items: 3
			}
		}
	});
    
    // MagnificPopup
    jQuery(".img-zoom").magnificPopup({
        type: "image"
        , closeOnContentClick: !0
        , mainClass: "mfp-fade"
        , gallery: {
            enabled: !0
            , navigateByImgClick: !0
            , preload: [0, 1]
        }
    })
    jQuery('.magnific-youtube, .magnific-vimeo, .magnific-custom').magnificPopup({
        disableOn: 700
        , type: 'iframe'
        , mainClass: 'mfp-fade'
        , removalDelay: 300
        , preloader: false
        , fixedContentPos: false
    });
    
    // Scroll back to top
    var progressPath = document.querySelector(".progress-wrap path");
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition = "none";
    progressPath.style.strokeDasharray = pathLength + " " + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition = "stroke-dashoffset 10ms linear";
    var updateProgress = function () {
            var scroll = jQuery(window).scrollTop();
            var height = jQuery(document).height() - jQuery(window).height();
            var progress = pathLength - (scroll * pathLength) / height;
            progressPath.style.strokeDashoffset = progress;
        };
    updateProgress();
    jQuery(window).scroll(updateProgress);
    var offset = 50;
    var duration = 550;
    jQuery(window).on("scroll", function () {
            if (jQuery(this).scrollTop() > offset) {
                jQuery(".progress-wrap").addClass("active-progress");
            } else {
                jQuery(".progress-wrap").removeClass("active-progress");
            }
        });
    jQuery(".progress-wrap").on("click", function (event) {
            event.preventDefault();
            jQuery("html, body").animate({ scrollTop: 0 }, duration);
            return false;
        });
    

});

// Slider 
jQuery(document).ready(function() {
    var owl = jQuery('.header .owl-carousel');
    // Slider owlCarousel - (Inner Page Slider)
    jQuery('.slider .owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        dots: true,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 5000,
        nav: false,
        navText: ['<i class="norcon-small-left" aria-hidden="true"></i>', '<i class="norcon-small-right" aria-hidden="true"></i>'],
        responsiveClass: true,
        responsive: {
            0: {
                dots: true
            },
            600: {
                dots: true
            },
            1000: {
                dots: true
            }
        }
    });
    
    // Slider owlCarousel
    jQuery('.slider-fade .owl-carousel').owlCarousel({
        items: 1,
        loop:true,
        dots: true,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 5000,
        animateOut: 'fadeOut',
        nav: true,
        navText: ['<i class="norcon-small-left" aria-hidden="true"></i>', '<i class="norcon-small-right" aria-hidden="true"></i>'],
        responsiveClass: true,
        responsive: {
            0: {
                nav: false
            },
            600: {
                dots: false
            },
            1000: {
                dots: true
            }
        }
    });
    owl.on('changed.owl.carousel', function(event) {
        var item = event.item.index - 2;     // Position of the current item
        jQuery('h4').removeClass('animated fadeInUp');
        jQuery('h1').removeClass('animated fadeInUp');
        jQuery('p').removeClass('animated fadeInUp');
        jQuery('.button-primary').removeClass('animated fadeInUp');
        jQuery('.button-tersiyer').removeClass('animated fadeInUp');
        jQuery('.owl-item').not('.cloned').eq(item).find('h4').addClass('animated fadeInUp');
        jQuery('.owl-item').not('.cloned').eq(item).find('h1').addClass('animated fadeInUp');
        jQuery('.owl-item').not('.cloned').eq(item).find('p').addClass('animated fadeInUp');
        jQuery('.owl-item').not('.cloned').eq(item).find('.button-primary').addClass('animated fadeInUp');
        jQuery('.owl-item').not('.cloned').eq(item).find('.button-tersiyer').addClass('animated fadeInUp');
    });
});

// Accordion
jQuery(".accordion").on("click", ".title", function () {
		jQuery(this).next().slideDown();
		jQuery(".accordion-info").not(jQuery(this).next()).slideUp();
	});
jQuery(".accordion").on("click", ".item", function () {
		jQuery(this).addClass("active").siblings().removeClass("active");
	});
