jQuery(document).ready(function ($) {
    $('.tabs').tabs();
    function initColorPicker(widget) {
        widget.find('.my-color-field').wpColorPicker({
            change: _.throttle(function () { // For Customizer
                $(this).trigger('change');
            }, 3000)
        });
    }

    function onFormUpdate(event, widget) {
        $('.tabs').tabs(widget);
        initColorPicker(widget);
    }

    $(document).on('widget-added widget-updated', onFormUpdate);

    $('#widgets-right .widget:has(.my-color-field)').each(function () {
        initColorPicker($(this));
    });
});
