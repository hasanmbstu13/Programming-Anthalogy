$(document).ready(function(){
	var isMobile = $(window).width() > 768 ? false : true;
	if(isMobile) initSliderMobile();
});

$(document).ready(function(){
	initAboutMenuItem();
	initPressMenuItem();
	addMobileClass();
	initScroll();
	footerToBottom();
	mainAccordion();
	initTabs();
	mobileMenu();
	initPopup();
	initIsotop();
	initInstOverlay();
	mainVideo();
	initMobileDropdown();
	initGalleryMobileDropdown();
	initLazyLoad();
	initBackgroundResize();
	initAdvItemsFade();
//	initShowCookie();
	initDatesActiveMenu();
});
$(window).load(function(){
	initTripCheck();
	initSlider();
	initIsotop();
	initCookie();
	initShowCookie();
});
$(window).resize(function(){
	addMobileClass();
	mainAccordion();
	// advSubSliderNav();
});
function initAboutMenuItem(){
	var aboutItem = $('.main-nav li a:contains("About")');
	var submenu = $('.menu-about-page-tabs-container');
	
	if(submenu.find('li').hasClass('current-menu-item')){
		aboutItem.closest('li').addClass('current-menu-item');
	}
}
function initPressMenuItem(){
	var pressItem = $('.main-nav li a:contains("Press")');
	var submenu = $('.menu-press-page-tabs-container');
	
	if(submenu.find('li').hasClass('current-menu-item')){
		pressItem.closest('li').addClass('current-menu-item');
	}
}
function initScroll(){
	initSlide($(".scrolldown-btn"));
	initSlide($(".scrolltop-btn"));
}
function initBackgroundResize() {
	jQuery('.info-holder .img-holder, .so-widget-sow-image, .block-gallery .grid-item img, .adventures-slider li img').each(function() {
		ImageStretcher.add({
			container: this,
			image: 'img'
		});
	});
}
// SCROLL BOTTOM OR TOP

function initSlide(el){
	var btn = el,
		header = $("#header");

	if(btn.length){
		if(btn.attr("class") === "scrolldown-btn"){
			btn.on("click", function(){
				var header_height = header.outerHeight(),
					parent = $(this).parents(".scroll-holder");
				$("html, body").animate({scrollTop: parent.offset().top + parent.outerHeight()}, 1000);
			});
		} else{
			if(btn.attr("class") === "scrolltop-btn"){
				btn.on("click", function(){
					var parent = $(this).parents(".scroll-holder");

					$("html, body").animate({scrollTop: parent.offset().top}, 1000);
				});
			}
		}
	}
}

// POPUP

function initPopup(){
	var popup = $(".main-video .play-video"),
		popupAdv = $(".adventures-slider .play-video"),
		popupPressHome = $(".nav-slider .press-popup"),
		popupPress = $(".publication-item .press-popup"),
		gallery = $(".block-gallery .publications-list a");

	var pressSliderHome = null;
	var pressSlider = null;

	popup.colorbox({
		fixed: true,
		inline: true,
		maxWidth: "100%",
		current: false,
		close: "exit",
		width: "100%",
		height: "100%",
		onComplete:function(){
			
			var video = $(".home-popup-video video").get(0);
			var video2 = $(".full-video video").get(0);
			$(".wp-video").width("auto");

			$(video).width("100%").height($(video).parents("#colorbox").height());

			video2.pause();
			video.play();
			video.onended = function() {
				$.colorbox.close();
			};
			
		},
		onClosed:function(){
			var video = $(".home-popup-video video").get(0);
			var video2 = $(".full-video video").get(0);
			video2.play();
			video.pause();
			
		}
	});
	popupAdv.colorbox({
		fixed: true,
		inline: true,
		maxWidth: "100%",
		current: false,
		close: "exit",
		onComplete:function(){
			var video = document.getElementById("popup-video");
			video.play();
		},
		onClosed:function(){
			var video = document.getElementById("popup-video");
			video.pause();
		}
	});
	popupPress.colorbox({
		inline: true,
		closeButton:false,
		height:'100%',
		width:'100%',
		onComplete:function(){
			var press_slider = $( $(this).attr('href') ).find('.press-slider');
			pressSlider = press_slider.bxSlider({
				infiniteLoop:false,
				pager:false,
				responsive:false,
				width:'90%'
			});
			$('.close-popup').click(function(){
				$.colorbox.close();
				return false;
			});
		},
		onClosed:function(){
			pressSlider.destroySlider();
			pressSlider = null;
		},
		fixed: true
	});
	popupPressHome.colorbox({
		inline: true,
		closeButton:false,
		height:'100%',
		width:'100%',
		onComplete:function(args){
			var press_slider = $( $(this).attr('href') ).find('.press-slider');
			pressSliderHome = press_slider.bxSlider({
				infiniteLoop:false,
				pager:false,
				responsive:false,
				width:'90%'
			});
			$('.close-popup').click(function(){
				$.colorbox.close();
				return false;
			});
		},
		onClosed:function(args){
			pressSliderHome.destroySlider();
			pressSliderHome = null;
		},
		fixed: true
	});
	var isMobile = $(window).width() > 768 ? false : true;
	if(!isMobile){

			gallery.colorbox({
				inline: true,
				fixed: true,
				rel:'group1',
				current: false,
				closeButton:false,
				width: "100%",
				height: "100%",
				onComplete:function(args){
					$('.close-popup').click(function(){
						$.colorbox.close();
						return false;
					});
					
					var video = $( $(this).attr('href') ).find('video');
					if(video.length != 0){
						video.get(0).play();
					}
					
					$('.gallery-video video').each(function(){ 
						//var videoSource = $(this).attr('data-video-source');
						//$(this).attr('src', videoSource);
						var ID = $(this).attr('id');
						var video = document.getElementById(ID);
						video.play();
					});
				},
				onClosed:function(args){
					var video = $( $(this).attr('href') ).find('video');
					if(video.length != 0){
						video.get(0).pause();
					}
					
				}
			});

		
	}
	
}

// ADD CLASS TO BODY IF MOBILE

function addMobileClass(){
	var btn = $(".mobile-menu"),
		body = $("body");

	if(btn.is(":visible")){
		body.addClass("mobile");
	}
	else{
		body.removeClass("mobile");
	}
}

// MOBILE MENU

function mobileMenu(){
	var btn = $(".mobile-menu"),
		header = $("#header");

	btn.click(function(){
		if(header.hasClass("menu-open")){
			header.removeClass("menu-open");
		}
		else{
			header.addClass("menu-open");
		}
	});
}

// SLIDER

function initSlider(){
	var nav_slider = $(".nav-slider");
	var	pager_slider = $(".pager-slider");
	var	adv_slider = $(".adv-slider");
	var adv_sub_slider = $(".adv-sub-slider");
	var arr = [];
	slider_arr = [];
	// nav slider
	if(nav_slider.children("li").length > 1){
		nav_slider.bxSlider({
			auto:true,
	  		pause:3000,
			controls: false,
			adaptiveHeight:false
		});
	}

	$(".adventures-slider").width($("body").width() - $(".adventures-sidebar").width());
	
	// pager slider
	if(pager_slider.children("li").length > 1){
		pager_slider.bxSlider({
      auto:true,
      pause:5000,
			controls: false,
			adaptiveHeight:false
		});
	}
	// adventures slider
	if(adv_slider.children("li").length > 1){
		var adv_slider_init = adv_slider.bxSlider({
			//pager: true,
			pagerCustom:'.aside-slider-nav',
			infiniteLoop:false,
			hideControlOnEnd:true,
			onSliderLoad: function(){
				var pager = $(".bx-pager .bx-pager-item"),
					slides = adv_slider.find("li").not(".bx-clone"),
					adv_menu = $(".adventures-menu li[class^='menu']").find("a");

					adv_slider.parents(".bx-viewport").height($(window).height());
					adv_slider.children("li").height($(window).height());

					$(window).resize(function () {
						adv_slider.parents(".bx-viewport").height($("html").height());
						adv_slider.children("li").height($("html").height());

						$(".adventures-slider").width($("body").width() - $(".adventures-sidebar").width());
					});

//				for(var i=0; i<pager.length; i++){
//					var src = $(slides[i]).find("img").attr("src");
//					$(pager[i]).prepend("<img class='pager-img' src='" + src + "'>");
//
//					if ($(slides[i]).find(".slide-text-holder").length){
//						$(pager[0]).addClass("video-pager");
//					}
//				}
				adv_menu.on("click", function(){
					//adv_slider_init.goToSlide(adv_menu.index($(this)));
					//adv_menu.removeClass('active');
					//$(this).addClass("active");
					//console.log($(this));
					//return false;
					
				});
				//initActiveForPager();
			},
			onSlideAfter:function(){
				//initActiveForPager();
			}
		});
	}

	adv_slider.children("li").find(".adv-sub-slider").each(function () {
		var adv_sub_slider_init = $(this).bxSlider({
			pager: false,
			slideWidth: 85,
			minSlides: 2,
			maxSlides: Math.round($(".adv-sub-slider-wrapper").width() / 105) - 1,
			moveSlides: 1,
			slideMargin: 20,
			onSliderLoad: function () {
				
			}
		});

		advSubSliderNav(adv_sub_slider_init);
	});
	
	// init bx for adventures carousel
	initSubSliderPopup();
}

function initSubSliderPopup() {
	// init colorbox for adventures carousel

	$('.adv-sub-slider-wrapper').each(function () {
		$(this).find(".slide").each(function () {
			$(this).find(".adventures_colorbox").colorbox({
				width: "100%",
				height: "100%",
				returnFocus: false
			});
		});
	});

	$(window).resize(function () {
		$('.adv-sub-slider-wrapper').each(function () {
			$(this).find(".slide").each(function () {
				$(this).find(".adventures_colorbox").colorbox({
					width: "100%",
					height: "100%",
					returnFocus: false
				});
			});
		});
	});
}

function advSubSliderNav(el) {
	var slider = $(".adv-sub-slider");

	slider_arr.push(el);

	function advSubSliderNavResize() {
		slider.each(function () {
			var slide = $(this).find(".slide").not(".bx-clone"),
				slide_clone = $(this).find(".bx-clone"),
				slider_width = $(this).parents(".adv-sub-slider-wrapper").width(),
				slides_width = (slide.length+1) * 105;

			if (slides_width < slider_width) {
				$(this).parents(".adv-sub-slider-wrapper").addClass("pager-hidden");
			} else {
				$(this).parents(".adv-sub-slider-wrapper").removeClass("pager-hidden");
			}
		});

		for (var i=0; i<slider_arr.length; i++) {
			slider_arr[i].reloadSlider({
				pager: false,
				slideWidth: 85,
				minSlides: 2,
				maxSlides: Math.round($(".adv-sub-slider-wrapper").width() / 105) - 1,
				moveSlides: 1,
				slideMargin: 20
			});
		}
	}

	advSubSliderNavResize();

	$(window).resize(function () {
		advSubSliderNavResize();
	});
}

function initSliderMobile(){
	var article_slider = $(".article-holder > div > div");
	
	if(article_slider.children("article").length > 1){
		article_slider.bxSlider({
			controls: false,
			adaptiveHeight:false,
			pager:false
		});
	}
}
// Synchronization pager
function initActiveForPager() {
	var bottomNav = $('.adventures-slider .bx-pager-item a.active');
	var bottomNavNumber = bottomNav.attr('data-slide-index');
	
	var asideNav = $('.aside-slider-nav a');
	
	asideNav.removeClass('active');
	
	asideNav.each(function(){
		var asideNavNumber = $(this).attr('data-slide-index');
		if(asideNavNumber == bottomNavNumber){
			$(this).addClass('active');
		}
	})
}

// HOME VIDEO AND FULL SIZE VIDEO

function mainVideo(){
	var video = $(".full-video video").get(0),
		video_holder = $(".main-video"),
		window_height = window.innerHeight,
		window_width = window.innerWidth,
		video_height = $(video).height(),
		video_width = $(video).width(),
		video_btn = video_holder.find(".video-btn");
		
	video_holder.height(window_height);
	
	var isMobile = $(window).width() > 640 ? false : true;
	
	function initStopVideo(){
		if(isMobile){
	 		video.pause();
	 	}
	 	else{
	 		video.play();
	 	}
	}
	if($(".full-video video").length > 0){
		initStopVideo();
	}
	
 	

	$(window).resize(function(){
		window_height = window.innerHeight,
		window_width = window.innerWidth;

		video_holder.height(window_height);
		
		if($(".full-video video").length > 0){
			//initStopVideo();
		}
	});

	video_btn.on("click", function(){
		if(video.paused){
			video.play();
			$(this).removeClass("play").addClass("pause").text(pause_text);
		} else{
			video.pause();
			$(this).removeClass("pause").addClass("play").text(play_text);
		}
		return false;
	});
}

// FOTER TO BOTTOM

function footerToBottom(){
	var footer = $("#footer"),
		content = $("#content");
	
	if (footer.is(":visible") && footer.height()<content.height()){

		footer.css("margin-top", -footer.outerHeight());
		content.css("padding-bottom", footer.outerHeight());
		
		$(window).resize(function(){
			footer.css("margin-top", -footer.outerHeight());
			content.css("padding-bottom", footer.outerHeight());
		});
	}
}

// HOME PAGE ACCORDION

function mainAccordion(){
	/*
	if($('body').hasClass("mobile") && $('body').hasClass("home")){
			location.reload();
		}*/
	
	var holder = $(".home-accordion .main-accordion"),
		item = holder.find(".item"),
		window_width = $(window).width(),
		item_width = window_width/item.length,
		item_btn = item.find(".btn.show-section"),
		close_btn = item.find(".close-btn"),
		hover_width,
		flag = true,
		body = $("body");

	holder.show();	
	var hoverItem = {
		desktop: function(){
			holder.addClass("desktop-accordion");
			item.width(item_width);

			$(window).resize(function(){
				window_width = $(window).width(),
				item_width = window_width/item.length;

				item.width(item_width);
			});

			item.on({
				mouseenter: function(){
					var text_holder = $(this).find(".text-holder");

					if(!($(this).hasClass("opened"))){

						$(this)
						.addClass("expand")
						.width(item_width + 50);

						if($(this).index()-1 > $(this).length/2){
							holder.css("margin-left", "-50px");
						}

						hover_width = item_width + 50;
					}
				},
				mouseleave: function(){
					var text_holder = $(this).find(".text-holder");

					if(!($(this).hasClass("opened"))){
						item
						.removeClass("expand")
						.width(item_width);

						holder.css("margin-left", "0");
					}
				}
			});
		},
		
		mobile: function(){
					holder.addClass("mobile-accordion");
		
					item.on({
						click: function(){
							item.removeClass("expand");
							$(this).addClass("expand");
						}
					});
				}
		
	}

	if(!(body.hasClass("mobile"))){
		hoverItem.desktop();
	} 
	else{
			hoverItem.mobile();
		}
	

	item_btn.on({
		click: function(){
			var this_item = $(this).parents(".item"),
				holder_margin = Math.abs(parseInt(holder.css("margin-left"))),
				active_block = this_item.find(".open-item"),
				text_holder = this_item.find(".text-holder");

			holder.addClass("animated");

			setTimeout(function(){
				holder.removeClass("animated");
			},500);

			if(this_item.offset().left !== 0){
				holder.css("margin-left", -(this_item.offset().left + holder_margin));
			}

			this_item
			.width($(window).width())
			.removeClass("expand")
			.addClass("opened");

			active_block.each(function(){
				$(this).addClass("animated " + $(this).attr("data-animate"));
			});

			return false;
		}
	});

	close_btn.on({
		click: function(){
			var this_item = $(this).parents(".item"),
				active_block = this_item.find(".open-item"),
				text_holder = this_item.find(".text-holder");

			holder.addClass("animated");

			setTimeout(function(){
				holder.removeClass("animated");
			},500);

			active_block.each(function(){
				$(this).removeClass("animated " + $(this).attr("data-animate"));
			});

			this_item
			.width(item_width)
			.removeClass("opened");

			holder.css("margin-left", "0");
		}
	});
}

function initTabs() {
	$( "#tabs" ).tabs();
}
function initIsotop() {
	var $grid;
	
	$grid = $('.grid').isotope({
		itemSelector: '.grid-item',
		masonry: {
			columnWidth: 1,
			transformsEnabled: false
		}
	});
	window.addEventListener("orientationchange", function() {
		$grid.isotope('destroy');

		$grid = $('.grid').isotope({
			itemSelector: '.grid-item',
			masonry: {
				columnWidth: 1,
				transformsEnabled: false
			}
		});
	});
	// filter functions
	// bind filter button click
	$('.filters-button-group').on( 'click', 'button', function() {
		var filterValue = $( this ).attr('data-filter');
		// use filterFn if matches value
		$grid.isotope({ filter: filterValue });
	});
	// change is-checked class on buttons
	$('.button-group').each( function( i, buttonGroup ) {
		var $buttonGroup = $( buttonGroup );
		$buttonGroup.on( 'click', 'button', function() {
			$buttonGroup.find('.is-checked').removeClass('is-checked');
			$( this ).addClass('is-checked');
		});
	});
	
}
function initInstOverlay(){
	var item = $('.jr-insta-thumb li > a');
	
	
	item.each(function(){
		var link = $(this).attr('href');
		$(this).hover(function(){
			$(this).append('<a href="'+ link +'" target="_blank" class="inst-overlay"><span>View on instagram</span></a>');
		},function(){
			$('.inst-overlay').remove();
		})
	})
	
}
function initMobileDropdown(){
	var issueURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
	var issueList = $('#menu-about-page-tabs, #menu-press-page-tabs');
	
	
	var issueLink = issueList.find('a');
	issueLink.each(function(){
		var currentHref = $(this).attr('href');
		if(currentHref == issueURL){
			issueLink.removeClass('active');
			$(this).addClass('active');
		}
	})
	
	
	var langText = issueList.find('a.active').text();

	issueList.before('<div class="current-issue"><span>'+langText+'</span><span class="arrow"></span></div>');
	
	$(".current-issue").click(function(){
		$(".tabs-navigation").toggleClass("open");
	});
}
function initGalleryMobileDropdown(){
	var isMobile = $(window).width() > 769 ? false : true;
	
	if(isMobile){
		var filterList = $('.gallery-nav');
	
	
		var filterLink = filterList.find('button');
		var langText = filterList.find('.is-checked').text();

		filterList.before('<div class="current-issue"><span>'+ langText +'</span><span class="arrow"></span></div>');
		
		$(".current-issue").click(function(){
			$(".block-gallery").toggleClass("open");
		});
		
		filterLink.click(function(){
			currentText = $(this).text();
			$(".current-issue").html('<span>' + currentText + '</span>' +'<span class="arrow"></span>');
			$(".block-gallery").toggleClass("open");
		})
	}
}
function initTripCheck(){
	function getQueryVariable(variable) {
		var query = window.location.search.substring(1);
		var query = encodeURIComponent(query);

		
		var vars = query.split("&");
		for (var i=0;i<vars.length;i++) {
			var pair = vars[i].split("%3D");
			if (pair[0] == variable) {
				return pair[1];
			}
		}
	}

	var selectedTrip = getQueryVariable('trip');

	selectedTrip = decodeURIComponent(selectedTrip);
	selectedTrip = decodeURI(selectedTrip);

	
	var currectOpt = $('.dates-list select option');

	currectOpt.each(function(){
		var currentVal = $(this).val();
		if(currentVal == selectedTrip){
			$(this).attr('selected', 'selected');
		}
	})
}
//GALLERY PAGE IMAGE LAZY LOAD
function initLazyLoad(){
		//$("img.lazy").lazyload();
	}

/*
 * Image Stretch module
 */
var ImageStretcher = {
	getDimensions: function(data) {
		// calculate element coords to fit in mask
		var ratio = data.imageRatio || (data.imageWidth / data.imageHeight),
			slideWidth = data.maskWidth,
			slideHeight = slideWidth / ratio;

		if(slideHeight < data.maskHeight) {
			slideHeight = data.maskHeight;
			slideWidth = slideHeight * ratio;
		}
		return {
			width: slideWidth,
			height: slideHeight,
			top: (data.maskHeight - slideHeight) / 2,
			left: (data.maskWidth - slideWidth) / 2
		};
	},
	getRatio: function(image) {
		if(image.prop('naturalWidth')) {
			return image.prop('naturalWidth') / image.prop('naturalHeight');
		} else {
			var img = new Image();
			img.src = image.prop('src');
			return img.width / img.height;
		}
	},
	imageLoaded: function(image, callback) {
		var self = this;
		var loadHandler = function() {
			callback.call(self);
		};
		if(image.prop('complete')) {
			loadHandler();
		} else {
			image.one('load', loadHandler);
		}
	},
	resizeHandler: function() {
		var self = this;
		jQuery.each(this.imgList, function(index, item) {
			if(item.image.prop('complete')) {
				self.resizeImage(item.image, item.container);
			}
		});
	},
	resizeImage: function(image, container) {
		this.imageLoaded(image, function() {
			var styles = this.getDimensions({
				imageRatio: this.getRatio(image),
				maskWidth: container.width(),
				maskHeight: container.height()
			});
			image.css({
				width: styles.width,
				height: styles.height,
				marginTop: styles.top,
				marginLeft: styles.left
			});
		});
	},
	add: function(options) {
		var container = jQuery(options.container ? options.container : window),
			image = typeof options.image === 'string' ? container.find(options.image) : jQuery(options.image);

		// resize image
		this.resizeImage(image, container);

		// add resize handler once if needed
		if(!this.win) {
			this.resizeHandler = jQuery.proxy(this.resizeHandler, this);
			this.imgList = [];
			this.win = jQuery(window);
			this.win.on('resize orientationchange', this.resizeHandler);
		}

		// store item in collection
		this.imgList.push({
			container: container,
			image: image
		});
	}
};
function initAdvItemsFade(){
	var time = 0;
	$('.aside-slider-nav li').each(function() {
	    $(this).delay(time).fadeIn(700);
	    time += 700;
	});
}

function initCookie(){
/*
	var popup = $('#wpca-box, #cookie-law-info-bar');
	
	var popupLink = popup.find('a');
	popupLink.click(function(){
		document.cookie='wpca_ok2=1; path=/; expires=Thu, 18 Dec 2020 12:00:00 UTC';
		popup.fadeOut();
		$('body').removeClass('show-cookies');
	})
*/
}
function initShowCookie(){
/*
	var popup = $('#wpca-box, #cookie-law-info-bar');
	
	if($.cookie('wpca_ok2') != true){
		popup.fadeIn();
		$('body').addClass('show-cookies');
	}
*/

	var cookieBar = $('#cookie-law-info-bar');
	if(cookieBar.length && cookieBar.css('display') != 'none'){
		$('body').addClass('show-cookies');
	}else{
		$('body').removeClass('show-cookies');
	}

	cookieBar.find('a').click(function(){
		$('body').removeClass('show-cookies');
	})
	

}

function initDatesActiveMenu(){
	var div = $('div');
	var mainMenu = $('#menu-main-menu');
	var menuItem = mainMenu.find('a[href *= dates]');

	
	if(div.is('.block-dates')){
		menuItem.closest('li').addClass('current-menu-item');
	};

}
