var briskuploader_classname = "briskuploader";
var briskuploader_af = false;
var briskuploader_tbenv = false;
var briskuploader_tbenvinputs = [];
briskuploader = {
	inituploader: function(){
		jQuery("."+briskuploader_classname).each(function(){
			if(!jQuery(this).hasClass(briskuploader_classname+"_active")){
				jQuery(this).addClass(briskuploader_classname+"_active");
				jQuery(this).click(function(){
					briskuploader_af = this;
					jQuery(this).addClass(briskuploader_classname+"_currentmod");
					if(jQuery("#TB_window").length){
						briskuploader_tbenvinputs = [];
						jQuery("#TB_window").find("input, select, textarea").each(function(i,e){
							if(jQuery(e).attr("id")){
								briskuploader_tbenvinputs.push({'id':jQuery(e).attr("id"),'val':((jQuery(e).val())?(jQuery(e).val()):"")});
							}
						});
						briskuploader_tbenv = {'tboverlay':jQuery("#TB_overlay").clone(true), 'tbwindow':jQuery("#TB_window").clone(true)};
						jQuery("#TB_overlay").remove();
						jQuery("#TB_window").remove();
						//tb_remove();
					}
					tb_show("Upload image", "media-upload.php?type=image&TB_iframe=1&width=640&height=520");
					return false;
				});
				var briskuploader_f = jQuery(this).parent().find("input[type=text]")
				if(briskuploader_f.length){
					briskuploader.reloadimgonblur(briskuploader_f);
					briskuploader_f.blur();
				}
			}
		});
	},
	reloadimgonblur: function(fe){
		jQuery(fe).blur(function(){
			var briskuploader_fval = jQuery(this).val();
			if(briskuploader_fval){
				if(briskuploader_fval.match(/(^.*\.jpg|jpeg|png|gif|ico*)/gi)){
					var briskuploader_p = jQuery(this).parent().find("."+briskuploader_classname+"_preview");
					if(briskuploader_p.length){
						briskuploader_p.html("<img src=\""+briskuploader_fval+"\"></img><br><span class=\""+briskuploader_classname+"_remove\">remove</span>");
						briskuploader.removeonclick(briskuploader_p.find("."+briskuploader_classname+"_remove"));
					}
				}else{
					var briskuploader_p = jQuery(this).parent().find("."+briskuploader_classname+"_preview");
					if(briskuploader_p.length){
						briskuploader_p.html("");
					}
				}
			}
		});
	},
	removeonclick: function(fe){
		jQuery(fe).click(function(){
			var briskuploader_f = jQuery(this).parent().parent().find("input[type=text]");
			if(briskuploader_f.length){
				briskuploader_f.val("");
			}
			var briskuploader_p = jQuery(this).parent().parent().find("."+briskuploader_classname+"_preview");
			if(briskuploader_p.length){
				briskuploader_p.html("");
			}
		});
	}
};

jQuery(document).ready(function(){
	window.send_to_editor_orig = window.send_to_editor;
	window.send_to_editor = function(html){
		if(briskuploader_af){
			if(briskuploader_tbenv){
				jQuery("#TB_overlay").remove();
				jQuery("#TB_window").remove();
				jQuery("body").append(briskuploader_tbenv.tboverlay);
				jQuery("body").append(briskuploader_tbenv.tbwindow);
				if(briskuploader_tbenvinputs.length){
					for(var bu_ri=0;bu_ri<briskuploader_tbenvinputs.length;bu_ri++){
						if(briskuploader_tbenvinputs[bu_ri].id && briskuploader_tbenvinputs[bu_ri].val){
							jQuery("#"+briskuploader_tbenvinputs[bu_ri].id).val(briskuploader_tbenvinputs[bu_ri].val);
						}
					}
				}
			}
			if(jQuery("."+briskuploader_classname).hasClass(briskuploader_classname+"_currentmod")){
				briskuploader_af = jQuery("."+briskuploader_classname+"."+briskuploader_classname+"_currentmod").removeClass(briskuploader_classname+"_currentmod");
			}
			var briskuploader_i = jQuery(html).find("img");
			if(briskuploader_i.length){
				var briskuploader_is = briskuploader_i.attr("src");
				//var briskuploader_f = jQuery(briskuploader_af).prev().prev("input"); //prev is <br>, then <input>
				var briskuploader_f = jQuery(briskuploader_af).parent().find("input[type=text]");
				if(briskuploader_f.length){
					briskuploader_f.val(briskuploader_is);
					briskuploader_f.trigger("change");
				}
				var briskuploader_p = jQuery(briskuploader_af).parent().find("."+briskuploader_classname+"_preview");
				if(briskuploader_p.length){
					//briskuploader_p.html(html);
					briskuploader_p.html("<img src=\""+briskuploader_is+"\"></img><br><span class=\""+briskuploader_classname+"_remove\">remove</span>");
					briskuploader.removeonclick(briskuploader_p.find("."+briskuploader_classname+"_remove"));
				}
			}
			if(!briskuploader_tbenv){
				tb_remove();
			}
			briskuploader_tbenv = false;
			
			briskuploader_af = false;
		}else{
			window.send_to_editor_orig(html);
		}
	}
	briskuploader.inituploader();
});
