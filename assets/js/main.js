 /*================================================
 * Template Name: Hotel Zante - Hotel WordPress Theme
 * Version: 1.2
 * Author Name: Jomin Muskaj (Eagle-Themes)
 * Author URI: eagle-themes.com
 =================================================*/

 (function($) {
   "use strict";

   /*========== LOADING PAGE ==========*/
   $(window).on('load', function() {
     $("#loading").fadeOut(500);

     $("#text_rotating").Morphext({
       animation: "fadeInDown",
       separator: ",",
       speed: 5000,
       complete: function() {}
     });

   });


   /*Document is Raedy */
   $(document).ready(function() {

     /*========== WOW ==========*/
     var wow = new WOW({
       boxClass: 'wow',
       animateClass: 'animated',
       offset: 0,
       mobile: true,
       live: true,
       callback: function(box) {}
     });
     wow.init();


     /*========== MENU ==========*/
     $(window).on("scroll", function() {

       var header = $('header');
       var topmenu = $('.top_menu');
       var windowheight = $(this).scrollTop();
       var menuheight = header.outerHeight();
       var topmenuheight = 0;
       var adminbar = $('#wpadminbar');

       adminbar.css('position', 'fixed');

       if (adminbar.length && adminbar.is(':visible')) {
         header.css('top', adminbar.height());
       }

       if (topmenu.length > 0) {
         var topmenuheight = topmenu.outerHeight();
       }
       var fixedheight = topmenuheight;

       if (header.length > 0) {
         if ((windowheight > fixedheight) && header.hasClass("fixed")) {

           header.addClass('navbar-fixed-top');

           if (!header.hasClass("transparent")) {
             header.next("*").css("margin-top", menuheight);
           }
           if (header.hasClass("fixed")) {
             header.addClass("scroll");
             header.addClass("nav_bg");
           }

           // Logo
           $("header .light").addClass("nodisplay");
           $("header .dark").removeClass("nodisplay");

         } else {
           header.removeClass("navbar-fixed-top");
           if (!header.hasClass("transparent")) {
             header.next("*").css("margin-top", "0");
           }
           if (header.hasClass("fixed")) {
             header.removeClass("scroll");
             header.removeClass("nav_bg");
           }

           $("header .dark").addClass("nodisplay");
           $("header .light").removeClass("nodisplay");

           if (adminbar.length && adminbar.is(':visible')) {
             header.css('top', topmenuheight);
           }

         }
       }
     });

     $(function() {
       function toggleNavbarMethod() {
         if ($(window).width() > 992) {
           $(".dropdown").on({
             mouseenter: function() {
               $(this).addClass("open");
               $('b', this).toggleClass("caret caret-up");
             },
             mouseleave: function() {
               $(this).removeClass("open");
               $('b', this).toggleClass("caret caret-up");
             }
           });
         } else {
           $('.dropdown').off('mouseover').off('mouseout');
           $('.dropdown-toggle')

             .on('click', function(e) {
               $('b', this).toggleClass("caret caret-up");
             });

         }
       }
       toggleNavbarMethod();
       $(window).on("resize", (toggleNavbarMethod));

       $(".navbar-toggle").on("click", function() {
         $(this).toggleClass("active");
       });
     });

     /*========== MOBILE MENU ==========*/
     $('.mobile_menu_btn').jPushMenu({
       closeOnClickLink: false
     });
     $('.dropdown-toggle').dropdown();
     // IF NO TOPBAR
     if($('.top_menu').length === 0){
       $('header').addClass("no-topbar");
     }

     /*========== COMMING SOON PAGE ==========*/
     $('#countdown').each(function() {
       var $this = $(this),
         finalDate = $(this).data('countdown');
       $this.countdown(finalDate, function(event) {
         $this.html(event.strftime(
           '<div class="count_box"><div class="inner"><div class="count_number">%D</div><div class="count_text">Days</div></div></div> ' + '<div class="count_box"><div class="inner"><div class="count_number">%H</div><div class="count_text">Hours</div></div></div> ' + '<div class="count_box"><div class="inner"><div class="count_number">%M</div><div class="count_text">Minutes</div></div></div> ' + '<div class="count_box"><div class="inner"><div class="count_number">%S</div><div class="count_text">Seconds</div><div></div>'));
       });
     });


     // =============================================
     // COUNT UP
     // =============================================
     var options = {
       useEasing: true,
       useGrouping: false,
       separator: ',',
       decimal: '.',
       prefix: '',
       suffix: ''
     };

     $('.countup-item').on('inview', function(event, visible) {
       if (visible) {

         $.each($('.number'), function() {
           var count = $(this).data('count'),
             numAnim = new CountUp(this, 0, count);
           numAnim.start();
         });

         $(this).unbind('inview');
       }
     });

     /*========== ISOTOPE ==========*/
     $(function() {
       var $grid = $('.grid').isotope({
         itemSelector: '.g_item'
       });
       // filters
       $('.grid_filters').on('click', 'a', function(e) {
         e.preventDefault();
         var filterValue = $(this).attr('data-filter');
         $grid.isotope({
           filter: filterValue
         });
       });
       // active class
       $('.grid_filters').each(function(i, buttonGroup) {
         var $buttonGroup = $(buttonGroup);
         $buttonGroup.on('click', 'a', function() {
           $buttonGroup.find('.active').removeClass('active');
           $(this).addClass('active');
         });
       });

       // fix for isotope overlapping images
       if ($(".grid").length) {
         // layout Isotope after each image loads
         $grid.imagesLoaded().progress(function() {
           $grid.isotope('layout');
         });
       }

     });


     /*========== SELECT PICKER ==========*/
     $('select').selectpicker({
       style: 'btn-select',
       size: 'auto',
       container: 'body',
     });
     if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
       $('select').selectpicker('mobile');
     }


     /*========== MAGNIFIC POPUP ==========*/
     $(".magnific-popup, a[data-rel^='magnific-popup']").magnificPopup({
       type: 'image',
       mainClass: 'mfp-with-zoom', // this class is for CSS animation below

       zoom: {
         enabled: true,
         duration: 300,
         easing: 'ease-in-out',
         fixedContentPos: true,
         opener: function(openerElement) {
           return openerElement.is('img') ? openerElement : openerElement.find('img');
         }
       },

       retina: {
         ratio: 1, // Increase this number to enable retina image support.
         replaceSrc: function(item, ratio) {
           return item.src.replace(/\.\w+$/, function(m) {
             return '@2x' + m;
           });
         }
       }

     });

     $('.image-gallery').magnificPopup({
       delegate: 'a',
       type: 'image',
       fixedContentPos: true,
       gallery: {
         enabled: true
       },
       removalDelay: 300,
       mainClass: 'mfp-fade',
       retina: {
         ratio: 1,
         replaceSrc: function(item, ratio) {
           return item.src.replace(/\.\w+$/, function(m) {
             return '@2x' + m;
           });
         }
       }

     });

     $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
       type: 'iframe',
       mainClass: 'mfp-fade',
       removalDelay: 300,
       preloader: false,
       fixedContentPos: true,
     });

     /*========== POP OVER & TOOLTIP ==========*/
     $('[data-toggle="popover"]').popover({
       html: true,
       offset: '0 10px',
       container: 'body',
     });
     $('[data-toggle="tooltip"]').tooltip({
       animated: 'fade',
       container: 'body',
       offset: '0 5px'
     });

     /*========== BACK TO TOP ==========*/
     var amountScrolled = 500;
     var back_to_top = $('#back_to_top');
     $(window).on('scroll', function() {
       if ($(window).scrollTop() > amountScrolled) {
         back_to_top.addClass('active');
       } else {
         back_to_top.removeClass('active');
       }
     });
     back_to_top.on('click', function() {
       $('html, body').animate({
         scrollTop: 0
       }, 500);
       return false;
     });


     /*========== FOOTER LANGUAGE SWITCHER ==========*/
     $('.footer-language-switcher .selected-language').on('click', function () {
      $(this).parent().toggleClass('open');
     });

     $(window).click(function () {
      $('.footer-language-switcher').removeClass('open');
    });

    $('.footer-language-switcher').on('click', function (event) {
      event.stopPropagation();
    });


   });
 })(jQuery);
