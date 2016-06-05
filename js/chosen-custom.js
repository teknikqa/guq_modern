(function($) {

  // Chosen Custom behaviors.
  Drupal.behaviors.chosenCustom = {
    attach: function(context) {

        //  Fix chosen issue #1887 
        $('.chosen-container .chosen-results').on('touchend', function(event) {
            event.stopPropagation();
            event.preventDefault();
            return;
        });

        // Fix for the Accessibility issues with Chosen + aria-label issue #2384865
        $(".views-exposed-widget").each(function( index, element ) {
           $(this).find('.form-type-select .chosen-container input').attr("aria-label" ,$.trim($(this).find('label').text()));
        });

        // Not to let users submit or delete untile the AJAx Compleate.
        $(document).ajaxStart(function() {
            // Disable elements.
            $("#edit-submit").attr("disabled", "disabled");
            $(".form-submit").attr("disabled", "disabled");
            $("#edit-preview-changes").attr("disabled", "disabled");
            $("#edit-delete").attr("disabled", "disabled");
        })
        $(document).ajaxComplete(function() {
            // Enable elements.
            $("#edit-submit").removeAttr("disabled");
            $(".form-submit").removeAttr("disabled");
            $("#edit-preview-changes").removeAttr("disabled");
            $("#edit-delete").removeAttr("disabled");
        });

    }
  }

})(jQuery);