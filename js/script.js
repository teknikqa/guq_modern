(function($) {
  
  var $isOriginLeft = ($('html').attr('dir') == 'ltr') ? true : false;
  
  Drupal.settings = Drupal.settings || {};

  // Have IS_IPAD if the device is ipad
  var IS_IPAD = navigator.userAgent.match(/iPad/i) != null;
  var IS_IPHONE = navigator.userAgent.match(/iPhone/i) != null;
  var IS_IPOD = navigator.userAgent.match(/iPod/i) != null;

  /** Responsive JS control **/
  // xs : Extra small devices - Phones (<768px)
  // sm : Small devices       - Tablets (≥768px)
  // md : Medium devices      - Desktops (≥992px)
  // lg : Large devices       - Desktops (≥1200px)
  Drupal.behaviors.responsiveControl = {
    attach: function (context, settings) {

      $(window).resize(function() {
        var window_width = window.innerWidth || $(window).width();

        // xs : Extra small devices - Phones (<768px) .
        if (window_width < 768 ) {
          $('.menu-block-microsite-navigation .menu.nav').equalChildrenHeight("a");
        }
        else {
          $('.menu-block-microsite-navigation .menu.nav').equalChildrenAutoHeight("a");
        }

      });
      $(window).resize();
    }
  }

  
  // Wrap tables with class "table" to be responsive tables, everywhere.
  Drupal.behaviors.ResponsiveTables = {
    attach: function(context) {
      $('table.table').each(function() {
        $(this).wrap('<div class="table-responsive"></div>');
      });
    }
  }

  Drupal.behaviors.FooterMenu = {
    attach: function(context) {
      var footer_isotope = function() {
        if ($(window).width() > 400) {
          $('.active-footer-menu, .footer-main-menu').isotope({
            itemSelector: '.menu-block-wrapper > ul.menu > li',
            layoutMode: 'masonry',
            isOriginLeft: $isOriginLeft
          });
        }
      };

      footer_isotope();


      // Footer menu switcher 
      if ($('.top-footer').find('.active-footer-menu').length > 0) {
        $('.switch-link').click(function() {
          $('.footer-main-menu').toggle();
          $('.active-footer-menu').toggle();
          $('.section-switch-link').toggle();
          $('.main-switch-link').toggle();
          footer_isotope();
          return false;
        });
      } else {
        $('.footer-main-menu').addClass('show');
        footer_isotope();
        $('.footer-link span').addClass('hide');
      }
    }
  };

  Drupal.behaviors.equalizer = {
    attach: function(context, settings) {

      if ($('.majors-certificate').length > 0) {
        $('.majors-certificate').imagesLoaded(function() {
          $('.majors-certificate').equalizer({
            columns: '.major-certificate',
            useHeight: 'height',
            resizeable: true,
            min: 0,
          });
        });
      }

      if ($('.research-fellows').length > 0) {
        $('.research-fellows').imagesLoaded(function() {
          $('.research-fellows').equalizer({
            columns: '.research-user-row',
            useHeight: 'height',
            resizeable: true,
            min: 0,
          });
        });
      }

      if ($('.research-faculty .view-content').length > 0) {
        $('.research-faculty .view-content').imagesLoaded(function() {
          $('.research-faculty .view-content').equalizer({
            columns: '.research-user-row',
            useHeight: 'height',
            resizeable: true,
            min: 0,
          });
        });
      }

      if ($('.partner-teaser-view .view-content').length > 0) {
        $('.partner-teaser-view .view-content').imagesLoaded(function() {
          $('.partner-teaser-view .view-content').equalizer({
            columns: '.partner-teaser',
            useHeight: 'height',
            resizeable: true,
            min: 0,
          });
        });
      }

      if ($('.research-fellows .view-content').length > 0) {
        $('.research-fellows .view-content').imagesLoaded(function() {
          $('.research-fellows .view-content').equalizer({
            columns: '.research-user-row',
            useHeight: 'height',
            resizeable: true,
            min: 0,
          });
        });
      }

      if ($('.sidebar-newsletters-category').length > 0) {
        $('.sidebar-newsletters-category').imagesLoaded(function() {
          $('.sidebar-newsletters-category').equalizer({
            columns: '.sidebar-newsletter',
            useHeight: 'height',
            resizeable: true,
            min: 0,
          });
        });
      }

      if ($('.center-youtube').length > 0) {
        $('.center-youtube').imagesLoaded(function() {
          $('.center-youtube').equalizer({
            columns: '.views-row',
            useHeight: 'height',
            resizeable: true,
            min: 0,
          });
        });
      }
    }
  };

  Drupal.behaviors.VarTheme = {
    attach: function(context, settings) {
      $('#sf #email').change(function(){
        $('#sf #oid').val('00D80000000MEpr');
      });
      
      // Fix for media widget buttons
      $('.media-widget a.button').addClass('btn btn-default');

      //Side Menu - Secondary menu and Sidbar menu block.
      // Add "opened" class if the li is expanded and active-trail 
      $('.sidebar-menu-block ul li.active-trail.expanded').each(function() {
        $(this).find('> span').addClass('opened');
      });

      $('.this-section-mb-style ul li.active-trail.expanded').each(function() {
        $(this).find('.nav-class-caret').addClass('opened');
      });

      $('.nav-class-caret').click(function() {
        $(this).parent('li').children('ul').toggle();
        $(this).toggleClass('opened');
      });

//      $('.sidr .menu li.active-trail.expanded > a.active-trail + span').addClass('opened');


      $('.mega.mega-align-justify').focusin(function() {
        $(this).addClass('open');
      });

      $('.mega.mega-align-justify').focusout(function() {
        $(this).removeClass('open');
      });

      //handle accessibilty in sidebar menu
      $('.menu-block-wrapper .menu.nav .expanded').focusin(function() {
        $(this).children('.menu.nav').addClass('expanded');
      });

      $('.menu-block-wrapper .menu.nav .expanded  ul li:last-child').focusout(function() {
        $(this).parent('ul.menu.nav').removeClass('expanded');
      });

      //Activate the mouseover effect when focus on "CIRS" main menu link
      $('.tb-megamenu-item.level-1.mega').bind("focusin", function(event) {
        var element = $(this).children('a');
        if (element.attr('href') == 'http://cirs.georgetown.edu/') {
          $(this).children('a').mouseover();
        }
      });

      // deactivate the mouseover when focusout of the "CIRS" main menu link
      $('.tb-megamenu-item.level-1.mega').bind("focusout", function(event) {
        var element = $(this).children('a');
        if (element.attr('href') == 'http://cirs.georgetown.edu/') {
          $(this).children('a').mouseleave();
        }
      });

      // Start navigation from main menu
//      $('.navlink').click(function() {
//        $('.responsive-menus-sidr-processed li a').first().focus();
//      });

      // Start navigation from slider
      $('.conlink').click(function() {
        $('.flex-direction-nav a').first().focus();
      });

      // enable hover effect when focus
      $('ul.quicktabs-tabs li a').focus(function() {
        $(this).parent().toggleClass('focused');
      });

      // disable hover effect when focusout
      $('ul.quicktabs-tabs li a').focusout(function() {
        $(this).parent().toggleClass('focused');
      });

      // handle accessiblity through slider
      $('.flexslider_views_slideshow_slide.views-row-1').focusin(function(event) {
        if (!$(this).hasClass('clone')) {
          event.preventDefault();
        } else {
          event.preventDefault();
        }
      });
      $('.flexslider_views_slideshow_slide.views-row-1').find('.slide-more').find('a').focusout(function(event) {
        if (!($(this).parents('.flexslider_views_slideshow_slide.views-row-1').hasClass('clone'))) {
          event.preventDefault();
          $('.flex-next').click();
          $('.flexslider_views_slideshow_slide.views-row-2').find('a').focus();
        }
      });

      $('.flexslider_views_slideshow_slide.views-row-2').focusin(function(event) {
        if (!$(this).hasClass('clone')) {
          event.preventDefault();
        }
      });
      $('.flexslider_views_slideshow_slide.views-row-2').find('.slide-more').find('a').focusout(function(event) {
        if (!($(this).parents('.flexslider_views_slideshow_slide.views-row-2').hasClass('clone'))) {
          event.preventDefault();
          $('.flex-next').click();
          $('.flexslider_views_slideshow_slide.views-row-3').find('a').focus();
        }
      });

      $('.flexslider_views_slideshow_slide.views-row-3').focusin(function(event) {
        if (!$(this).hasClass('clone')) {
          event.preventDefault();
        }
      });

      $('.flexslider_views_slideshow_slide.views-row-3').find('.slide-more').find('a').focusout(function(event) {
        if (!($(this).parents('.flexslider_views_slideshow_slide.views-row-3').hasClass('clone'))) {
          event.preventDefault();
          $('.flex-next').click();
          $('.flexslider_views_slideshow_slide.views-row-4:not(.clone)').find('a').focus();
        }
      });


      $('.flexslider_views_slideshow_slide.views-row-4').focusin(function(event) {
        if (!$(this).hasClass('clone')) {
          event.preventDefault();
        }
      });

      $('.flexslider_views_slideshow_slide.views-row-4').find('.slide-more').find('a').focusout(function() {
        if (!($(this).parents('.flexslider_views_slideshow_slide.views-row-4').hasClass('clone'))) {
          $('.flex-direction-nav a').first().focus();
          $('.flex-next').click();
        } else {
          event.preventDefault();
        }
      });

      // GUQ Collapsible Block.
      $('.guq-collapsible-title').click(function() {
        $(this).parents('.guq-collapsible-block').toggleClass('opened');
      });

      // Event popover map
      $('html').click(function() {
        $('.node-event .field-name-field-event-geo').removeClass('active');
      });

      $('.node-event .field-name-field-event-geo .field-items .field-item').click(function(event) {
        event.stopPropagation();
      });

      $('.node-event .field-name-field-event-geo .field-label').click(function(event) {
        $(this).parent().find('.field-item .popover-closed').remove();
        $(this).parent().find('.field-item').prepend('<div class="popover-closed clearfix">x</div>');
        if (!$(this).parent().hasClass('active')) {
          $('.node-event .field-name-field-event-geo').removeClass('active');
          event.stopPropagation();
          $(this).parent().addClass('active');
        }

        $('.popover-closed').click(function() {
          $('.node-event .field-name-field-event-geo').removeClass('active');
        });
      });

      // Check if the page is FAQs - admission.
      if ($('.view-faqs.view-display-id-panel_pane_1').length > 0) {
        if (window.location.hash) {
          nid = window.location.hash.replace('#', '');
          $('.faq-' + nid + ' .guq-collapsible-block').addClass('opened');

          $('html, body').animate({
            scrollTop: $('.faq-' + nid).offset().top
          }, 1000);
        }
      }

      // Homepage isotope
      if ($('body').hasClass('front')) {
        // Inner tabs.
        if ($('.homepage-inner-tabs').length > 0) {
          $('.homepage-inner-tabs').each(function() {
            if ($(this).is(':visible')) {
              $container = $(this);
              $(this).imagesLoaded(function() {
                var pcky = $container.packery({
                  itemSelector: '.views-row',
                  isOriginLeft: $isOriginLeft
                });
              });
            }
          });
        }

        // Front tabs
        if ($('.homepage-all-tab').length > 0) {
          if ($('.homepage-all-tab').is(':visible')) {
            imagesLoaded('.homepage-all-tab', function() {
              var $container = $('.homepage-all-tab-isotope');
              var pcky = $container.packery({
                itemSelector: '.homepage-all-block',
                isOriginLeft: $isOriginLeft
              });
            });
          }
        }
      }

      // Click handler for research funding source
      $('.research-fund-label', context).each(function(index, element) {
        $(element).click(function() {
          $(this).toggleClass('label-expanded');
          $(this).next('.research-fund-body', context).toggle(300);
        });
      });

      // Click handler for research project
      $('.research-project-label', context).each(function(index, element) {
        $(element).click(function() {
          $(this).toggleClass('label-expanded');
          $(this).next('.research-project-body', context).toggle(300);
        });
      });

      $('#navigation .tb-megamenu .nav > li > .tb-megamenu-submenu > .mega-dropdown-inner').addClass('container');

    }
  }

  $(document).ready(function() {
    //search trigger 
    $('.search-trigger').unbind('focus').focus(function(event) {
      $('.header-form-search').slideToggle();
      $('.header-form-search input').focus();
      $(this).toggleClass('active fa-times');
    });
  });
})(jQuery);
