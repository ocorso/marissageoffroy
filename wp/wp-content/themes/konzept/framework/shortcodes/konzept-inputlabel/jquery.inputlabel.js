/**
 * jQuery Initial input value replacer
 * 
 * Sets input value attribute to a starting value  
 * @author Marco "DWJ" Solazzi - hello@dwightjack.com
 * @license  Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * @copyright Copyright (c) 2008 Marco Solazzi
 * @version 0.1
 * @requires jQuery 1.2.x
 */
(function (jQuery) {
	/**
	 * Setting input initialization
	 *  
	 * @param {String|Object|Bool} text Initial value of the field. Can be either a string, a jQuery reference (example: $("#element")), or boolean false (default) to search for related label
	 * @param {Object} [opts] An object containing options: 
	 * 							color (initial text color, default : "#666"), 
	 * 							e (event which triggers initial text clearing, default: "focus"), 
	 * 							force (execute this script even if input value is not empty, default: false)
	 * 							keep (if value of field is empty on blur, re-apply initial text, default: true)  
	 */
	jQuery.fn.inputLabel = function(text,opts) {
		o = jQuery.extend({ color: "#666", transform: "uppercase", e:"focus", force : false, keep : true}, opts || {});
		var clearInput = function (e) {
			var target = jQuery(e.target);
			var value = jQuery.trim(target.val());
			if (e.type == e.data.obj.e && value == e.data.obj.innerText) {
				jQuery(target).css("color", "").val("");
				jQuery(target).css("text-transform", "").val("");
				if (!e.data.obj.keep) {
					jQuery(target).unbind(e.data.obj.e+" blur",clearInput);
				}
			} else if (e.type == "blur" && value == "" && e.data.obj.keep) {
				jQuery(this).css("color", e.data.obj.color).val(e.data.obj.innerText);
				jQuery(this).css("text-transform", e.data.obj.transform).val(e.data.obj.innerText);
			}
		};
		return this.each(function () {
					o.innerText = (text || false);
					if (!o.innerText) {
						var name = jQuery(this).attr("name");
						o.innerText = jQuery(this).parents("form").find("label[for=" + name + "]").hide().text();
					}
					else 
						if (typeof o.innerText != "string") {
							o.innerText = jQuery(o.innerText).text();
						}
			o.innerText = jQuery.trim(o.innerText);
			if (o.force || jQuery(this).val() == "") {
				jQuery(this).css("color", o.color).val(o.innerText);
				jQuery(this).css("text-transform", o.transform).val(o.innerText);
			}
			jQuery(this).bind(o.e+" blur",{obj:o},clearInput);
				var fieldel = jQuery(this);
				var ocpyinnerText = o.innerText;
				jQuery(this).parents("form").submit(function(){
					if(jQuery.trim(fieldel.val()) == ocpyinnerText){
						fieldel.css("text-transform", "").val("");
					}
				});
				var eventname = "submit";
				try{
					var handlers = jQuery(this).parents("form").data('events')[eventname.split('.')[0]];
					var handler = handlers.pop();
					handlers.splice(0, 0, handler);
				}catch(es){}
		});
	};
})(jQuery);

jQuery(document).ready(function() {
	$("#author").inputLabel();
	$("#email").inputLabel();
	$("#url").inputLabel();
	$("#data").inputLabel();
	$("#your-name").inputLabel();
	$("#your-message").inputLabel();
	$("#your-email").inputLabel();
/*	if(jQuery(".wpcf7-form").length){
		jQuery(".wpcf7-form").submit(function(e){
			var eventname = "submit";
			try{
				var handlers = jQuery(".wpcf7-form").data('events')[eventname.split('.')[0]];
				for(var ies=0;ies<handlers.length;ies++){
					if(handlers[ies]["handler"].name == "doAjaxSubmit"){
						handlers[ies]["handler"] = function(e){};
					}
				}
			}catch(es){}
		});
		var eventname = "submit";
		try{
			var handlers = jQuery(".wpcf7-form").data('events')[eventname.split('.')[0]];
			var handler = handlers.pop();
			handlers.splice(0, 0, handler);
		}catch(es){}
	} */
});