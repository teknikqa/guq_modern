(function ($) {
  // Campus Life behaviors.
  Drupal.behaviors.campusLife = {
    attach: function (context, settings) {

      // #RA:2014-10-15: Use Packery to rearange FPP at Campus Life page.
      var $page_campus_life = $('.page-campus-life .panels-flexible-region-471-center-inside').packery({
          "isOriginRight": false
      });

     $(window).resize(function () {
        $('.guq-page-wrapper').css('width', '100%');

        $page_campus_life.packery( 'once', 'layoutComplete', function() {
           $page_campus_life.packery();
        });
      });

      $(window).resize();

    }
  }
})(jQuery);
