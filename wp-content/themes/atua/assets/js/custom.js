(function($) {
    'use strict';

    // Button Split
    if ( document.body.classList.contains('btn--effect-two') || document.body.classList.contains('btn--effect-three') ) {
        document.querySelectorAll('.btn--effect-two .dt-btn .dt-btn-text, .btn--effect-three .dt-btn .dt-btn-text').forEach(button => button.innerHTML = `<span>` + button.textContent.trim().split('').join(`</span><span>`) + '</span>');
    }

    //Hide PreLoading
	function site_preloader() {
		if($('.dt_preloader').length){
            //if ( $('.dt_preloader').length > 0 ) {
            //splitString('.dt_preloader-text', 'splitted');
            //}
			$('.dt_preloader').delay(1000).fadeOut(500);
		}
	}

    if ($(".dt_preloader-close").length) {
        $(".dt_preloader-close").on("click", function(){
            $('.dt_preloader').delay(200).fadeOut(500);
        });
    }

    //set animation timing
    var animationDelay = 2500,
        //loading bar effect
        barAnimationDelay = 3800,
        barWaiting = barAnimationDelay - 3000, //3000 is the duration of the transition on the loading bar - set in the scss/css file
        //letters effect
        lettersDelay = 50,
        //type effect
        typeLettersDelay = 150,
        selectionDuration = 500,
        typeAnimationDelay = selectionDuration + 800,
        //clip effect 
        revealDuration = 600,
        revealAnimationDelay = 1500;

    function initHeadline() {
        //insert <i> element for each letter of a changing word
        singleLetters($('.dt_heading.dt_heading_2').find('b'));
        singleLetters($('.dt_heading.dt_heading_3').find('b'));
        singleLetters($('.dt_heading.dt_heading_8').find('b'));
        singleLetters($('.dt_heading.dt_heading_9').find('b'));
        //initialise headline animation
        animateHeadline($('.dt_heading'));
    }

    function singleLetters($words) {
        $words.each(function() {
            var word = $(this),
                letters = word.text().split(''),
                selected = word.hasClass('is_on');
            for (var i in letters) {
                if (word.parents('.dt_heading_3').length > 0) letters[i] = '<em>' + letters[i] + '</em>';
                letters[i] = (selected) ? '<i class="in">' + letters[i] + '</i>' : '<i>' + letters[i] + '</i>';
            }
            var newLetters = letters.join('');
            word.html(newLetters).css('opacity', 1);
        });
    }

    function animateHeadline($headlines) {
        var duration = animationDelay;
        $headlines.each(function() {
            var headline = $(this);

            if (headline.hasClass('dt_heading_4')) {
                duration = barAnimationDelay;
                setTimeout(function() {
                    headline.find('.dt_heading_inner').addClass('is-loading')
                }, barWaiting);
            } else if (headline.hasClass('dt_heading_6')) {
                var spanWrapper = headline.find('.dt_heading_inner'),
                    newWidth = spanWrapper.width() + 10
                spanWrapper.css('width', newWidth);
            } else if (!headline.hasClass('dt_heading_2')) {
                //assign to .dt_heading_inner the width of its longest word
                var words = headline.find('.dt_heading_inner b'),
                    width = 0;
                words.each(function() {
                    var wordWidth = $(this).width();
                    if (wordWidth > width) width = wordWidth;
                });
                headline.find('.dt_heading_inner').css('width', width);
            };

            //trigger animation
            setTimeout(function() {
                hideWord(headline.find('.is_on').eq(0))
            }, duration);
        });
    }

    function hideWord($word) {
        var nextWord = takeNext($word);

        if ($word.parents('.dt_heading').hasClass('dt_heading_2')) {
            var parentSpan = $word.parent('.dt_heading_inner');
            parentSpan.addClass('selected').removeClass('waiting');
            setTimeout(function() {
                parentSpan.removeClass('selected');
                $word.removeClass('is_on').addClass('is_off').children('i').removeClass('in').addClass('out');
            }, selectionDuration);
            setTimeout(function() {
                showWord(nextWord, typeLettersDelay)
            }, typeAnimationDelay);

        } else if ($word.parents('.dt_heading').hasClass('dt_heading_2') || $word.parents('.dt_heading').hasClass('dt_heading_3') || $word.parents('.dt_heading').hasClass('dt_heading_8') || $word.parents('.dt_heading').hasClass('dt_heading_9')) {
            var bool = ($word.children('i').length >= nextWord.children('i').length) ? true : false;
            hideLetter($word.find('i').eq(0), $word, bool, lettersDelay);
            showLetter(nextWord.find('i').eq(0), nextWord, bool, lettersDelay);

        } else if ($word.parents('.dt_heading').hasClass('dt_heading_6')) {
            $word.parents('.dt_heading_inner').animate({
                width: '2px'
            }, revealDuration, function() {
                switchWord($word, nextWord);
                showWord(nextWord);
            });

        } else if ($word.parents('.dt_heading').hasClass('dt_heading_4')) {
            $word.parents('.dt_heading_inner').removeClass('is-loading');
            switchWord($word, nextWord);
            setTimeout(function() {
                hideWord(nextWord)
            }, barAnimationDelay);
            setTimeout(function() {
                $word.parents('.dt_heading_inner').addClass('is-loading')
            }, barWaiting);

        } else {
            switchWord($word, nextWord);
            setTimeout(function() {
                hideWord(nextWord)
            }, animationDelay);
        }
    }

    function showWord($word, $duration) {
        if ($word.parents('.dt_heading').hasClass('dt_heading_2')) {
            showLetter($word.find('i').eq(0), $word, false, $duration);
            $word.addClass('is_on').removeClass('is_off');

        } else if ($word.parents('.dt_heading').hasClass('dt_heading_6')) {
            $word.parents('.dt_heading_inner').animate({
                'width': $word.width() + 10
            }, revealDuration, function() {
                setTimeout(function() {
                    hideWord($word)
                }, revealAnimationDelay);
            });
        }
    }

    function hideLetter($letter, $word, $bool, $duration) {
        $letter.removeClass('in').addClass('out');

        if (!$letter.is(':last-child')) {
            setTimeout(function() {
                hideLetter($letter.next(), $word, $bool, $duration);
            }, $duration);
        } else if ($bool) {
            setTimeout(function() {
                hideWord(takeNext($word))
            }, animationDelay);
        }

        if ($letter.is(':last-child') && $('html').hasClass('no-csstransitions')) {
            var nextWord = takeNext($word);
            switchWord($word, nextWord);
        }
    }

    function showLetter($letter, $word, $bool, $duration) {
        $letter.addClass('in').removeClass('out');

        if (!$letter.is(':last-child')) {
            setTimeout(function() {
                showLetter($letter.next(), $word, $bool, $duration);
            }, $duration);
        } else {
            if ($word.parents('.dt_heading').hasClass('dt_heading_2')) {
                setTimeout(function() {
                    $word.parents('.dt_heading_inner').addClass('waiting');
                }, 200);
            }
            if (!$bool) {
                setTimeout(function() {
                    hideWord($word)
                }, animationDelay)
            }
        }
    }

    function takeNext($word) {
        return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
    }

    function switchWord($oldWord, $newWord) {
        $oldWord.removeClass('is_on').addClass('is_off');
        $newWord.removeClass('is_off').addClass('is_on');
    }

	if ($('.dt_slider-carousel').length) {
        $('.dt_slider-carousel').owlCarousel({
			rtl: $("html").attr("dir") == 'rtl' ? true : false,
            loop: true,
			margin: 0,
			nav: true,
            dots: false,
			animateOut: 'fadeOut',
    		animateIn: 'fadeIn',
    		active: true,
			smartSpeed: 1000,
			autoplay: true,
			autoplayTimeout: 12000,
            navText: [ '<span></span>', '<span></span>' ],
            responsive:{
                0:{
                    nav: false,
                    items: 1
                },
                600:{
                    nav: false,
                    items: 1
                },
                800:{
                    items: 1
                },
                1024:{
                    items: 1
                }
            }
        });
    }
	 // Service
    if ($('.dt_service_carousel').length) {
        var $column = $(".dt_service").hasClass("dt_service--three") ? 5 : 
                  $(".dt_service").hasClass("dt_service--fifteen") ? 4 : 3;
        $(".dt_service_carousel").owlCarousel({
            rtl: $("html").attr("dir") == 'rtl' ? true : false,
            margin: 25,
            loop: true,
            dots: false,
            navText: ['<span></span>', '<span></span>'],
            autoHeight: true,
            autoplay: true,
            autoplayTimeout: 30000,
            smartSpeed: 2000,
            stagePadding: 17,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                576: {
                    items: 2,
                    nav: false
                },
                992: {
                    stagePadding: 17,
                    items: $column,
                    nav: false
                }
            }
        });
    }

    // Top Up
    if ($('.dt_uptop').length) {
        var progressPath = document.querySelector('.dt_uptop path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
        var updateProgress = function() {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);
        var offset = 50;
        var duration = 550;
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > offset) {
                $('.dt_uptop').addClass('active');
            } else {
                $('.dt_uptop').removeClass('active');
            }
        });
        $('.dt_uptop').on('click', function(event) {
            event.preventDefault();

            jQuery('html, body').animate({
                scrollTop: 0
            }, duration);
            return false;
        });
    }

	//Parallax Scene for Icons
	if($('.parallax-scene-1').length){
		var scene = $('.parallax-scene-1').get(0);
		var parallaxInstance = new Parallax(scene);
	}
	if($('.parallax-scene-2').length){
		var scene = $('.parallax-scene-2').get(0);
		var parallaxInstance = new Parallax(scene);
	}

    // Breadcrumb effect  
    if ($(".dt_pagetitle .canvas").length) {
        let cnvs = document.getElementById("canvas"),
        c2d = cnvs.getContext("2d");
        cnvs.width = window.innerWidth, cnvs.height = window.innerHeight;
        let particlesArray = [];
        window.addEventListener("resize", function() {
            cnvs.width = window.innerWidth, cnvs.height = window.innerHeight
        });
        let cursor = {
            x: null,
            y: null
        };
        cnvs.addEventListener("click", function(e) {
            cursor.x = e.x, cursor.y = e.y;
            for (let t = 0; t < 10; t++) particlesArray.push(new particles)
        }), cnvs.addEventListener("mousemove", function(e) {
            cursor.x = e.x, cursor.y = e.y;
            for (let t = 0; t < 10; t++) particlesArray.push(new particles)
        });
        class particles {
            constructor() {this.x = cursor.x, this.y = cursor.y, this.size = 10 * Math.random() + 1, this.speedX = 3 * Math.random() - 1.5, this.speedY = 3 * Math.random() - 1.5, this.color = "#ffffff"}
            update() {this.x += this.speedX, this.y += this.speedY, this.size > .2 && (this.size -= .1)}
            draw() {c2d.strokeStyle = this.color, c2d.lineWidth = .4, c2d.beginPath(), c2d.arc(this.x, this.y, this.size, 0, 2 * Math.PI), c2d.stroke()}
        }
        let hndlParticles = () => {
            for (let e = 0; e < particlesArray.length; e++) particlesArray[e].update(), particlesArray[e].draw(), particlesArray[e].size <= .3 && (particlesArray.splice(e, 1), e--)
        }
        let anim = () => {
            c2d.clearRect(0, 0, cnvs.width, cnvs.height), hndlParticles(), requestAnimationFrame(anim)
        }
        anim();
    }
    
	/* ==========================================================================
    Services Active Nine
    ========================================================================== */
    if ($(".dt_service--nine").length) {
        $('.dt_service--nine .dt_item_inner').hover(function () {
            $(this).find('.dt_item_hover').slideToggle(300);
            return false;
        });
        $('.dt_service--nine .dt_item_inner').hover(function () {
            $(this).find('.dt_item_holder .dt_item_title').slideToggle(300);
            $(this).find('.dt_item_holder .dt_item_content').slideToggle(300);
            $(this).find('.dt_item_icon').slideToggle(300);
            return true;
        });
    }
	
    /* ==========================================================================
    When document is loaded, do
    ========================================================================== */
	
	$(window).on('load', function() {
		site_preloader();
        initHeadline();
	});
    
})(jQuery);