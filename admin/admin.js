jQuery(function ($) {

    const currentYear = new Date().getFullYear();

    $('.ob-yearpicker').datepicker({
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        yearRange: '1900:' + currentYear,
        maxDate: new Date(currentYear, 11, 31),

        onClose: function () {
            const year = $('#ui-datepicker-div .ui-datepicker-year :selected').val();
            $(this).val(year);
        },

        beforeShow: function (input, inst) {
            $(inst.dpDiv).addClass('ob-year-only');
        }
    });

    // Open picker when clicking calendar icon
    $('.ob-calendar-icon').on('click', function () {
        $(this).siblings('input').datepicker('show');
    });

    // Media uploader
    $('#ob_image_button').on('click', function (e) {
        e.preventDefault();

        const frame = wp.media({
            title: 'Select Image',
            button: { text: 'Use this image' },
            multiple: false
        });

        frame.on('select', function () {
            const attachment = frame.state().get('selection').first().toJSON();
            $('#ob_image_id').val(attachment.id);
            $('#ob_image_preview').html(
                '<img src="' + attachment.url + '" style="max-width:300px;" />'
            );
        });

        frame.open();
    });

});
