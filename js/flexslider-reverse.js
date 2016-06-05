(function($) {
  Drupal.behaviors.flexsliderReverse = {
    attach: function (context, settings) {

      // Reverse the direction of sliding for RTL.
      if ($('html').attr('dir') == 'rtl') {
        if (Drupal.settings.flexslider) {
          Drupal.settings.flexslider.optionsets.page_slide.reverse = true;
        }
        // Reverse the direction of slide-show sliding for RTL.
        if (Drupal.settings.viewsSlideshowCycle) {
          Drupal.settings.viewsSlideshowCycle['#views_slideshow_cycle_main_center-center_highlight'].opts.rev = 1;
        }
      }

   }
 }
})(jQuery);
