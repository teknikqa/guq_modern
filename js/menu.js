/* 
 * Sidr Menu.
 * Sticky menu.
 */
var menuBreakPoint = 979;
var prevent_click = false;

(function($) {
  Drupal.behaviors.GUQMenu = {
    attach: function(context, settings) {

      $(document).scroll(function() {
        if ($(window).width() > menuBreakPoint && !($('#navbar-administration').length > 0)) {
          if ($(document).scrollTop() >= 153) {
            $('.domain-qatar-sfs-georgetown-edu #page-header').addClass('affix');
            $('body.domain-qatar-sfs-georgetown-edu').css('padding-top', '198px');
          }
          else {
            $('body.domain-qatar-sfs-georgetown-edu').css('padding-top', '0px');
            $('.domain-qatar-sfs-georgetown-edu  #page-header').removeClass('affix');
          }
        }
      });

      $(".mobile-overlay").bind('touchstart click', function(e) {

        $('body').removeClass('show-menu');
        prevent_click = true;
        setTimeout(function() {
          prevent_click = false;
        }, 1000);
        return false;
      });

      //Side Menu - Main menu.
      $('.sidr-class-caret').click(function() {
        level = $(this).parent('li').attr('data-level');
        if ($(this).parent('li').hasClass('caret-expanded')) {
          $(this).parent('li').removeClass('caret-expanded');
        }
        else {
          $('.sidr-class-level-' + level).removeClass('caret-expanded');
          $('.sidr-class-level-' + level + ' li').removeClass('caret-expanded');
          if ($(this).parent('li').hasClass('sidr-class-active')) {
            $(this).parent('li').removeClass('sidr-class-active');
          }
          else {
            $(this).parent('li').addClass('caret-expanded');
          }
        }
      });

      // Mobile Menu toggle.
      $('#block-menu-menu-audience-menu--2 .block-title').unbind('click').click(function() {
        $(this).parent('#block-menu-menu-audience-menu--2').find('.menu').slideToggle(1);
      });

      $('#mobile-button').unbind('click').bind('click', function(e) {

        $(this).toggleClass('menu-opened');
        $('body').toggleClass('show-menu');

        // prevents clicking on hamburger icon triggering a menu option
        if (!prevent_click) {
          prevent_click = true;
          setTimeout(function() {
            prevent_click = false;
          }, 1000);
        }

        return false;
      });
      
      $('.mobile-menu .mobile-menu-caret').unbind('click').bind('click',function(e){
        $(this).parent().toggleClass('active-trail');
      });

      $('a').bind('touchstart click', function(e) {
        if (prevent_click) {
          e.preventDefault();
          return false;
        }
      });
    }
  }
})(jQuery);