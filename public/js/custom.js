var $j = jQuery.noConflict();


//=========== preloader  ===========/
$j(window).on('load', function () {
    var $jpreloader = $j('.loader'),
        $jspinner   = $jpreloader.find('.spinner');
    $jspinner.fadeOut();
    $jpreloader.delay(500).fadeOut('slow');
});
//=========== /preloader  ===========/



jQuery(function($j) {
	
	if ($j(window).scrollTop() > 50) {
		$j('.header').addClass('smaller');
	}
	
	
	
	$j(document).on( 'scroll', function(){
		if ($j(window).scrollTop() > 50) {
			$j('.header').addClass('smaller');
		} else $j('.header').removeClass('smaller');
	});


})




jQuery(function($) {
 $(window).scroll(function(){
  var pos = $(window).scrollTop() + 80;

  $('.main-nav').find('.active').removeClass('active');
  var $this = $('.main-nav a').first();
  var length = $('.main-nav a').length - 1;
  $('.main-nav a').each(function(index){
   id = $(this).attr('href');
   if($(id).offset().top >= pos) {
    $this.addClass('active');
    return false;
   } else {
    if(length == index) {
     $(this).addClass('active');
    }
   }
   $this = $(this);
  });
 });
});






	
jQuery(function($j) {
	
    var xH
    $j('.skin-1', this).hover(
    function () {
        xH = $j('.skin-1 .skin-flash').parent('.skin').children(".skin-img").css("height");
        xH = parseInt(xH);
        xH = xH - 375;
        xH = "-" + xH + "px";
        $j('.skin-1 .skin-flash').parent('.skin').children(".skin-img").css("top", xH);
    }, function () {
        $j('.skin-1 .skin-flash').parent('.skin').children(".skin-img").css("top", "0px");
        if(window.matchMedia('(max-width: 350px)').matches)
			{
				$j(this).parent('.skin').children(".skin-img").css("top", "8px");
			}
    });
})


jQuery(function($j) {
	
    var xH
    $j('.skin-2').hover(
    function () {
        xH = $j('.skin-flash', this).parent('.skin').children(".skin-img").css("height");
        xH = parseInt(xH);
        xH = xH - 365;
        xH = "-" + xH + "px";
        $j('.skin-flash', this).parent('.skin').children(".skin-img").css("top", xH);
   }, function () {
        $j('.skin-flash', this).parent('.skin').children(".skin-img").css("top", "0px");
        if(window.matchMedia('(max-width: 350px)').matches)
			{
				$j(this).parent('.skin').children(".skin-img").css("top", "8px");
			}
    });
})



// jQuery(function($j) {
	
// 	   $j('.main-nav li').click(function(){
// 	  	$j('.main-nav li a').removeClass('act');
// 	});

// })

jQuery(function($j) {

    function onScrollInit(items, container) {
        items.each(function() {
            var element = $j(this),
                animationClass = element.attr('data-animation'),
                animationDelay = element.attr('data-animation-delay');

            element.css({
                '-webkit-animation-delay': animationDelay,
                '-moz-animation-delay': animationDelay,
                'animation-delay': animationDelay
            });

            var trigger = (container) ? container : element;

            trigger.waypoint(function() {
                element.addClass('animated').addClass(animationClass);
            }, {
                triggerOnce: true,
                offset: '90%'
            });
        });
    }

    onScrollInit($j('.animation'));
    onScrollInit($j('.staggered-animation'), $j('.staggered-animation-container'));
});

jQuery(function($j) {
	
    "use strict";
	
	var windowW = window.innerWidth || $j(window).width();
	
	if (windowW > 767){
		if ($j('.main-nav').length){
			$j('.main-nav li.scroll-link a').click(function(e) {
				e.preventDefault();
				var targ = $j(this).attr('href');
				var posTop = $j(targ).offset().top - $j('.main-nav').outerHeight();
				$j('body,html').animate({
					'scrollTop': posTop
				});
			});
			var waypoints = $j('section').waypoint(function(direction) {
				if (direction === 'down') {
					var panel;
					panel = this.element.id;
					$j('.main-nav li.active').removeClass('active');
					$j(".main-nav li[data-target ='"+panel+"']").addClass('active');
				}
			}, {
				offset: 65
			})
			var waypoints = $j('section').waypoint(function(direction) {
				if (direction === 'up') {
					var panel;
					panel = this.element.id;
					console.log(panel + ' hit') ;
					$j('.main-nav li.active').removeClass('active');
					$j('.main-nav li[data-target ="'+panel+'"]').addClass('active');
				}
			}, {
				offset: -1
			})
		}
	}
});















/*! device.js 0.2.7 */
(function(){var a,b,c,d,e,f,g,h,i,j;b=window.device,a={},window.device=a,d=window.document.documentElement,j=window.navigator.userAgent.toLowerCase(),a.ios=function(){return a.iphone()||a.ipod()||a.ipad()},a.iphone=function(){return!a.windows()&&e("iphone")},a.ipod=function(){return e("ipod")},a.ipad=function(){return e("ipad")},a.android=function(){return!a.windows()&&e("android")},a.androidPhone=function(){return a.android()&&e("mobile")},a.androidTablet=function(){return a.android()&&!e("mobile")},a.blackberry=function(){return e("blackberry")||e("bb10")||e("rim")},a.blackberryPhone=function(){return a.blackberry()&&!e("tablet")},a.blackberryTablet=function(){return a.blackberry()&&e("tablet")},a.windows=function(){return e("windows")},a.windowsPhone=function(){return a.windows()&&e("phone")},a.windowsTablet=function(){return a.windows()&&e("touch")&&!a.windowsPhone()},a.fxos=function(){return(e("(mobile;")||e("(tablet;"))&&e("; rv:")},a.fxosPhone=function(){return a.fxos()&&e("mobile")},a.fxosTablet=function(){return a.fxos()&&e("tablet")},a.meego=function(){return e("meego")},a.cordova=function(){return window.cordova&&"file:"===location.protocol},a.nodeWebkit=function(){return"object"==typeof window.process},a.mobile=function(){return a.androidPhone()||a.iphone()||a.ipod()||a.windowsPhone()||a.blackberryPhone()||a.fxosPhone()||a.meego()},a.tablet=function(){return a.ipad()||a.androidTablet()||a.blackberryTablet()||a.windowsTablet()||a.fxosTablet()},a.desktop=function(){return!a.tablet()&&!a.mobile()},a.television=function(){var a;for(television=["googletv","viera","smarttv","internet.tv","netcast","nettv","appletv","boxee","kylo","roku","dlnadoc","roku","pov_tv","hbbtv","ce-html"],a=0;a<television.length;){if(e(television[a]))return!0;a++}return!1},a.portrait=function(){return window.innerHeight/window.innerWidth>1},a.landscape=function(){return window.innerHeight/window.innerWidth<1},a.noConflict=function(){return window.device=b,this},e=function(a){return-1!==j.indexOf(a)},g=function(a){var b;return b=new RegExp(a,"i"),d.className.match(b)},c=function(a){var b=null;g(a)||(b=d.className.replace(/^\s+|\s+$/g,""),d.className=b+" "+a)},i=function(a){g(a)&&(d.className=d.className.replace(" "+a,""))},a.ios()?a.ipad()?c("ios ipad tablet"):a.iphone()?c("ios iphone mobile"):a.ipod()&&c("ios ipod mobile"):a.android()?c(a.androidTablet()?"android tablet":"android mobile"):a.blackberry()?c(a.blackberryTablet()?"blackberry tablet":"blackberry mobile"):a.windows()?c(a.windowsTablet()?"windows tablet":a.windowsPhone()?"windows mobile":"desktop"):a.fxos()?c(a.fxosTablet()?"fxos tablet":"fxos mobile"):a.meego()?c("meego mobile"):a.nodeWebkit()?c("node-webkit"):a.television()?c("television"):a.desktop()&&c("desktop"),a.cordova()&&c("cordova"),f=function(){a.landscape()?(i("portrait"),c("landscape")):(i("landscape"),c("portrait"))},h=Object.prototype.hasOwnProperty.call(window,"onorientationchange")?"orientationchange":"resize",window.addEventListener?window.addEventListener(h,f,!1):window.attachEvent?window.attachEvent(h,f):window[h]=f,f(),"function"==typeof define&&"object"==typeof define.amd&&define.amd?define(function(){return a}):"undefined"!=typeof module&&module.exports?module.exports=a:window.device=a}).call(this);










