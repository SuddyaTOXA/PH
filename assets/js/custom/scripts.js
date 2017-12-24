$(function(){
	// header fade
	$(function() {
	   var header = $('#header');
	   setTimeout(function(){
	   	header.addClass('show');
	   },800);
	});

	//header background on scroll
	var header = $('#header');
	$(window).on('scroll', function() {
	   var st2 = $(this).scrollTop();
		   		
	   if (st2 > 0) {
	      // console.log(st2);
	      header.addClass('scrolling');
	      
	   } else {
	   	header.removeClass('scrolling');
	   }

	});
    // for smooth scroll
	if ( $('a').is('.smooth-scroll') ) {
        smoothScroll.init({
            selector: '.smooth-scroll', // Selector for links (must be a class, ID, data attribute, or element tag)
            speed: 500, // Integer. How fast to complete the scroll in milliseconds
            easing: 'easeInQuad', // Easing pattern to use
            offset: 130 // Integer. How far to offset the scrolling anchor location in pixels
        });
    }

	$(document).ready(function() {
        // for burger menu
        $('.mobile-menu-toggle, .mobile-menu-overlay').on('click', function(){
            $('.mobile-menu-toggle').toggleClass('active');
            $('.mobile-menu-wrap').toggleClass('showing');
            $(document.body).toggleClass('overflow');
        });

        //for banner link
		$('.banner-list li').on('click', function () {
			var tab = $(this).data('tabId'),
				tabName = $(this).data('tabName'),
				tabBlock = $("[data-tab="+tab+"]"),
                nameList = tabBlock.find('.tab-name-list li'),
				currentName = tabBlock.find("[data-tab-name="+tabName+"]"),
                contentList = tabBlock.find('.tab-content-list li'),
                currentContent = tabBlock.find("[data-tab-content="+tabName+"]");

            nameList.removeClass('active');
            contentList.removeClass('show');
            currentName.addClass('active');
            currentContent.addClass('show');
        });

        //for tabs
		$('.tab-name-list li').on('click', function () {
			var tabId = $(this).data('tabName'),
				nameBox = $(this).parent(),
				nameList = nameBox.find('li'),
                contentBox =  nameBox.next(),
				contentList =contentBox.find('li'),
				currentContent = contentBox.find("[data-tab-content="+tabId+"]");

			nameList.removeClass('active');
			contentList.removeClass('show');
			$(this).addClass('active');
			currentContent.addClass('show');
        });

        // for modal
		if ( $('a').is('.popup-vimeo')) {
            $('.popup-vimeo').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        }

		function stopVideo() {
			var  slideList = $('.gallery-thumbs').find('.swiper-slide');
            // swiper-slide-active
			slideList.each(function (index) {
				$('video')[index].pause();
                console.log( index + " - STOP");
			});
		}

		if ( $('div').is('.gallery-top') ) {
            var galleryTop = new Swiper('.gallery-top', {
                spaceBetween: 2,
                autoplay: 7000,
                effect: 'fade',
                onInit: function (swiper) {
                    console.log("initialized");
                    $('.gallery-top').addClass('started');
                    // $('.gallery-thumbs').addClass('started');
                },

                onSlideChangeEnd: function (swiper) {
                    var slideList = $('.gallery-top').find('.swiper-slide');

                    stopVideo();

                    slideList.each(function (index) {
                        if ($(this).hasClass('swiper-slide-active')) {
                            $('video')[index].play();
                            console.log(index + " - PLAY");
                            console.log('------------------');
                        }
                    });
                }
            });
        }

		// for vimeo video
		$('.play-vimeo').on('click', function (event) {
			var infoBox = $(this).parent(),
				infoBoxContainer = infoBox.parents('.container'),
				videoBox = infoBox.parents('.swiper-slide').find('.vimeo-block'),
				videoId = videoBox.attr('id');

			event.preventDefault();

			console.log('------------------');
			console.log('Watch Vimeo');
            infoBoxContainer.addClass('vimeo-show');
            galleryTop.stopAutoplay();
            stopVideo();
			videoBox.addClass('show');

            var player = new Vimeo.Player(videoId);
            player.play().then(function() {
                console.log('played the the ' + videoId + ' video!');
            });

			//close Vimeo
            $('.gallery-thumbs').on('click', function () {
                var slideList = $('.gallery-top').find('.swiper-slide');

                infoBoxContainer.removeClass('vimeo-show');
                galleryTop.startAutoplay();
                videoBox.removeClass('show');

                player.pause().then(function() {
                    console.log('pause the ' + videoId + ' video!');
                });

                slideList.each(function (index) {
                    if ($(this).hasClass('swiper-slide-active')) {
                        $('video')[index].play();
                        console.log('------------------');
                        console.log('PLAY - ' + index);
                    }
                });
            });
        });
	});

});