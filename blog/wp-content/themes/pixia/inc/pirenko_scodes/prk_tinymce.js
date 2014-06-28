
    tinymce.create('tinymce.plugins.prk_tinymce', {
        init : function(ed, url) 
		{
            ed.addButton('prk_tinymce_btn', {
                title : 'My Link',
                image : url+'/images/edit.png',
                onclick : function() 
				{
                     var open_shortcodes = jQuery("#prk_shortcodes_sub").length;
						if (open_shortcodes)
						{
							jQuery("#prk_shortcodes_sub").remove();
						}
						else
						{
							jQuery("#content_prk_tinymce_btn").append("<div id='prk_shortcodes_sub' role='listbox' class='mceMenu mceSplitButtonMenu wp_themeSkin mceNoIcons'><table><tbody><tr><td id='prk_tm_slider' class='mceMenuItem mceMenuItemEnabled'><a href='#'>Slider</a></td></tr><tr><td id='prk_tm_blockquote' class='mceMenuItem mceMenuItemEnabled'><a href='#'>Blockquote</a></td></tr><tr><td id='prk_tm_boxes' class='mceMenuItem mceMenuItemEnabled'><a href='#'>Message</a></td></tr><tr><td id='prk_tm_lists' class='mceMenuItem mceMenuItemEnabled'><a href='#'>List</a></td></tr><tr><td id='prk_tm_tabs' class='mceMenuItem mceMenuItemEnabled'><a href='#'>Tabs</a></td></tr><tr><td id='prk_tm_accordion' class='mceMenuItem mceMenuItemEnabled'><a href='#'>Accordion</a></td></tr><tr><td id='prk_tm_layout' class='mceMenuItem mceMenuItemEnabled'><a href='#'>Layout</a></td></tr><td id='prk_tm_button' class='mceMenuItem mceMenuItemEnabled'><a href='#'>Button</a></td></tr></tbody></table></div>");
							jQuery("#prk_tm_slider").click(function(){
                                tb_show("Shortcodes - Insert Slider", url + "/s_window.php?popup=slider");                            
                            });
							jQuery("#prk_tm_blockquote").click(function(){
                                tb_show("Shortcodes - Insert Blockquote", url + "/s_window.php?popup=blockquote");                            
                            });
							jQuery("#prk_tm_boxes").click(function(){
                                tb_show("Shortcodes - Insert Message", url + "/s_window.php?popup=boxes");                            
                            });
							jQuery("#prk_tm_lists").click(function(){
                                tb_show("Shortcodes - Insert List", url + "/s_window.php?popup=lists");                            
                            });
							jQuery("#prk_tm_tabs").click(function(){
                                tb_show("Shortcodes - Insert Tabs", url + "/s_window.php?popup=tabs");                            
                            });
							jQuery("#prk_tm_accordion").click(function(){
                                tb_show("Shortcodes - Insert Accordion", url + "/s_window.php?popup=accordion");                            
                            });
							jQuery("#prk_tm_layout").click(function(){
                                tb_show("Shortcodes - Insert Layout Elements", url + "/s_window.php?popup=layout");                            
                            });
							jQuery("#prk_tm_button").click(function(){
                                tb_show("Shortcodes - Insert Buton", url + "/s_window.php?popup=button");                            
                            });
						}
					
                }
            });
			jQuery("#prk_shortcodes_sub").blur =function(){alert('mouse out');};
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('prk_tinymce', tinymce.plugins.prk_tinymce);