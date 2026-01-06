(function ($) {
	"use strict";
	var Core = {
		initialized: false,
		timeOut_search: null,

		initialize: function () {

			if (this.initialized) return;
			this.initialized = true;

			this.build();
			Core.events();
		},
		build: function () {
			Core.owlCarousel();
			Core.process_product();
            Core.process_footer();
			Core.language_selector();
            Core.stellar();
			Core.prettyPhoto();
            Core.setCartScrollbar();
            Core.setPositionPageTitle();
            Core.magicLine();
            Core.setWidthMenuFooter();
            Core.sticky_header();
            Core.top_drawer();
            Core.menu_one_page();
            Core.setOverlayVC();
            Core.playVideoBg();
			Core.setWidgetCollapse();
		},

		events: function () {
			Core.window_scroll();
			Core.window_resize();
			Core.goTop();
			// Anchors Position
			$("a[data-hash]").on("click", function (e) {
				e.preventDefault();
				Core.anchorsPosition(this);
				return false;
			});
			Core.process_Blog();
			Core.search_popup_process();
			Core.document_click();
			$('.wpb_map_wraper').on('click', Core.onMapClickHandler);
			Core.menu_process();
			Core.getQuote();
		},
		getQuote: function() {
			var $get_quote = $('#get_quote_popup');
			if ($get_quote.length > 0) {
				var dlg = new DialogFx( $get_quote[0] );
				$('.get-a-quote-button').click(dlg.toggle.bind(dlg));
			}
			$('.get-a-quote-button').click(function (event) {
				event.preventDefault();
				$('.mail-chimp-popup .mail-chimp-button > input[type="email"]').focus();
			});

			if ($('#get_quote_popup .mc4wp-alert.mc4wp-error').length > 0) {
				$('.get-a-quote-button').trigger('click');
			}

		},
		setOverlayVC : function() {
			$('[data-overlay-image]').each(function() {
				var $selector =$(this);
				setTimeout(function() {
					var overlay_image = $selector.data('overlay-image');
					var overlay_opacity = $selector.data('overlay-opacity');
					var html = '<div class="overlay-bg-vc" style="background-image: url('+ overlay_image +') ;background-repeat:repeat; opacity:'+overlay_opacity+'"></div>';
					$selector.prepend(html);
				}, 100);
			});
			$('[data-overlay-color]').each(function() {
				var $selector =$(this);
				setTimeout(function() {
					var overlay_color = $selector.data('overlay-color');
					var html = '<div class="overlay-bg-vc" style="background-color: '+ overlay_color +'"></div>';
					$selector.prepend(html);
				}, 100);
			});
		},
        playVideoBg:function(){
            $('.play-video-bg','.darna-video-bg').click( function(){
                var video_bg = $ (this).parent().parent().parent();
                var id = $(video_bg).find('video').attr('id');
                var myVideo = document.getElementById(id);
                if (myVideo.paused)
                {
                    $("a i",video_bg).removeClass("fa-play");
                    $("a i",video_bg).addClass("fa-pause");
                    $(".video-bg-img",video_bg).hide();
                    $(".video-bg-video",video_bg).show();
                    myVideo.play();
                }
                else
                {
                    $("a i",video_bg).removeClass("fa-pause");
                    $("a i",video_bg).addClass("fa-play");
                    myVideo.pause();
                }
            });
        },
		menu_process: function() {
			$('.toggle-icon-wrapper[data-ref]').click(function(event) {
				event.preventDefault();
				var $this = $(this);
				var data_drop = $this.data('ref');
				$this.toggleClass('in');
				switch ($this.data('drop-type')) {
					case 'dropdown':
						$('#' + data_drop).slideToggle();
						break;
					case 'fly':
						$('body').toggleClass('menu-mobile-in');
						$('#' + data_drop).toggleClass('in');
						break;
				}

			});
			$('.main-menu-overlay').click(function() {
				$('body').removeClass('menu-mobile-in');
				$('#main-menu').removeClass('in');
				$('.toggle-icon-wrapper[data-ref]').removeClass('in');
			});
		},
        menu_one_page: function() {
            $('.menu-one-page').onePageNav({
                currentClass: 'menu-current',
                changeHash: false,
                scrollSpeed: 750,
                scrollThreshold: 0.5,
                filter: '',
                easing: 'swing'
            });
        },
        top_drawer: function() {
            $('.top-drawer-toggle').click( function(){
                var $top_drawer_bar = $ ( '#top-drawer-bar' );
                $top_drawer_bar.slideToggle('slow' );
                $(this).toggleClass('open');
            });
        },
        sticky_header: function() {
            var topSpacing = 0;
            if (($('#wpadminbar').length > 0) && ($('#wpadminbar').css('position') =='fixed')) {
                topSpacing = $('#wpadminbar').outerHeight();
            }

	        setTimeout(function () {
		        $('header.main-header.header-sticky, header.main-header.header-mobile-sticky, header.main-header .header-sticky').unstick();

		        if (Core.is_desktop()) {
			        $('header.main-header.header-sticky, header.main-header .header-sticky').sticky({topSpacing:topSpacing});
		        }
		        else {
			        $('header.main-header.header-mobile-sticky').sticky({topSpacing:topSpacing});
		        }
	        }, 200);

        },

		language_selector: function () {
			var $selected = $('#lang_sel_list li > a.lang_sel_sel');
			var langStr = 'en';
			if ($selected.length > 0) {
				langStr = $selected.parent().attr('class');
				if (langStr) {
					langStr = langStr.replace('icl-', '');
				}
				else {
					langStr = 'en';
				}
				$('.language-selector > li > span').text($('.language-selector > li > span').text() + ': ' + langStr);
			}
		},
		document_click: function () {

		},
		anchorsPosition: function (obj, time) {
			var target = jQuery(obj).attr("href");
			if ($(target).length > 0) {
				var _scrollTop = $(target).offset().top;
				if ($('#wpadminbar').length > 0) {
					_scrollTop -= $('#wpadminbar').outerHeight();
				}
				$("html,body").animate({scrollTop: _scrollTop}, time, 'swing', function () {
				});
			}
		},
		window_scroll: function () {
			$(window).on('scroll', function (event) {
				Core.go_top_scroll();
			});
		},
		goTop: function () {
			$('.gotop').click(function () {
				$('html,body').animate({scrollTop: '0px'}, 800);
				return false;
			});
		},
		go_top_scroll: function () {
			if ($(window).scrollTop() > $(window).height() / 2) {
				$('.gotop').addClass('in');
			}
			else {
				$('.gotop').removeClass('in');
			}
		},
		window_resize: function () {
			$(window).resize(function () {
				if ($('#wpadminbar').length > 0) {
					$('body').attr('data-offset', $('#wpadminbar').outerHeight() + 1);
				}
				Core.processWidthAudioPlayer();
                Core.setCartScrollbar();
                Core.setWidthMenuFooter();
                setTimeout(function(){
                    Core.process_footer();
                },1000);

                Core.sticky_header();
                Core.setPositionPageTitle();
				Core.setWidgetCollapse();

				//
				if (Core.is_desktop()) {
					if (!$('body').hasClass('menu-mobile-in')) {
						$('.toggle-icon-wrapper[data-ref]').removeClass('in');
					}
				}
			});
		},
		owlCarousel: function () {
			$('div.owl-carousel:not(.manual)').each(function () {
				var slider = $(this);

				var defaults = {
					// Most important owl features
					items: 5,
					itemsCustom: false,
					itemsDesktop: [1199, 4],
					itemsDesktopSmall: [980, 3],
					itemsTablet: [768, 2],
					itemsTabletSmall: false,
					itemsMobile: [479, 1],
					singleItem: false,
					itemsScaleUp: false,

					//Basic Speeds
					slideSpeed: 200,
					paginationSpeed: 800,
					rewindSpeed: 1000,

					//Autoplay
					autoPlay: false,
					stopOnHover: true,

					// Navigation
					navigation: false,
                    navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
					rewindNav: true,
					scrollPerPage: false,

					//Pagination
					pagination: true,
					paginationNumbers: false,

					// Responsive
					responsive: true,
					responsiveRefreshRate: 200,
					responsiveBaseWidth: window,

					// CSS Styles
					baseClass: "owl-carousel",
					theme: "owl-theme",

					//Lazy load
					lazyLoad: false,
					lazyFollow: true,
					lazyEffect: "fade",

					//Auto height
					autoHeight: false,

					//JSON
					jsonPath: false,
					jsonSuccess: false,

					//Mouse Events
					dragBeforeAnimFinish: true,
					mouseDrag: true,
					touchDrag: true,

					//Transitions
					transitionStyle: false,

					// Other
					addClassActive: false,

					//Callbacks
					beforeUpdate: false,
					afterUpdate: false,
					beforeInit: false,
					afterInit: Core.owlCallbackAfterInit,
					beforeMove: false,
					afterMove: Core.owlCallbackAfterMove,
					afterAction: false,
					startDragging: false,
					afterLazyLoad: false
				};

				var config = $.extend({}, defaults, slider.data("plugin-options"));
				// Initialize Slider


				slider.owlCarousel(config);
			});

			$('.ryl-text-carousel').each(function () {
				var $this = $(this);

				$this.owlCarousel({
					singleItem: true,
					items: 1,
					pagination: true,
					navigation: $this.hasClass('has-nav'),
					slideSpeed: 300,
					mouseDrag: false,
					transitionStyle: "ryl-text",
					afterAction: updateSliderIndex,
					afterMove: false,
					beforeMove: false,
					autoHeight: true
				});

				function updateSliderIndex() {
					var items = $this.children().find('.owl-pagination .owl-page').length;
					var index = $this.children().find('.owl-pagination .owl-page.active').index() + 1;
					$this.attr('data-index', (index + "/" + items));
				}
			});
		},

        owlCallbackAfterInit: function(elm){
            $(elm).trigger( 'afterOwlInit' );
        },
        owlCallbackAfterMove: function(elm){
            $(elm).trigger( 'afterOwlMove' );
        },

		// Disable scroll zooming and bind back the click event
		onMapMouseleaveHandler: function (event) {
			var that = jQuery(this);

			that.on('click', Core.onMapClickHandler);
			that.off('mouseleave', Core.onMapMouseleaveHandler);
			that.find('iframe').css("pointer-events", "none");
		},

		onMapClickHandler: function (event) {
			var that = jQuery(this);

			// Disable the click handler until the user leaves the map area
			that.off('click', Core.onMapClickHandler);

			// Enable scrolling zoom
			that.find('iframe').css("pointer-events", "auto");

			// Handle the mouse leave event
			that.on('mouseleave', Core.onMapMouseleaveHandler);
		},
		process_Blog: function () {
			Core.blog_infinite_scroll();
			Core.blog_jplayer();
			Core.blog_load_more();
            Core.blog_grid();
            setInterval(Core.blog_grid,300);
            Core.blog_masonry();
            setInterval(Core.blog_masonry,300);
		},
		blog_load_more: function () {
			$('.blog-load-more').on('click', function (event) {
				event.preventDefault();
				var $this = $(this).button('loading');
				var link = $(this).attr('data-href');
				var contentWrapper = '.blog-inner';
				var element = 'article';

				$.get(link, function (data) {
					var next_href = $('.blog-load-more', data).attr('data-href');
					var $newElems = $(element, data).css({
						opacity: 0
					});

					$(contentWrapper).append($newElems);

					$newElems.imagesLoaded(function () {
						Core.owlCarousel();
						Core.blog_jplayer();
						Core.prettyPhoto();
						$newElems.animate({
							opacity: 1
						});

                        if (($(contentWrapper).hasClass('blog-style-masonry')) || ($(contentWrapper).hasClass('blog-style-grid'))) {
                            $(contentWrapper).isotope('appended', $newElems);
                            setTimeout(function() {
                                $(contentWrapper).isotope('layout');
                            }, 400);
                        }

					});

					if (typeof(next_href) == 'undefined') {
						$this.hide();
					} else {
						$this.button('reset');
						$this.attr('data-href', next_href);
					}

				});
			});
		},
		blog_jplayer: function () {
			$('.jp-jplayer').each(function () {
				var $this = $(this),
					url = $this.data('audio'),
					title = $this.data('title'),
					type = url.substr(url.lastIndexOf('.') + 1),
					player = '#' + $this.data('player'),
					audio = {};
				audio[type] = url;
				audio['title'] = title;
				$this.jPlayer({
					ready: function () {
						$this.jPlayer('setMedia', audio);
					},
					swfPath: '../plugins/jquery.jPlayer',
					cssSelectorAncestor: player
				});
			});
			Core.processWidthAudioPlayer();
		},
		processWidthAudioPlayer: function () {
			setTimeout(function () {
				$('.jp-audio').each(function () {
					var _width = $(this).outerWidth() - $('.jp-play-pause', this).outerWidth() - $('.jp-volume', this).outerWidth() - 46;
					$('.jp-progress', this).width(_width);

				});
			}, 100);
		},
		blog_infinite_scroll: function () {
            var contentWrapper = '.blog-inner';
			$('.blog-inner').infinitescroll({
				navSelector: "#infinite_scroll_button",
				nextSelector: "#infinite_scroll_button a",
				itemSelector: "article",
				loading: {
					'selector': '#infinite_scroll_loading',
					'img': g5plus_framework_constant.theme_url + 'assets/images/ajax-loader.gif',
					'msgText': 'Loading...',
					'finishedMsg': ''
				}
			}, function (newElements, data, url) {
				var $newElems = $(newElements).css({
					opacity: 0
				});
				$newElems.imagesLoaded(function () {
					Core.owlCarousel();
					Core.blog_jplayer();
					$newElems.animate({
						opacity: 1
					});


                    if (($(contentWrapper).hasClass('blog-style-masonry')) || ($(contentWrapper).hasClass('blog-style-grid'))) {
                        $(contentWrapper).isotope('appended', $newElems);
                        setTimeout(function() {
                            $(contentWrapper).isotope('layout');
                        }, 400);
                    }


				});

			});
		},
        blog_grid : function() {
            var $blog_grid = $('.blog-style-grid').imagesLoaded( function() {
                $blog_grid.isotope({
                    itemSelector : 'article',
                    layoutMode: "fitRows"
                });
            });
        },
        blog_masonry : function() {
            var $blog_masonry = $('.blog-style-masonry').imagesLoaded( function() {
                $blog_masonry.isotope({
                    itemSelector : 'article',
                    layoutMode: "masonry"
                });
            });
        },
		show_loading: function () {
			$('body').addClass('overflow-hidden');
			if ($('.loading-wrapper').length == 0) {
				$('body').append('<div class="loading-wrapper"><span class="spinner-double-section-far"></span></div>');
			}
		},
		hide_loading: function () {
			$('.loading-wrapper').fadeOut(function () {
				$('.loading-wrapper').remove();
				$('body').removeClass('overflow-hidden');
			});
		},

        search_popup_process: function () {
	        var $search_popup = $('#search_popup_wrapper');
	        if (($search_popup.length > 0) && ($('header .icon-search-menu').data('search-type') == 'standard')) {
		        var dlg_search = new DialogFx( $search_popup[0] );
		        $('header .icon-search-menu').click(dlg_search.toggle.bind(dlg_search));

	        }

			$('header .icon-search-menu').click(function (event) {
				event.preventDefault();
				if ($(this).data('search-type') == 'ajax') {
					Core.search_popup_open();
				}
				else {
					$('#search_popup_wrapper input[type="text"]').focus();
				}
			});

            $('.g5plus-dismiss-modal, .modal-backdrop', '#g5plus-modal-search').click(function(){
                Core.search_popup_close();
            });
            $('.g5plus-search-wrapper button > i.ajax-search-icon').click(function(){
                s_search();
            });

            // Search Ajax
            $('#search-ajax', '#g5plus-modal-search').on('keyup', function(event){
                var s_timeOut_search = null;
                if (event.altKey || event.ctrlKey || event.shiftKey || event.metaKey) {
                    return;
                }

                var keys = ["Control", "Alt", "Shift"];
                if (keys.indexOf(event.key) != -1) return;
                switch (event.which) {
                    case 27:	// ESC
                        Core.search_popup_close();
                        break;
                    case 38:	// UP
                        s_up();
                        break;
                    case 40:	// DOWN
                        s_down();
                        break;
                    case 13:	//ENTER
                        var $item = $('li.selected a', '#g5plus-modal-search');
                        if ($item.length == 0) {
                            event.preventDefault();
                            return false;
                        }
                        s_enter();
                        break;
                    default:
                        clearTimeout(Core.timeOut_search);
                        Core.timeOut_search = setTimeout(s_search, 500);
                        break;
                }
            });

            function s_up(){
                var $item = $('li.selected', '#g5plus-modal-search');
                if ($('li', '#g5plus-modal-search').length < 2) return;
                var $prev = $item.prev();
                $item.removeClass('selected');
                if ($prev.length) {
                    $prev.addClass('selected');
                }
                else {
                    $('li:last', '#g5plus-modal-search').addClass('selected');
                    $prev = $('li:last', '#g5plus-modal-search');
                }
                if ($prev.position().top < jQuery('#g5plus-modal-search .ajax-search-result').scrollTop()) {
                    jQuery('#g5plus-modal-search .ajax-search-result').scrollTop($prev.position().top);
                }
                else if ($prev.position().top + $prev.outerHeight() > jQuery('#g5plus-modal-search .ajax-search-result').scrollTop() + jQuery('#g5plus-modal-search .ajax-search-result').height()) {
                    jQuery('#g5plus-modal-search .ajax-search-result').scrollTop($prev.position().top - jQuery('#g5plus-modal-search .ajax-search-result').height() + $prev.outerHeight());
                }
            }
            function s_down() {
                var $item = $('li.selected', '#g5plus-modal-search');
                if ($('li', '#g5plus-modal-search').length < 2) return;
                var $next = $item.next();
                $item.removeClass('selected');
                if ($next.length) {
                    $next.addClass('selected');
                }
                else {
                    $('li:first', '#g5plus-modal-search').addClass('selected');
                    $next = $('li:first', '#g5plus-modal-search');
                }
                if ($next.position().top < jQuery('#g5plus-modal-search .ajax-search-result').scrollTop()) {
                    jQuery('#g5plus-modal-search .ajax-search-result').scrollTop($next.position().top);
                }
                else if ($next.position().top + $next.outerHeight() > jQuery('#g5plus-modal-search .ajax-search-result').scrollTop() + jQuery('#g5plus-modal-search .ajax-search-result').height()) {
                    jQuery('#g5plus-modal-search .ajax-search-result').scrollTop($next.position().top - jQuery('#g5plus-modal-search .ajax-search-result').height() + $next.outerHeight());
                }
            }
            function s_enter() {
                var $item = $('li.selected a', '#g5plus-modal-search');
                if ($item.length > 0) {
                    window.location = $item.attr('href');
                }
            }
            function s_search() {
                var keyword = $('input[type="search"]', '#g5plus-modal-search').val();
                if (keyword.length < 2) {
                    $('.ajax-search-result', '#g5plus-modal-search').html('');
                    return;
                }
                $('.ajax-search-icon', '#g5plus-modal-search').addClass('fa fa-spinner fa-spin');
                $('.ajax-search-icon', '#g5plus-modal-search').removeClass('icon-search');
                $.ajax({
                    type   : 'POST',
                    data   : 'action=result_search&keyword=' + keyword,
                    url    : g5plus_framework_constant.ajax_url,
                    success: function (data) {
                        $('.ajax-search-icon', '#g5plus-modal-search').removeClass('fa fa-spinner fa-spin');
                        $('.ajax-search-icon', '#g5plus-modal-search').addClass('icon-search');
                        var html = '';
                        if (data) {
                            var items = $.parseJSON(data);
                            if (items.length) {
                                html +='<ul>';
                                if (items[0]['id'] == -1) {
                                    html += '<li class="selected">' + items[0]['title']  + '</li>';
                                }
                                else {
                                    $.each(items, function (index) {
                                        if (index == 0) {
                                            html += '<li class="selected">';
                                        }
                                        else {
                                            html += '<li>';
                                        }
                                        if (this['title'] == null || this['title'] == '') {
                                            html += '<a href="' + this['guid'] + '">' + this['date'] + '</a>';
                                        }
                                        else {
                                            html += '<a href="' + this['guid'] + '">' + this['title'] + '</a>';
                                            html += '<span>' + this['date'] + ' </span>';
                                        }

                                        html += '</li>';
                                    });
                                }


                                html +='</ul>';
                            }
                            else {
                                html = '';
                            }
                        }
                        $('.ajax-search-result', '#g5plus-modal-search').html(html);
                        jQuery('#g5plus-modal-search .ajax-search-result').scrollTop(0);
                    },
                    error : function(data) {
                        $('.ajax-search-icon', '#g5plus-modal-search').removeClass('fa fa-spinner fa-spin');
                        $('.ajax-search-icon', '#g5plus-modal-search').addClass('icon-search');
                    }
                });
            }
            
		},
		search_popup_open: function () {
			if (!$('#g5plus-modal-search').hasClass('in')) {
				$('#g5plus-modal-search').show();
				setTimeout(function () {
					$('#g5plus-modal-search').addClass('in');
				}, 300);

                if ($('#search-ajax', '#g5plus-modal-search').length > 0) {
                    $('#search-ajax', '#g5plus-modal-search').focus();
                    $('#search-ajax', '#g5plus-modal-search').val('');
                }
                else {
                    $('#search-standard', '#g5plus-modal-search').focus();
                    $('#search-standard', '#g5plus-modal-search').val('');
                }

				$('.ajax-search-result', '#g5plus-modal-search').html('');
			}
		},
		search_popup_close: function () {
			if ($('#g5plus-modal-search').hasClass('in')) {
				$('#g5plus-modal-search').removeClass('in');
				setTimeout(function () {
					$('#g5plus-modal-search').hide();
				}, 300);
			}
		},
		process_product: function () {
			Core.add_cart_quantity();
			Core.tooltip();
            Core.product_add_to_cart();
            Core.product_layout();
            Core.product_quick_view();
            var $productImageWrap = $('.single-product-image');
            this.singleProductImage($productImageWrap);
		},
		add_cart_quantity: function () {
			$(document).off('click', '.quantity .btn-number').on('click', '.quantity .btn-number', function (event) {
				event.preventDefault();
				var type = $(this).data('type'),
					input = $('input', $(this).parent()),
					current_value = parseFloat(input.val()),
					max  = parseFloat(input.attr('max')),
					min = parseFloat(input.attr('min')),
					step = parseFloat(input.attr('step')),
					stepLength = 0;
				if (input.attr('step').indexOf('.') > 0) {
					stepLength = input.attr('step').split('.')[1].length;
				}

				if (isNaN(max)) {
					max = 100;
				}
				if (isNaN(min)) {
					min = 0;
				}
				if (isNaN(step)) {
					step = 1;
					stepLength = 0;
				}

				if (!isNaN(current_value)) {
					if (type == 'minus') {
						if (current_value > min) {
							current_value = (current_value - step).toFixed(stepLength);
							input.val(current_value).change();
						}

						if (parseFloat(input.val()) <= min) {
							input.val(min).change();
							$(this).attr('disabled', true);
						}
					}

					if (type == 'plus') {
						if (current_value < max) {
							current_value = (current_value + step).toFixed(stepLength);
							input.val(current_value).change();
						}
						if (parseFloat(input.val()) >= max) {
							input.val(max).change();
							$(this).attr('disabled', true);
						}
					}
				} else {
					input.val(min);
				}
			});


			$('input', '.quantity').focusin(function () {
				$(this).data('oldValue', $(this).val());
			});

			$('input', '.quantity').on('change', function () {

				var input = $(this),
					max = parseFloat(input.attr('max')),
					min = parseFloat(input.attr('min')),
					current_value = parseFloat(input.val()),
					step = parseFloat(input.attr('step'));

				if (isNaN(max)) {
					max = 100;
				}
				if (isNaN(min)) {
					min = 0;
				}

				if (isNaN(step)) {
					step = 1;
				}


				var btn_add_to_cart = $('.add_to_cart_button', $(this).parent().parent().parent());
				if (current_value >= min) {
					$(".btn-number[data-type='minus']", $(this).parent()).removeAttr('disabled');
					if (typeof(btn_add_to_cart) != 'undefined') {
						btn_add_to_cart.attr('data-quantity', current_value);
					}

				} else {
					alert('Sorry, the minimum value was reached');
					$(this).val($(this).data('oldValue'));

					if (typeof(btn_add_to_cart) != 'undefined') {
						btn_add_to_cart.attr('data-quantity', $(this).data('oldValue'));
					}
				}

				if (current_value <= max) {
					$(".btn-number[data-type='plus']", $(this).parent()).removeAttr('disabled');
					if (typeof(btn_add_to_cart) != 'undefined') {
						btn_add_to_cart.attr('data-quantity', current_value);
					}
				} else {
					alert('Sorry, the maximum value was reached');
					$(this).val($(this).data('oldValue'));
					if (typeof(btn_add_to_cart) != 'undefined') {
						btn_add_to_cart.attr('data-quantity', $(this).data('oldValue'));
					}
				}
			});

		},
		tooltip: function () {
			if ($().tooltip) {
				$('[data-toggle="tooltip"]').tooltip();
			}
		},
        product_layout : function() {
            $('.product-listing').each(function() {
                if (!$(this).hasClass('product-slider')) {
                    var $products = $(this).imagesLoaded( function() {
                        $products.isotope({
                            itemSelector : '.product-item-wrap',
                            layoutMode: "fitRows"
                        });
                    });
                }
            });
        },

        product_quick_view : function() {
            $('.product-quick-view').on('click', function (event) {
                event.preventDefault();
                var product_id = $(this).data('product_id');
                var popupWrapper = '#popup-product-quick-view-wrapper';
                Core.show_loading();
                $.ajax({
                    url: g5plus_framework_constant.ajax_url,
                    data: {
                        action: 'product_quick_view',
                        id: product_id
                    },
                    success: function (html) {
                        Core.hide_loading();
                        if ($(popupWrapper).length) {
                            $(popupWrapper).remove();
                        }
                        $('body').append(html);
                        Core.add_cart_quantity();
                        Core.tooltip();
                        $(popupWrapper).modal();
                    },
                    error: function (html) {
                        Core.hide_loading();
                    }
                });

            });
        },

		addToCart : false,
        product_add_to_cart : function() {
            $(document).on('click', '.add_to_cart_button', function() {
                if (!$(this).hasClass('single_add_to_cart_button')) {
                    var productWrap = $(this).parent().parent().parent().parent();
                    if (typeof(productWrap) == 'undefined') {
                        return;
                    }
                    productWrap.addClass('active');
                }
            });
            $('body').bind("added_to_cart", function(event,fragments, cart_hash, $thisbutton) {

                Core.setCartScrollbar();

				if (Core.addToCart) return;
				Core.addToCart = true;

                var is_single_product = $thisbutton.hasClass('single_add_to_cart_button');
                var productThumb;
                var productWrap;
                var productImage;

                if (!is_single_product) {
                    productWrap = $($thisbutton).parent().parent().parent().parent();
                } else {
                    var product_id = parseInt($thisbutton.data('product_id'),10);
                    if (!isNaN(product_id)) {
                        productWrap = $('#product-' + product_id);
                    }
                }

                if (!is_single_product) {
                    setTimeout(function(){
                        productWrap.addClass('added').removeClass('active');
                    },300);
                }

                if (productWrap.hasClass('add-to-cart-animation-visible') || !Core.is_desktop()) {
                    return;
                }


                if (is_single_product) {
                    productThumb = $($('.woocommerce-main-image',productWrap)[0]);
                    productImage = $('img', productThumb);
                } else {
                    if (productWrap.length == 0) {
                        return;
                    }

                    productThumb = $('.product-thumb',productWrap);

                    productImage = $('.product-thumb-primary > img',productWrap);
                    if (productImage.length == 0) {
                        productImage = $('.product-thumb-one > img',productWrap);
                    }
                }

                if (productThumb.length == 0) {
                    return;
                }

                var position = productThumb.offset();

                $("body").append('<div class="floating-cart"></div>');
                var cart = $('div.floating-cart');
                productImage.clone().appendTo(cart);

                var mini_cart = $('.widget_shopping_cart_icon','.header-desktop-wrapper');


                if (mini_cart.length == 0) {
                    return;
                }

                $(cart).css({
                    'top' : position.top + 'px',
                    'left' : position.left + 'px',
                    'width' : productThumb.width() + 'px',
                    'height' : productThumb.height() + 'px'
                }).fadeIn("slow");

                $(cart).animate({
                    'width' : (productThumb.width() / 2) + 'px',
                    'height' : (productThumb.height() / 2) + 'px',
                    top :  '+='  +(productThumb.height() / 4) + 'px',
                    left:  '+=' + (productThumb.width() / 4) + 'px'
                },400,'swing',function() {
                    $(cart).animate({
                        top : mini_cart.offset().top + 'px',
                        left: mini_cart.offset().left + 'px',
                        height: '18px',
                        width : '25px'
                    }, 800, "swing", function() {
                        $('div.floating-cart').fadeIn('fast',function(){
                            $('div.floating-cart').remove();
                        });

                        mini_cart.addClass('animated').addClass('tada');
                        setTimeout(function(){
                            mini_cart.removeClass('animated').removeClass('tada');
                        },4000);
						Core.addToCart = false;

                    });
                });

				setTimeout(function(){
					$('html,body').animate({scrollTop: '0px'}, 800);
				},800);



            });

			$('body').on('wc_fragments_refreshed',function(){
				Core.setCartScrollbar();
			});
        },

		is_desktop: function () {
			var responsive_breakpoint = 991;
			var $menu = $('.x-nav-menu');
			if (($menu.length > 0) && (typeof ($menu.attr('responsive-breakpoint')) != "undefined" ) && !isNaN(parseInt($menu.attr('responsive-breakpoint'), 10))) {
				responsive_breakpoint = parseInt($menu.attr('responsive-breakpoint'), 10);
			}
			return window.matchMedia('(min-width: ' + (responsive_breakpoint + 1) + 'px)').matches;
		},
        stellar : function() {
            $.stellar({
                horizontalScrolling: false,
                scrollProperty: 'scroll',
                positionProperty: 'position'
            });
        },
		prettyPhoto : function() {
			$("a[data-rel^='prettyPhoto']").prettyPhoto({
                hook:'data-rel',
				social_tools:'',
				animation_speed:'normal',
				theme:'light_square'
			});
		},
        setCartScrollbar:function(){
            setTimeout(function() {
                var $adminbar = $('#wpadminbar').outerHeight();
                var $site_top = $('.site-top').outerHeight();
                var $shopping_cart_wrapper = $('.shopping-cart-wrapper').outerHeight();

                var $windowHeight = $(window).height();
                var $divCartWrapperHeight = 417;
                var $bufferBottom = 40;
                var $maxCartHeight = 285;
                var $heightScroll = '124px';
                var $max_item_product = 3;

                if($windowHeight - $adminbar - $site_top - $shopping_cart_wrapper - $bufferBottom < $divCartWrapperHeight){
                    $maxCartHeight = 200;
                    $heightScroll = '100px';
                    $max_item_product = 2;
                }

                $('ul.cart_list.product_list_widget').css('max-height',$maxCartHeight);
                $('ul.cart_list.product_list_widget').perfectScrollbar({
                    wheelSpeed: 0.5,
                    suppressScrollX: true
                });
                $('ul.cart_list.product_list_widget').perfectScrollbar('update');
                if($("ul.cart_list.product_list_widget li").length > $max_item_product){
                    $('ul.cart_list.product_list_widget .ps-scrollbar-y').css('height',$heightScroll);

                }
            }, 1000);

        },

        setPositionPageTitle:function(){
            if (!Core.is_desktop()) {
	            if( $('header.main-header').hasClass('header-2') || $('header.main-header').hasClass('header-4') ||  $('header.main-header').hasClass('header-5')){
		            var sectionTitle = $('.page-title-wrap');
		            $(sectionTitle).css('padding-top','');
		            $(sectionTitle).css('padding-bottom','');

		            var pageTitleInner = $('.page-title-inner', sectionTitle);
		            $(pageTitleInner).css('transition','');
		            $(pageTitleInner).css('-webkit-transition','');
		            $(pageTitleInner).css('-moz-transition','');
		            $(pageTitleInner).css('-o-transition','');
		            $(pageTitleInner).css('-ms-transition','');
	            }
            }
	        else {
	            var sectionTitle = $('.page-title-wrap');
	            if( $('header.main-header').hasClass('header-2') || $('header.main-header').hasClass('header-4') || $('header.main-header').hasClass('header-5')){
		            if(sectionTitle!=null && typeof sectionTitle!='undefined'){

			            var headerHeight = $('header.main-header').outerHeight();
			            if ($('.top-bar').length) {
				            headerHeight += $('.top-bar').outerHeight();
			            }

			            if ($('header.main-header').hasClass('header-4')) {
				            headerHeight += 20;
			            }

			            var buffer = ($(sectionTitle).outerHeight() - headerHeight - $('.block-center-inner', sectionTitle).outerHeight()) / 2;

			            $(sectionTitle).css('padding-top',headerHeight + buffer);
			            $(sectionTitle).css('padding-bottom',buffer);

			            var pageTitleInner = $('.page-title-inner', sectionTitle);
			            $(pageTitleInner).css('transition','all 0.5s');
			            $(pageTitleInner).css('-webkit-transition','all 0.5s ease-in-out');
			            $(pageTitleInner).css('-moz-transition','all 0.5s ease-in-out');
			            $(pageTitleInner).css('-o-transition','all 0.5s ease-in-out');
			            $(pageTitleInner).css('-ms-transition','all 0.5s ease-in-out');
		            }
	            }
            }

        },

        pageIn : function() {
            setTimeout(function() {
                $('#site-loading').fadeOut(300);
            }, 300);
        },

        magicLine:function(){
            $('.magic-line-container').each(function() {
                var activeItem = $('li.active',this);
                magic_line_set_position(activeItem);

                $('li',this).hover(function(){
                    if(!$(this).hasClass('none-magic-line')){
                        magic_line_set_position(this);
                    }

                },function(){
                    if(!$(this).hasClass('none-magic-line')){
                       magic_line_return_active(this);
                    }
                });
            });

            function magic_line_set_position(item){
                if(item!=null && item!='undefined'){
                    var left = 0;
                    if($(item).position()!=null)
                        left = $(item).position().left;
                    var margin_left = $(item).css('margin-left');
                    var margin_right = $(item).css('margin-right');

                    var top_magic_line = $('.top.magic-line', $(item).parent());
                    var bottom_magic_line = $('.bottom.magic-line', $(item).parent());
                    if(top_magic_line!=null && top_magic_line != 'undefined'){
                        $(top_magic_line).css('left',left);
                        $(top_magic_line).css('width',$(item).width());
                        $(top_magic_line).css('margin-left',margin_left);
                        $(top_magic_line).css('margin-right',margin_right);
                    }
                    if(bottom_magic_line!=null && bottom_magic_line != 'undefined'){
                        $(bottom_magic_line).css('left',left);
                        $(bottom_magic_line).css('width',$(item).width());
                        $(bottom_magic_line).css('margin-left',margin_left);
                        $(bottom_magic_line).css('margin-right',margin_right);
                    }
                }

            }
            function magic_line_return_active(current_item){
                if(!$(current_item).hasClass('active')){
                    var activeItem = $('li.active',$(current_item).parent());
                    magic_line_set_position(activeItem);
                }
            };
        },
        setWidthMenuFooter:function(){
            $('li','.footer_top_holder .widget_nav_menu').each(function(){
                var ulParent = $(this).parent();
                if(ulParent!=null){
                    var padding = 10;
                    var parentWidth = $(ulParent).outerWidth();
                    var liWidth = $('a',this).outerWidth() + padding;
                    if(liWidth > (parentWidth/2)){
                        $(this).css('min-width','100%');
                    }else
                        $(this).css('min-width','50%');

                }
            });
        },
        process_footer : function() {
            var $window = $(window);		//Window object
            var $footer = $('footer');
            if(!$('body').hasClass('page-template-coming-soon')){
                if($($footer).hasClass('enable-parallax')){
                    var $body = $('body');
                    if (($window.width() >= 992) && ($window.height() >= $footer.outerHeight())) {
                        $body.css({
                            'padding-bottom' : $footer.outerHeight() + 'px'
                        });
                        $body.removeClass('footer-static');
                    } else {
                        $body.addClass('footer-static');

                    }
                }
            }else{
                $('body').removeClass('footer-static');
            }
        },

		setWidgetCollapse: function () {
			var windowWidth = $(window).width();
			if( window.matchMedia('(max-width: 767px)').matches){
				$('footer.footer-collapse-able aside.widget').each(function(){
					var title = $('h4:first',this);
					var content = $(title).next();
					$(title).addClass('collapse');
					if(content!=null && content!='undefined')
						$(content).hide();
					$(title).off();
					$(title).click(function(){
						var content = $(this).next();
						if($(this).hasClass('expanded')){
							$(this).removeClass('expanded');
							$(title).addClass('collapse');
							$(content).slideUp();
						}
						else
						{
							$(this).addClass('expanded');
							$(title).removeClass('collapse');
							$(content).slideDown();
						}

					});

				});
			}else{
				$('footer aside.widget').each(function(){
					var title = $('h4:first',this);
					$(title).off();
					var content = $(title).next();
					$(title).removeClass('collapse');
					$(title).removeClass('expanded');
					$(content).show();
				});
			}
		},
        singleProductImage: function ($productImageWrap) {
            var slider_thumb = $productImageWrap.find('.flex-control-thumbs');
            if(slider_thumb.length) {
                slider_thumb.owlCarousel({
                    items : 4,
                    itemsDesktop: [1199, 4],
                    itemsDesktopSmall: [980, 4],
                    itemsTablet: [768, 4],
                    itemsTabletSmall: false,
                    itemsMobile: [479, 4],
                    pagination:false,
                    responsiveRefreshRate : 100,
                    navigation: false,
                });


            }
        }
	};
	$(document).ready(function () {
		Core.initialize();
	});
    $(window).load(function() {
        Core.setCartScrollbar();
        if ($('body').hasClass('site-loading')) {
            Core.pageIn();
        }
        Core.process_footer();
    });
})(jQuery);