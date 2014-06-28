jQuery(document).ready(function () {
    jQuery(".attcolorpicker").each(function(){
		var current_colorpicker_element = jQuery(this);
        current_colorpicker_element.ColorPicker({
            onShow: function (cp) {
                jQuery(cp).fadeIn(500);
                return false;
            },
            onHide: function (cp) {
                jQuery(cp).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                current_colorpicker_element.parent().find('.attcolorpicker').val('#' + hex);
                current_colorpicker_element.parent().find('.colorSelector div').css('backgroundColor', '#' + hex);
                current_colorpicker_element.parent().find('.colorSelector').ColorPickerSetColor(hex);
            }
        });
        current_colorpicker_element.parent().find('.colorSelector').ColorPicker({
            onShow: function (cp) {
                jQuery(cp).fadeIn(500);
                return false;
            },
            onHide: function (cp) {
                jQuery(cp).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                current_colorpicker_element.parent().find('.attcolorpicker').val('#' + hex);
                current_colorpicker_element.parent().find('.colorSelector div').css('backgroundColor', '#' + hex);
                current_colorpicker_element.parent().find('.attcolorpicker').ColorPickerSetColor(hex);
            }
        });
    });
});