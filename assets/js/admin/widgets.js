(function ($) {
    "use strict";

    /* Document is Raedy */
    $(document).ready(function () {

        function media_upload(button_class) {
            'use strict';

            $('body').on('click', button_class, function (e) {
                var upload_button = $(this);
                // If the media frame already exists, reopen it.
                if (frame) {
                    frame.open();
                    return;
                }

                // Create a new media frame
                var frame = wp.media({
                    library: {
                        type: 'image'
                    },
                    multiple: false
                });

                frame.on('select', function () {
                    // Get media attachment details from the frame state
                    var attachment = frame.state().get('selection').first().toJSON();

                    upload_button.parents(".upload-item").find('.custom_media_id').val(attachment.id);
                    upload_button.parents(".upload-item").find('.custom_media_image').attr('src', attachment.url).css('display', 'block');
                });

                frame.open();
                return false;
            });
        }
        media_upload('.custom_media_upload');

        $('body').on('click', ".custom_media_upload_remove", function (e) {
            $(this).parents(".upload-item").find('.custom_media_id').val("");
            $(this).parents(".upload-item").find('.custom_media_image').attr('src', "").css('display', 'none');
        });

    });
})(jQuery);