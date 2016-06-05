(function($) {

  // Bootstrap Remove empty cols in rows.
  Drupal.behaviors.removeEmptyCols = {
    attach: function(context) {

      // Remove empty col-sm-4 and extend col-sm-8 with col-sm-12.
      $('.node-research-project-page.node-teaser .row').each(function() {
        if ($(this).children('.col-sm-4').html().trim().length === 0) {
          $(this).children('.col-sm-8').addClass('col-sm-12');
          $(this).children('.col-sm-12').removeClass('col-sm-8');
          $(this).children('.col-sm-4').remove();
        }
      });
    }
  }

})(jQuery);