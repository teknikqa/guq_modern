(function ($) {
  // Campus Life behaviors for editors
  Drupal.behaviors.campusLifeForEditors = {
    attach: function (context, settings) {

     // Tiles of blocks behaviors for editors. with Panilizer JS of Edit/Save/cancel
      var $page_campus_life_editor = $('.page-campus-life .panels-flexible-471-inside .panels-ipe-sort-container').packery({
        "isOriginRight": false
      });


      $(window).resize(function () {
        $('.guq-page-wrapper').css("width", "100%");

        $page_campus_life_editor.packery( 'once', 'layoutComplete', function() {
           $('.page-campus-life .panels-ipe-sort-container div.panels-ipe-portlet-wrapper').css({"display":"block", "float":"left", "margin":"0", "margin":"0", "padding":"0"});
           $page_campus_life_editor.packery();
        });

      });

    }
  }
})(jQuery);