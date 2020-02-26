(function ($) {
    $(document).ready(function () {


        // CMB2 SWITCH
        $(".cmb2-enable").on("click", function() {
              var parent = $(this).parents('.cmb2-switch');
              $('.cmb2-disable',parent).removeClass('selected');
              $(this).addClass('selected');
          });
          $(".cmb2-disable").on("click", function() {
              var parent = $(this).parents('.cmb2-switch');
              $('.cmb2-enable',parent).removeClass('selected');
              $(this).addClass('selected');
          });



          // CMB2 CONDITIONALS

            if( jQuery('#cmb2_select_field_id').val() == 'conditional_option') {
                jQuery('.cmb2-field-to-display-on-select').show();
            }
            jQuery('#cmb2_select_field_id').bind('change', function (e) {
                if( jQuery('#cmb2_select_field_id').val() == 'conditional_option') {
                    jQuery('.cmb2-field-to-display-on-select').show();
                }
                else{
                   jQuery('.cmb2-field-to-display-on-select').hide();
                }
            });

            // ADD CLASS TO VC EAGLE THEMES ELEMENTS
            var ealge_themes_tab = $('.vc_edit-form-tab-control:contains("Eagle Themes")');
            ealge_themes_tab.addClass('ealge-themes-tab'); 


    })

})(jQuery);
