/* 
	THIS PAGE CONTAINS THE MAIN SCRIPTS OF THE PIXIA THEME
*/
function pixia_init() 
{
	//REMOVE THE FIRST EMPTY P TAG - USEFULL FOR THE PAGE CONTENT WHEN THERE'S AN IMAGE WITH NO MARGIN
	var strip_counter=0;
	jQuery('#main p').each(function() 
	{
		var this_p = jQuery(this);
		if(this_p.html().replace(/\s|&nbsp;/g, '').length == 0 && strip_counter<1)
		{
			this_p.remove();
			strip_counter++;
		}
	});
	var is_iphone = navigator.userAgent.toLowerCase().indexOf("iphone");
	//CREATE COMMENTS CONNECTING LINES
	jQuery('.commentlist > li > .children').each(
    function(e) 
	{
		var p = jQuery(this).find('li').last();
		var offset = p.position();
		var m_height=offset.top+33;
		jQuery(this).prepend('<div class="comments_liner" style="height:'+m_height+'px;"></div>');
   	});
	//ENSURE THAT THE WINDOW HAS A MINIMUM WIDTH WHEN RESPNSIVENESS IS OFF
	if (resp_mode!="true")
		jQuery('#main').css({'min-width':750});
	//ALTERNATIVE LOGO?
	if (alt_logo!="")
	{
		jQuery('.brand a').prepend('<img id="alt_logo" src="'+alt_logo+'" style="display:none" />');
	}
	//HANDLE SOUNDCLOUD MUSIC
	var ctr=0;
	jQuery('#home_slider iframe').each(function()
	{
		var str1 = jQuery(this).attr('src');
		var str2 = "soundcloud.com";
		if(str1.indexOf(str2) != -1)
		{
			jQuery(this).addClass('prk_soundcloud');//ADD CLASS
			jQuery(this).css({'height':jQuery(window).height(),'width':'100%'});//FORCE RESIZE
			if (jQuery(this).attr('id')=="" || !jQuery(this).attr('id'))//FORCE ID
			{
				jQuery(this).attr('id','prk_soundcloud_id'+ctr);	
			}
			ctr++;
		}
      });
	jQuery('#single_slider iframe,.shortcode_slider iframe').each(function()
	{
		var str1 = jQuery(this).attr('src');
		var str2 = "soundcloud.com";
		if(str1.indexOf(str2) != -1)
		{
			jQuery(this).addClass('prk_soundcloud');//ADD CLASS
			jQuery(this).css({'width':'100%','height':jQuery(this).attr('height')});//FORCE RESIZE
			jQuery(this).parent().removeClass('video-container');
			jQuery(this).parent().css({'height':jQuery(this).attr('height')});//FORCE RESIZE
			if (jQuery(this).attr('id')=="" || !jQuery(this).attr('id'))//FORCE ID
			{
				jQuery(this).attr('id','prk_soundcloud_id'+ctr);	
			}
			ctr++;
		}
	});
	//HANDLE VIMEO VIDEOS
	var ctr=0;
	jQuery('#home_slider iframe').each(function()
	{
		var str1 = jQuery(this).attr('src');
		var str2 = "vimeo.com";
		if(str1.indexOf(str2) != -1)
		{
			jQuery(this).addClass('vim_video');//ADD CLASS
			jQuery(this).css({'height':jQuery(window).height(),'width':'100%'});//FORCE RESIZE
			if (jQuery(this).attr('id')=="" || !jQuery(this).attr('id'))//FORCE ID
			{
				jQuery(this).attr('id','vim_id'+ctr);	
			}
			str2="?";//CHECK IF THE VIDEO ALREADY HAS PARAMETERS
			if(str1.indexOf(str2) != -1)
			{
				built_str=jQuery(this).attr('src')+"&api=1&player_id="+jQuery(this).attr('id');
				jQuery(this).attr('src',built_str);
			}
			else
			{
				built_str=jQuery(this).attr('src')+"?api=1&player_id="+jQuery(this).attr('id');
				jQuery(this).attr('src',built_str);
			}
			ctr++;
		}
      });
	jQuery('#single_slider iframe,.shortcode_slider iframe').each(function()
	{
		var str1 = jQuery(this).attr('src');
		var str2 = "vimeo.com";
		if(str1.indexOf(str2) != -1)
		{
			jQuery(this).addClass('vim_video');//ADD CLASS
			jQuery(this).css({'width':'100%'});//FORCE RESIZE
			if (jQuery(this).attr('id')=="" || !jQuery(this).attr('id'))//FORCE ID
			{
				jQuery(this).attr('id','vim_id'+ctr);	
			}
			str2="?";//CHECK IF THE VIDEO ALREADY HAS PARAMETERS
			if(str1.indexOf(str2) != -1)
			{
				built_str=jQuery(this).attr('src')+"&api=1&player_id="+jQuery(this).attr('id');
				jQuery(this).attr('src',built_str);
			}
			else
			{
				built_str=jQuery(this).attr('src')+"?api=1&player_id="+jQuery(this).attr('id');
				jQuery(this).attr('src',built_str);
				
			}
			ctr++;
		}
	});
	//HANDLE YOUTUBE VIDEOS
	var ctr=0;
	jQuery('#single_slider iframe,.shortcode_slider iframe').each(function()
	{
		var str1 = jQuery(this).attr('src');
		var str2 = "youtube.com";
		if(str1.indexOf(str2) != -1)
		{
			jQuery(this).addClass('ytube_video');//ADD CLASS
			jQuery(this).css({'width':'100%'});//FORCE RESIZE
			ctr++;
		}
	  });
	  jQuery('#home_slider iframe').each(function()
	{
		var str1 = jQuery(this).attr('src');
		var str2 = "youtube.com";
		if(str1.indexOf(str2) != -1)
		{
			jQuery(this).addClass('ytube_video');//ADD CLASS
			jQuery(this).css({'height':jQuery(window).height(),'width':'100%'});//FORCE RESIZE
			ctr++;
		}
	});
	//MENU FUNCTIONS
	jQuery('.sub-menu li').prepend('<div style="position:relative;"><div class="tr_wrapper"><div class="submenu_triangle"><img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'+body_color+'" src="'+theme_url_js+'/images/icons/arrows.png" /></div></div></div>');
	//HIDE ALL SUBMENUS
  	jQuery('#nav-main ul ul').hide();
	//OPEN SUBMENU IF ACTIVE
	jQuery("#nav-main ul li.active ul").show();

	//CLICK EVENT - OPEN SUBMENU IF NEEDED
	jQuery('#nav-main ul li>a').click(
    function(e) 
	{
       	if (jQuery(this).parent().children().children().size()>0 && jQuery(this).attr('href')=="#") 
		{
			e.preventDefault();
			jQuery(this).next().slideToggle('normal');
		}
   	});
	//CLICK EVENT - ON SUBMENUS
	jQuery.expr[':'].hasClassStartingWithspecial_color = function(obj)
	{
	  return (/\bspecial_color/).test(obj.className);
	};
	//
	//HIGHLIGHT PORTFOLIO IF NEEDED
	jQuery('#nav-main ul li a').each(function(index) 
	{
    	if (jQuery(this).attr('href')==portfolio_link)
			jQuery(this).parent().addClass('active');
		if (jQuery(this).attr('href')==portfolio_link_ms)
			jQuery(this).parent().addClass('active');
		if (jQuery(this).attr('href')==location.href)
			jQuery(this).parent().addClass('active');
	});
	//HIGHLIGHT BLOG IF NEEDED
	jQuery('#nav-main ul li a').each(function(index) 
	{
    	if (jQuery(this).attr('href')==blog_link)
		{
			jQuery(this).parent().addClass('active');
			if (jQuery(this).parent().parent().hasClass('sub-menu'))
			{
				jQuery(this).parent().parent().parent().addClass('active');
			}
		}	
	});
	var classic_gutter=0;
	//ADD FILTER CLASS TO PORTFOLIO SUBMENU BUTTONS - CLASSIC PORTFOLIO ONLY
	jQuery('#nav-main ul li ul li>a').each(
    function(e) 
	{
       	if (jQuery(this).parent().parent().parent().find('a').attr('href')==portfolio_link) 
		{
			var classes = jQuery(this).parent().attr("class").split(" "); 
			for (var i = 0, len = classes.length; i < len; i++) 
			{
				//GRAB THE SLUG AFTER THE "NAV-" STRING
				if (/^nav/.test(classes[i]))
				{
					if (classes[i].substring(4, classes[i].length)=='#')
						classes[i]='nav-p_all';
					jQuery(this).parent().addClass('filter');
					jQuery(this).attr('data-filter',classes[i].substring(4, classes[i].length));
					var in_counter=0;
					if (jQuery('#folio_classic').length)
					{
						jQuery('#folio_classic>div').each(
						function()
						{
							if (jQuery(this).hasClass(classes[i].substring(4, classes[i].length)))
								in_counter++;
						});
					}
					jQuery(this).parent().find('a').html(jQuery(this).parent().find('a').html()+' <span class="prk_parenthesis">('+in_counter+')</span>');
					jQuery('#extra_filter').append('<li class="filter">'+jQuery(this).parent().html()+'</li>');
				}
			}
		}
		//PORTFOLIO FILTER FUNCTIONS
		jQuery('li.filter a').click(function(e) 
		{
			e.preventDefault();
			// Remove the active class
			jQuery('.filter li').removeClass('active');
			// Split each of the filter elements and override our filter
			$filter = jQuery(this).attr('data-filter').split(' ');
			// Apply the 'active' class to the clicked link
			jQuery(this).parent().addClass('active');
			var img_nr=Math.ceil($container.width()/430);
			var helper= Math.floor($container.width() / img_nr);
			var h_helper=Math.floor(helper/480*300);
			jQuery('.portfolio_entry_li').css({'height':h_helper}); 
			//SET THE NUMBER OF IMAGES TO SHOW
			var img_nr=Math.ceil($container.width()/430);
			jQuery('.portfolio_entry_li').css({'width':'auto'}); 
			var helper= Math.floor($container.width() / img_nr);
			var h_helper=Math.floor(helper/480*300);
			jQuery('.portfolio_entry_li').css({'height':h_helper}); 
			jQuery('.portfolio_entry_li img').css({'margin-left':-Math.floor((480-helper)/2),'margin-top':-Math.floor((300-h_helper)/2)});
			$container.isotope({
				filter: '.'+$filter
				},
				function()
				{
				 
				});
				jQuery('.portfolio_entry_li').css({'width':helper-classic_gutter});
		});
   	});
	//MASONRY - ADD FILTER CLASS TO PORTFOLIO SUBMENU BUTTONS
	var ms_gutter=0;
	jQuery('#nav-main ul li ul li>a').each(
    function(e) 
	{
       	if (jQuery(this).parent().parent().parent().find('a').attr('href')==portfolio_link_ms) 
		{
			var classes = jQuery(this).parent().attr("class").split(" "); 
			for (var i = 0, len = classes.length; i < len; i++) 
			{
				//GRAB THE SLUG AFTER THE "NAV-" STRING
				if (/^nav/.test(classes[i]))
				{
					if (classes[i].substring(4, classes[i].length)=='#')
						classes[i]='nav-p_all';
					jQuery(this).parent().addClass('filter');
					jQuery(this).attr('data-filter',classes[i].substring(4, classes[i].length));
					var in_counter=0;
					if (jQuery('#folio_masonry').length)
					{
						jQuery('#folio_masonry>div').each(
						function()
						{
							if (jQuery(this).hasClass(classes[i].substring(4, classes[i].length)))
								in_counter++;
						});
					}
					jQuery(this).parent().find('a').html(jQuery(this).parent().find('a').html()+' <span class="prk_parenthesis">('+in_counter+')</span>');
				}
			}
			jQuery('li.filter a').click(function(e) 
			{
				e.preventDefault();
				// Remove the active class
				jQuery('.filter li').removeClass('active');
				// Split each of the filter elements and override our filter
				$filter = jQuery(this).attr('data-filter').split(' ');
				// Apply the 'active' class to the clicked link
				jQuery(this).parent().addClass('active');
				setTimeout(function(){ jQuery(window).trigger( "smartresize");},0);
				$container_folio_masonr.isotope({
					filter: '.'+$filter
					},
					function()
					{
					 
					});
			});
		}
   	});
	
	//FADE IN MENU
	jQuery('#logo_holder').imagesLoaded( function() 
	{
		jQuery('#left_ar,#trapezoid').css({'opacity':'0'});
		jQuery('#left_ar,#trapezoid').animate({opacity:1}, 50 );
		jQuery('.divider_tp').css({'visibility':'visible'});
	});
	//FIX FOR MEDIA QUERIES ON SOME BROWSERS
	var scrollBarWidth = 0;
	if (jQuery.browser.mozilla || jQuery.browser.opera || jQuery.browser.msie)
	{
	  scrollBarWidth = window.innerWidth - jQuery("body").width();
	}
	//MAKE THE COLLAPSED MENU OPEN SMOOTHLY FOR THE FIRST TIME IT OPENS
	if ((jQuery(window).width()<(768 - scrollBarWidth) || jQuery(window).height()<=parseInt(custom_height)) && resp_mode=="true")
	{
		jQuery("#nav-main").addClass('collapse');
		jQuery("#nav-main").addClass('resp_mode');
		jQuery(".left_nav").height(0);
		jQuery(".left_nav").css({'display':'none'});
		jQuery("#collapsed_menu_text").css({'display':'inline'});
		if (jQuery('#alt_logo').length)
		{
			jQuery('#alt_logo').css({'display':'inline'});
			jQuery('#pixia_logo_image').css({'display':'none'});
		}
	}
	jQuery(".btn-navbar").click(function()
	{
		if (collapsed_mode==false)
		{
			collapsed_mode=true;
			jQuery('#nav-main').addClass('collapse');
			jQuery(".left_nav").animate({'height':'0px'}, function(){
				jQuery(".left_nav").css({'display':'none'});
			});
			jQuery(".btn-navbar").find('.tr_wrapper img').css({left:'',top:''});
		}
		else
		{
			collapsed_mode=false;
			jQuery(".left_nav").css({'height':'auto','display':'none'});
			jQuery(".left_nav").slideDown('slow', function() {
				// Animation complete.
			  });
			 jQuery('#nav-main').removeClass('collapse');
			 jQuery(".btn-navbar").find('.tr_wrapper img').css({left:-35,top:-3});
		}
	});
	//HIDE LAST LINE FROM FOOTER WIDGET
	jQuery("#footer_sidebar>.simple_line_onbg:last").css('display','none');
	
	//FORCE BLUR ON COMMENTS FORM
	if (jQuery('#author').length)
	{
		jQuery('#author').blur();
		jQuery('#email').blur();
		jQuery('#url').blur();
		jQuery('#comment').blur();
	}
	
	//RGB TO HEXADECIMAL:rgb(204,204,204)=>#CCCCCC
	function rgb2hex(rgb)
	{
	 	rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
	 	return "#" +
	  	("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
	  	("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
	  	("0" + parseInt(rgb[3],10).toString(16)).slice(-2);
	}
	
	//HEXADECIMAL TO RGB:#CCCCCC=>rgb(204,204,204)
	function hex2rgb(hexStr)
	{
		// note: hexStr should be #rrggbb
		var hex = parseInt(hexStr.substring(1), 16);
		var r = (hex & 0xff0000) >> 16;
		var g = (hex & 0x00ff00) >> 8;
		var b = hex & 0x0000ff;
		return "rgb("+[r, g, b]+")";
	}
	//FORM INPUTS FUNCTIONS
	jQuery('.pirenko_highlighted,.pk_contact_highlighted').focus(function () 
	{
		jQuery(this).css({'outline': 'none','-webkit-box-shadow': '0px 0px 2px 0px '+active_color+'','box-shadow': '0px 0px 2px 0px '+active_color+''});
	});
	jQuery('.pirenko_highlighted,.pk_contact_highlighted').blur(function() 
	{
		
		var s=hex2rgb(inactive_color);
		var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
		var matches = patt.exec(s);
 		jQuery(this).css({'border': '','outline': 'none','-webkit-box-shadow': '','box-shadow': ''});
	});
	//FLEXISLIDER MANIPULATION
	var $js_flexislider = jQuery.noConflict();
	
	var p = jQuery('#height_helper');
	var offset_sd = p.position();
	jQuery('#bottom_sidebar').css({'bottom':-3000});
	//INITIALIZE ISOTOPE
	if (jQuery('#folio_classic').length)
	{
		var $container = jQuery('#folio_classic');
		jQuery('#folio_classic').css({'opacity':0});	
	}
	if (jQuery('#folio_masonry').length)
	{
		var $container_folio_masonr = jQuery('#folio_masonry');;
		jQuery('#folio_masonry').css({'opacity':0});	
	}
	//BLOG ISOTOPE FUNCTIONS
	function rearrange_cols()
	{
		var columns = Math.ceil($container_blog.width()/375);
		var entry_width = ($container_blog.width()-10)/columns;
		entry_width = Math.floor(entry_width)-20;//20 is for the margins
		//FORCE COLUMNS TO HAVE A MINIMUM SIZE
		if (entry_width<200)
		{
			columns--;	
		}
		entry_width = ($container_blog.width()-10)/columns;
		entry_width = Math.floor(entry_width)-20;//20 is for the margins
		jQuery(".blog_entry_li").each(function(index)
		{
			jQuery(this).css({"width":entry_width});
			jQuery(this).find('.blog_fader_grid').height(jQuery(this).find('.grid_image').height());
			if (entry_width<250)
			{
				jQuery(this).find('.masonr_read_more').css({width:22,height:22,overflow:'hidden'});
				jQuery(this).find('.masonr_read_more').parent().css({'margin-left':10});
			}
			else
			{
				jQuery(this).find('.masonr_read_more').css({width:'',height:'',overflow:''});
				jQuery(this).find('.masonr_read_more').parent().css({'margin-left':''});
			}

		});
	}
	function rearrange_layout()
	{
		var winWidth = jQuery(window).width();
		rearrange_cols();
		$container_blog.isotope('reLayout',function()
		{
			//DELAY CALCULATIONS IF WE ARE SCALING DOWN THE STAGE
			if(jQuery(window).width() != winWidth) 
				setTimeout(function(){ rearrange_layout();},10);
		});
	}
	if (jQuery('#blog_entries_masonr').length)
	{
		var $container_blog = jQuery('#blog_entries_masonr');;
		jQuery('#blog_entries_masonr').css({'opacity':0});	
		rearrange_cols();
		$container_blog.isotope({
		itemSelector : '.blog_entry_li',
		resizable: false,
		transformsEnabled: false
		},function()
		{
	
		});
		
		jQuery(window).on("debouncedresize", function( event ) {
			rearrange_layout();
		});
	}
		function ready(playerID){
			setTimeout(function(){ 
				Froogaloop(playerID).addEvent('play', function(data){
			 	stop_slider();
            	});}
				,100);
          	
			Froogaloop(playerID).addEvent('pause', function(data){
     			play_slider();
    		});
      	}
	jQuery(window).load(function() 
	{
		//SHOW TINTED IMAGES
		jQuery('img.filter-tint').css({'opacity':'1'});		
		if (jQuery('#entries_navigation a').length || jQuery('#entries_navigation_mason a').length)
		{
			jQuery(window).scroll(function()
			{
				checkAndLoad();
			});
		}
		//ADJUST COMMENTS LINES
		jQuery('.commentlist > li > .children').each(
		function(e) 
		{
			var p = jQuery(this).find('li').last();
			var offset = p.position();
			var m_height=offset.top+33;
			jQuery(this).parent().find(".comments_liner").css({'height':m_height});
		});
		function stop_slider()
		{
			if ($js_flexislider('#home_slider').length)
				$js_flexislider('#home_slider').flexslider('pause'); 
			if ($js_flexislider('#single_slider').length)
				$js_flexislider('#single_slider').flexslider('pause'); 
			if ($js_flexislider('.shortcode_slider').length)
				$js_flexislider('.shortcode_slider').flexslider('pause'); 	
		}
		function play_slider()
		{
			if ($js_flexislider('#home_slider').length)
				$js_flexislider('#home_slider').flexslider('play'); 
			if ($js_flexislider('#single_slider').length)
				$js_flexislider('#single_slider').flexslider('play'); 
			if ($js_flexislider('.shortcode_slider').length)
				$js_flexislider('.shortcode_slider').flexslider('play'); 
		}
		//FADE IN CONTENT
		jQuery('#aj_loader').css('display','none');
		jQuery('#main').css({'visibility':'visible','opacity':0});
		jQuery('#main').transition({
			delay:100,
			opacity:1,
			duration:400,
			easing:'linear' 
		});
		//ALIGN IF NEEDED
		if (jQuery(window).width()<(980 - scrollBarWidth) && resp_mode=="true")
		{
			jQuery('.centered_by_js').each(function(index, element) {
				jQuery(this).css({'display':'inline-block'});
                jQuery(this).css({'margin-left':-parseInt((jQuery(this).width()+2*parseInt(jQuery(this).css('padding-left')))/2)});
				jQuery(this).css({'display':''});
            });
		}
		else
		{
			jQuery('.centered_by_js').each(function(index, element) {
				jQuery(this).css({'left':'','margin-left':''});
            });
		}
		//AJAX BLOG LOAD MORE IF NEEDED
		if (jQuery('#blog_entries').length)
			checkAndLoad();
		
		if (jQuery('#folio_masonry').length)
		{
			jQuery('#folio_masonry').delay(400).animate({opacity:1}, 200 );
	
		}
		if (jQuery('#blog_entries_masonr').length)
		{
			jQuery('#blog_entries_masonr').delay(400).animate({opacity:1}, 200 );
			rearrange_layout();
			setTimeout(function(){ checkAndLoad();},600);
		}
		if (jQuery('#folio_classic').length)
		{
			classic_gutter=-parseInt(jQuery('#folio_classic').css('margin-right'));
			$container.imagesLoaded( function() 
			{
				jQuery('#folio_classic').css({'display':'block'});
				var img_nr=Math.ceil($container.width()/430);
				var helper= Math.floor($container.width() / img_nr);
				var h_helper=Math.floor(helper/480*300);
				jQuery('.portfolio_entry_li').css({'height':h_helper}); 
				$container.isotope({
					itemSelector : '.portfolio_entry_li',
					resizable: false, // disable normal resizing
					// set columnWidth to a percentage of container width
					masonry: { columnWidth: $container.width() / img_nr },
					transformsEnabled : false,
					animationEngine : "jquery"
					},
					function()
					{
						jQuery('.portfolio_entry_li,.inset_shadow').css({'width':helper,'height':h_helper});
						jQuery('.portfolio_entry_li img').css({'margin-left':-Math.floor((480-helper)/2),'margin-top':-Math.floor((300-h_helper)/2)
					});
					jQuery('#folio_classic').delay(100).animate({opacity:1}, 100 );
					//NO 1 PIXEL SPACING SOMETIMES!
					setTimeout(function(){ jQuery(window).trigger( "smartresize");},10);
				});
			});
			jQuery(window).smartresize(function()
			{
				if (jQuery('#folio_classic').length)
				{
					//SET THE NUMBER OF IMAGES TO SHOW
					var img_nr=Math.ceil($container.width()/430);
					jQuery('.portfolio_entry_li').css({'width':'auto'}); 
					var helper= Math.floor($container.width() / img_nr);
					var h_helper=Math.floor(helper/480*300);
					jQuery('.portfolio_entry_li,.inset_shadow').css({'height':h_helper}); 
					jQuery('.portfolio_entry_li img').css({'margin-left':-Math.floor((480-helper)/2),'margin-top':-Math.floor((300-h_helper)/2)});
					$container.isotope({
						// update columnWidth to a percentage of container width
						masonry: { columnWidth: Math.floor($container.width() / img_nr) }
						},
						function()
						{
						 
						});
					jQuery('.portfolio_entry_li,.inset_shadow').css({'width':helper-classic_gutter});
				}
			});
		}//if (jQuery('#folio_classic').length)
		if (jQuery('#folio_masonry').length)
		{
			ms_gutter=-parseInt(jQuery('#folio_masonry').css('margin-right'));
			$container_folio_masonr.imagesLoaded( function() 
			{
				jQuery('#folio_masonry').css({'display':'block'});
				var img_nr=Math.ceil($container_folio_masonr.width()/430);
				var helper= Math.floor($container_folio_masonr.width() / img_nr);
				$container_folio_masonr.isotope({
					itemSelector : '.portfolio_entry_li',
					resizable: false, // disable normal resizing
					// set columnWidth to a percentage of container width
					masonry: { columnWidth: $container_folio_masonr.width() / img_nr },
					transformsEnabled : false,
					animationEngine : "jquery"
					},
					function()
					{
						jQuery('.portfolio_entry_li,.inset_shadow').css({'width':helper-ms_gutter});
						jQuery('#folio_masonry').delay(100).animate({opacity:1}, 100 );
						//NO 1 PIXEL SPACING SOMETIMES!
						setTimeout(function(){ jQuery(window).trigger( "smartresize");},10);
				});
			});
			jQuery(window).smartresize(function()
			{
				if (jQuery('#folio_masonry').length)
				{
					//SET THE NUMBER OF IMAGES TO SHOW
					var img_nr=Math.ceil($container_folio_masonr.width()/430);
					jQuery('.portfolio_entry_li').css({'width':'auto'}); 
					var helper= Math.floor($container_folio_masonr.width() / img_nr);
					jQuery('.portfolio_entry_li,.inset_shadow').css({'height':'auto'}); 
					jQuery('.portfolio_entry_li img').css({'width':helper+2});
					$container_folio_masonr.isotope({
						// update columnWidth to a percentage of container width
						masonry: { columnWidth: Math.floor($container_folio_masonr.width() / img_nr) }
						},
						function()
						{
						 
						});
					jQuery('.portfolio_entry_li,.inset_shadow').css({'width':helper-ms_gutter});
					jQuery(".portfolio_entry_li").each(function(index)
					{
						jQuery(this).find('.inset_shadow').css({'height':jQuery(this).find('.grid_image').height()});
					});
				}
			});
		}//if (jQuery('#folio_masonry').length)

		var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
		var matches = patt.exec(body_color);
		//if (custom_shadow!='0')
			//jQuery('.boxed_shadow').css({'-webkit-box-shadow': '0px 0px 4px 0px rgba('+parseInt(matches[1], 16)+','+parseInt(matches[2], 16)+','+parseInt(matches[3], 16)+','+custom_shadow+')','box-shadow': '0px 0px 4px 0px rgba('+parseInt(matches[1], 16)+','+parseInt(matches[2], 16)+','+parseInt(matches[3], 16)+','+custom_shadow+')'});
			
		offset_sd = p.position();
		//RELATED PORTFOLIO POSTS CAROUSEL
		if ($js_flexislider('#carousel_single').length)
		{
			var $size_helper=4;
			if ($js_flexislider('#carousel_single li').size()<$size_helper)
				$size_helper=$js_flexislider('#carousel_single li').size();
			jQuery('#carousel_single').elastislide({
					imageW 	: 606,
					minItems	: $size_helper,
					margin      : 1,
				});
		}
		//HOMEPAGE MAIN SLIDER	
		if ($js_flexislider('#home_slider').length)
		{
			if (is_iphone > -1)
			{
				jQuery('body').css({height:'auto'});	
			}

			jQuery(window).on("debouncedresize", function( event ) 
			{
				$js_flexislider('#home_slider .slides>li').each(function(index, element) 
				{
					//GET THE IMAGE ORIGINAL DIMENSIONS
					jQuery(this).find('img').width(parseInt(jQuery(this).find('img').attr('or_w')));
					jQuery(this).find('img').height(parseInt(jQuery(this).find('img').attr('or_h')));
					var minWidth = jQuery(this).parent().width(); // Max width for the image
					var minHeight = jQuery(window).height();    // Max height for the image
					var ratio = 0;  // Used for aspect ratio
					var width = jQuery(this).find('img').width();    // Current image width
					var height = jQuery(this).find('img').height();  // Current image height
					// Check if the current width is larger than the max
					if(width < minWidth) {
						ratio = minWidth / width;
						jQuery(this).find('img').css("width", minWidth); // Set new width
						jQuery(this).find('img').css("height", height * ratio);  // Scale height based on ratio
						height = height * ratio;    // Reset height to match scaled image
					}
					
				
					var width = jQuery(this).find('img').width();    // Current image width
					var height = jQuery(this).find('img').height();  // Current image height
				
					// Check if current height is larger than max
					if(height < minHeight){
						ratio = minHeight / height; // get ratio for scaling image
						jQuery(this).find('img').css("height", minHeight);   // Set new height
						jQuery(this).find('img').css("width", width * ratio);    // Scale width based on ratio
						width = width * ratio;    // Reset width to match scaled image
					}
					//LIMIT SLIDER HEIGHT ON SMALL DEVICES
					if(is_touch() && is_iphone > -1)
					{ //if touch events exist...
						if (Math.abs(window.orientation) == 90)
						{
							//alert ('landscape');
							ratio = 210 / jQuery(this).find('img').height(); // get ratio for scaling image
							jQuery(this).find('img').css("height", 210);   // Set new height
							jQuery(this).find('img').css("width", jQuery(this).find('img').width() * ratio);    // Scale width based on ratio
							//width = width * ratio;    // Reset width to match scaled image
							if(jQuery(this).find('img').width() < jQuery(window).width()) {
								ratio = jQuery(window).width() / jQuery(this).find('img').width();   // get ratio for scaling image
								jQuery(this).find('img').css("width", jQuery(window).width()); // Set new width
								jQuery(this).find('img').css("height", jQuery(this).find('img').height() * ratio);  // Scale height based on ratio
								//height = height * ratio;    // Reset height to match scaled image
							}
						}
						else
						{
							//alert ('portrait');
							ratio = 350 / jQuery(this).find('img').height(); // get ratio for scaling image
							jQuery(this).find('img').css("height", 350);   // Set new height
							jQuery(this).find('img').css("width", jQuery(this).find('img').width() * ratio);    // Scale width based on ratio
							//width = width * ratio;    // Reset width to match scaled image
							//if(jQuery(this).find('img').width() < jQuery(window).width()) {
								ratio = jQuery(window).width() / jQuery(this).find('img').width();   // get ratio for scaling image
								jQuery(this).find('img').css("width", jQuery(window).width()); // Set new width
								jQuery(this).find('img').css("height", jQuery(this).find('img').height() * ratio);  // Scale height based on ratio
								//height = height * ratio;    // Reset height to match scaled image
							//}
						}
					}
					//ADJUST MARGINS
					jQuery(this).find('img').css("margin-left",-(jQuery(this).find('img').width()-minWidth)/2);
					if (jQuery(window).width()<780)
						jQuery(this).find('img').css("margin-top",0);
					else
						jQuery(this).find('img').css("margin-top",-(jQuery(this).find('img').height()-minHeight)/2);
					if (jQuery(this).find('.slider_text_holder').hasClass('sld_top'))
					{
						
					}
					else
					{	
						var btm_dis=parseInt(jQuery(this).find('.headings_body').height());//18 is for padding and 60 is the real margin
						//alert (btm_dis);
						jQuery(this).find('.slider_text_holder').css({
							"bottom":-parseInt(jQuery(this).find('img').css("margin-top"))+10
						});
					}
					//ALSO FORCE YOUTUBE AND VIMEO VIDEO DIMENSIONS - FIX FOR IE AND FIREFOX
					jQuery(this).find('iframe').css("height", jQuery(window).height());
				});
				jQuery('.flex-direction-nav li a').css({'top':jQuery(window).height()/2-24});
			});//DEBOUNCED RESIZE
			$js_flexislider('#home_slider').css({'opacity':0});
			jQuery('.push').css({'display':'none'});
			jQuery('#bottom_sidebar').css({'display':'none'});
			jQuery('body').css({'overflow-y':'hidden'});
			$js_flexislider('#home_slider').flexslider(
			{
				slideshow : $js_flexislider('#home_slider>ul').attr('data-autoplay') === "yes" ? true : false,
				slideshowSpeed : $js_flexislider('#home_slider>ul').attr('data-delay'),
				smoothHeight: false,
				controlNav: true,
				pauseOnHover: true,
				touch:false,
				start:function (slider)
				{
					jQuery('.flexslider').css({'min-height':0});
					jQuery('.flex-control-nav').css({'display':'none'});
					jQuery('.flex-direction-nav li a.flex-prev').each(function(index, element) 
					{
						jQuery(this).prepend('<div class="tr_wrapper" style="height:40px;"><div class="pirenko_tinted submenu_arrow_left"><img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'+background_color+'" src="'+theme_url_js+'/images/icons/arrows.png" style="position:absolute;"/></div></div>');
						addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
                    });
					jQuery('.flex-direction-nav li a.flex-next').each(function(index, element) 
					{
						jQuery(this).prepend('<div class="tr_wrapper" style="height:40px;width:42px;"><div class="pirenko_tinted submenu_arrow_right"><img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'+background_color+'" src="'+theme_url_js+'/images/icons/arrows.png" style="position:absolute;"/></div></div>');
						addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
                    });
					jQuery('img.filter-tint').css({'opacity':'1'});
					//ADJUST IMAGE SIZE
					jQuery(window).trigger("debouncedresize");
					//FIX FOR TEXT POSITION WHEN THERE?S ONLY 1 SLIDE
					jQuery('#pixia_slide_0').css({'float':'left','width':'100%'});
					//ADJUST TEXT TO BE SHOWN
					my_string='#pixia_slidetop_0';
					my_body_string='#pixia_slidebody_0';
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(jQuery(my_string)).transition({
						delay:1200,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(jQuery(my_body_string)).transition({
						delay:1400,
						opacity:1,
						duration:300,
						left:0
					});		
					jQuery($js_flexislider('#home_slider')).transition({
						delay:100,
						opacity:1,
						duration:600,
					});	
					jQuery('.flex-direction-nav li a').css({'top':jQuery(window).height()/2-24});
					if (jQuery('.flex-direction-nav').length)
					{
						//OPERA DOES NOT LIKE is(':hover') SO LET'S CHECK IT FIRST
						if (!window.opera && jQuery('#home_slider').is(':hover') && !is_touch()) {
							//REAPPLY FILTERS - BUG?
							jQuery('.flex-direction-nav li a.flex-prev,.flex-direction-nav li a.flex-next').each(function(index, element) {		
								addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
							});
							jQuery($js_flexislider('.flex-direction-nav')).stop().transition({
								delay:100,
								opacity:1,
								duration:300,
							});	
							jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).stop().transition({
								delay:100,
								left:0,
								opacity:1,
								duration:300,
							});	
							jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).stop().transition({
								delay:100,
								right:0,
								opacity:1,
								duration:300,
							});							
						}
						if (!is_touch())
						{
							jQuery('#home_slider').hover(
							function() 
							{
								//REAPPLY FILTERS - BUG?
								jQuery('.flex-direction-nav li a.flex-prev,.flex-direction-nav li a.flex-next').each(function(index, element) {		
									addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
								});
								jQuery($js_flexislider('.flex-direction-nav')).stop().transition({
									delay:100,
									opacity:1,
									duration:300,
								});	
								jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).stop().transition({
									delay:100,
									left:0,
									opacity:1,
									duration:300,
								});	
								jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).stop().transition({
									delay:100,
									right:0,
									opacity:1,
									duration:300,
								});	
							},
							function()
							{
								jQuery($js_flexislider('.flex-direction-nav')).stop().transition({
									delay:300,
									opacity:0,
									duration:300,
								});	
								jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).stop().transition({
									delay:300,
									left:10,
									opacity:0,
									duration:300,
								});	
								jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).stop().transition({
									delay:300,
									right:10,
									opacity:0,
									duration:300,
								});	
							});
						}//!is_touch()
						else
						{
							//REAPPLY FILTERS - BUG?
							jQuery('.flex-direction-nav li a.flex-prev,.flex-direction-nav li a.flex-next').each(function(index, element) {		
								addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
							});
							jQuery($js_flexislider('.flex-direction-nav')).stop().transition({
								delay:100,
								opacity:1,
								duration:300,
							});
							if (is_iphone > -1)
							{
							jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).css({'left':'50%','margin-left':-49});
							jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).css({'left':'50%'});
							}
							else
							{
								jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).css({'left':0});
								jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).css({'right':0});
							}
							jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).stop().transition({
								delay:100,
								opacity:1,
								duration:300,
							});	
							jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).stop().transition({
								delay:100,
								opacity:1,
								duration:300,
							});		
						}
					}
					pirenko_resize();
				},
				before: function(slider)
				{
					//PAUSE VIMEO VIDEOS IF POSSIBLE
					if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0 && slider.slides.eq(slider.currentSlide).find('iframe').hasClass('vim_video')) {
						$f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');  
					}
					my_string='#pixia_slidetop_'+slider.currentSlide;
					my_body_string='#pixia_slidebody_'+slider.currentSlide;
					jQuery(my_string).stop().animate({opacity:0}, 200 );
					jQuery(my_body_string).stop().animate({opacity:0}, 200 );
					
					$js_flexislider('#pixia_slide_'+slider.animatingTo).each(function(index, element) 
					{
						jQuery(this).find('img').width(parseInt(jQuery(this).find('img').attr('or_w')));
						jQuery(this).find('img').height(parseInt(jQuery(this).find('img').attr('or_h')));
						var minWidth = jQuery(this).parent().width(); // Max width for the image
						var minHeight = jQuery(window).height();    // Max height for the image
						var ratio = 0;  // Used for aspect ratio
						var width = jQuery(this).find('img').width();    // Current image width
						var height = jQuery(this).find('img').height();  // Current image height
						// Check if the current width is larger than the max
						if(width < minWidth) {
							ratio = minWidth / width;   // get ratio for scaling image
							jQuery(this).find('img').css("width", minWidth); // Set new width
							jQuery(this).find('img').css("height", height * ratio);  // Scale height based on ratio
							height = height * ratio;    // Reset height to match scaled image
						}
						var width = jQuery(this).find('img').width();    // Current image width
						var height = jQuery(this).find('img').height();  // Current image height
					
						// Check if current height is larger than max
						if(height < minHeight){
							ratio = minHeight / height; // get ratio for scaling image
							jQuery(this).find('img').css("height", minHeight);   // Set new height
							jQuery(this).find('img').css("width", width * ratio);    // Scale width based on ratio
							width = width * ratio;    // Reset width to match scaled image
						}
						//LIMIT SLIDER HEIGHT ON SMALL DEVICES
						if(is_touch() && is_iphone > -1 )
						{ //if touch events exist...
							if (Math.abs(window.orientation) == 90)
							{
								//alert ('landscape');
								ratio = 210 / jQuery(this).find('img').height(); // get ratio for scaling image
								jQuery(this).find('img').css("height", 210);   // Set new height
								jQuery(this).find('img').css("width", jQuery(this).find('img').width() * ratio);    // Scale width based on ratio
								//width = width * ratio;    // Reset width to match scaled image
								if(jQuery(this).find('img').width() < jQuery(window).width()) {
									ratio = jQuery(window).width() / jQuery(this).find('img').width();   // get ratio for scaling image
									jQuery(this).find('img').css("width", jQuery(window).width()); // Set new width
									jQuery(this).find('img').css("height", jQuery(this).find('img').height() * ratio);  // Scale height based on ratio
									//height = height * ratio;    // Reset height to match scaled image
								}
							}
							else
							{
								//alert ('portrait');
								ratio = 350 / jQuery(this).find('img').height(); // get ratio for scaling image
								jQuery(this).find('img').css("height", 350);   // Set new height
								jQuery(this).find('img').css("width", jQuery(this).find('img').width() * ratio);    // Scale width based on ratio
								//width = width * ratio;    // Reset width to match scaled image
								//if(jQuery(this).find('img').width() < jQuery(window).width()) {
									ratio = jQuery(window).width() / jQuery(this).find('img').width();   // get ratio for scaling image
									jQuery(this).find('img').css("width", jQuery(window).width()); // Set new width
									jQuery(this).find('img').css("height", jQuery(this).find('img').height() * ratio);  // Scale height based on ratio
									//height = height * ratio;    // Reset height to match scaled image
								//}
							}
						}
						//ADJUST MARGINS
						jQuery(this).find('img').css("margin-left",-(jQuery(this).find('img').width()-minWidth)/2);
						if (jQuery(window).width()<780)
							jQuery(this).find('img').css("margin-top",0);
						else
						jQuery(this).find('img').css("margin-top",-(jQuery(this).find('img').height()-minHeight)/2);
						
					});
				},
				after: function(slider)
				{
					my_string='#pixia_slidetop_'+slider.currentSlide;
					my_body_string='#pixia_slidebody_'+slider.currentSlide;
					if (jQuery(my_string).parent().hasClass('sld_top'))
					{
						
					}
					else
					{	
						var btm_dis=parseInt(jQuery(my_body_string).height());//18 is for padding and 60 is the real margin
						jQuery(my_string).parent().css({
							"bottom":-parseInt(jQuery(my_string).parent().parent().find('img').css("margin-top"))+10
							//"padding-bottom":-parseInt(jQuery(my_string).parent().parent().find('img').css("margin-top"))
						});
					}
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(jQuery(my_string)).transition({
						delay:400,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(jQuery(my_body_string)).transition({
						delay:600,
						opacity:1,
						duration:300,
						left:0
					});	
				}
			});
		}
		//SINGLE PAGES SLIDER - PORTFOLIO AND BLOG
		if ($js_flexislider('#single_slider').length)
		{
			autoplay_portfolio = autoplay_portfolio === "true" ? true : false;
			$js_flexislider('#single_slider').flexslider(
			{
				slideshow : autoplay_portfolio,
				slideshowSpeed : delay_portfolio,
				controlNav: true,
				smoothHeight: true,
				pauseOnHover: true, 
				touch:false,
				start:function (slider)
				{
					jQuery('.flexslider').css({'min-height':0});
					jQuery('#single_slider ol').addClass('four columns');
					jQuery('.flex-direction-nav li a.flex-prev').each(function(index, element) 
					{
						jQuery(this).prepend('<div class="tr_wrapper" style="height:40px;"><div class="pirenko_tinted submenu_arrow_left"><img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'+background_color+'" src="'+theme_url_js+'/images/icons/arrows.png" style="position:absolute;"/></div></div>');
						addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
                    });
					jQuery('.flex-direction-nav li a.flex-next').each(function(index, element) 
					{
						jQuery(this).prepend('<div class="tr_wrapper" style="height:40px;width:42px;"><div class="pirenko_tinted submenu_arrow_right"><img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'+background_color+'" src="'+theme_url_js+'/images/icons/arrows.png" style="position:absolute;"/></div></div>');
						addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
                    });
					jQuery('img.filter-tint').css({'opacity':'1'});
					if (jQuery('.flex-direction-nav').length)
					{
						//OPERA DOES NOT LIKE is(':hover') SO LET'S CHECK IT FIRST
						if (!window.opera && jQuery('#single_slider').is(':hover') && !is_touch()) 
						{
							//REAPPLY FILTERS - BUG?
							jQuery('.flex-direction-nav li a.flex-prev,.flex-direction-nav li a.flex-next').each(function(index, element) {		
								addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
							});
							jQuery($js_flexislider('.flex-direction-nav')).stop().transition({
								delay:100,
								opacity:1,
								duration:300,
							});	
							jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).stop().transition({
								delay:100,
								left:0,
								duration:300,
							});	
							jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).stop().transition({
								delay:100,
								right:0,
								duration:300,
							});					
						}
						if (!is_touch())
						{
							jQuery('#single_slider').hover(
							function() 
							{
								//REAPPLY FILTERS - BUG?
								jQuery('.flex-direction-nav li a.flex-prev,.flex-direction-nav li a.flex-next').each(function(index, element) {		
									addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
								});
								jQuery($js_flexislider('.flex-direction-nav')).stop().transition({
									delay:100,
									opacity:1,
									duration:300,
								});	
								jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).stop().transition({
									delay:100,
									left:0,
									duration:300,
								});	
								jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).stop().transition({
									delay:100,
									right:0,
									duration:300,
								});					
							},
							function()
							{
								jQuery($js_flexislider('.flex-direction-nav')).stop().transition({
									delay:300,
									opacity:0,
									duration:300,
								});	
								jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).stop().transition({
									delay:300,
									left:10,
									duration:300,
								});	
								jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).stop().transition({
									delay:300,
									right:10,
									duration:300,
								});	
							});
						}//!is_touch()
						else
						{
							//REAPPLY FILTERS - BUG?
							jQuery('.flex-direction-nav li a.flex-prev,.flex-direction-nav li a.flex-next').each(function(index, element) {		
								addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
							});
							jQuery($js_flexislider('.flex-direction-nav')).stop().transition({
								delay:100,
								opacity:1,
								duration:300,
							});	
							jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).stop().transition({
								delay:100,
								left:0,
								opacity:1,
								duration:300,
							});	
							jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).stop().transition({
								delay:100,
								right:0,
								opacity:1,
								duration:300,
							});		
						}
					}
				},
				before: function(slider) {
					//PAUSE VIMEO VIDEOS IF POSSIBLE
					if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0 && slider.slides.eq(slider.currentSlide).find('iframe').hasClass('vim_video')) {
						$f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');  
					}
					my_string='#slide_'+slider.animatingTo;
					if (jQuery(my_string).hasClass('slide_video'))
					{
						//jQuery(my_string).css({'height':jQuery(my_string).find('iframe').css('height')});
						
					}
					else
					{
						
					}
				},
				after: function(slider)
				{
					my_string='#slide_'+slider.currentSlide;
					if (jQuery(my_string).hasClass('slide_video'))
					{
						//jQuery ('.single_slider .flex-direction-nav').css({ 'bottom':31});
					}
					else
					{
						//jQuery ('.single_slider .flex-direction-nav').css({ 'bottom':11});	
					}
					//jQuery(my_body_string).stop().animate({opacity:1}, 1000 );
				}
			});
		}
		if ($js_flexislider('.shortcode_slider').length)
		{
			//autoplay_portfolio = autoplay_portfolio === "true" ? true : false;
			$js_flexislider('.shortcode_slider').flexslider(
			{
				slideshow : true,
				slideshowSpeed : delay_portfolio,
				controlNav: false,
				directionNav: true,
				smoothHeight: true,
				pauseOnHover: true, 
				touch:false,
				start:function (slider)
				{
					jQuery('.flexslider').css({'min-height':0});
					my_string='#'+jQuery(slider).find('ul').attr('id')+'top_0';
					my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_0'
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(jQuery(my_string)).transition({
						delay:600,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(jQuery(my_body_string)).transition({
						delay:800,
						opacity:1,
						duration:300,
						left:0
					});	
					if (jQuery('.flex-direction-nav').length)
					{
						jQuery('.flex-direction-nav li a.flex-prev').each(function(index, element) 
						{
							jQuery(this).prepend('<div class="tr_wrapper" style="height:40px;"><div class="pirenko_tinted submenu_arrow_left"><img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'+background_color+'" src="'+theme_url_js+'/images/icons/arrows.png" style="position:absolute;"/></div></div>');
							addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
						});
						jQuery('.flex-direction-nav li a.flex-next').each(function(index, element) 
						{
							jQuery(this).prepend('<div class="tr_wrapper" style="height:40px;width:42px;"><div class="pirenko_tinted submenu_arrow_right"><img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="'+background_color+'" src="'+theme_url_js+'/images/icons/arrows.png" style="position:absolute;"/></div></div>');
							addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
						});
						jQuery('img.filter-tint').css({'opacity':'1'});
						//OPERA DOES NOT LIKE is(':hover') SO LET'S CHECK IT FIRST
						if (!window.opera && jQuery('.shortcode_slider').is(':hover') && !is_touch()) 
						{
							//REAPPLY FILTERS - BUG?
							jQuery('.flex-direction-nav li a.flex-prev,.flex-direction-nav li a.flex-next').each(function(index, element) {		
								addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
							});
							jQuery('.flex-direction-nav').stop().transition({
								delay:100,
								opacity:1,
								duration:300,
							});	
							jQuery('.flex-direction-nav li a.flex-prev').stop().transition({
								delay:100,
								left:0,
								duration:300,
							});	
							jQuery('.flex-direction-nav li a.flex-next').stop().transition({
								delay:100,
								right:0,
								duration:300,
							});					
						}
						if (!is_touch())
						{
							jQuery('.shortcode_slider').hover(
							function() 
							{
								//REAPPLY FILTERS - BUG?
								jQuery('.flex-direction-nav li a.flex-prev,.flex-direction-nav li a.flex-next').each(function(index, element) {		
									addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
								});
								jQuery('.flex-direction-nav').stop().transition({
									delay:100,
									opacity:1,
									duration:300,
								});	
								jQuery('.flex-direction-nav li a.flex-prev').stop().transition({
									delay:100,
									left:0,
									duration:300,
								});	
								jQuery('.flex-direction-nav li a.flex-next').stop().transition({
									delay:100,
									right:0,
									duration:300,
								});					
							},
							function()
							{
								jQuery('.flex-direction-nav').stop().transition({
									delay:300,
									opacity:0,
									duration:300,
								});	
								jQuery('.flex-direction-nav li a.flex-prev').stop().transition({
									delay:300,
									left:10,
									duration:300,
								});	
								jQuery('.flex-direction-nav li a.flex-next').stop().transition({
									delay:300,
									right:10,
									duration:300,
								});	
							});
						}//!is_touch()
						else
						{
							//REAPPLY FILTERS - BUG?
							jQuery('.flex-direction-nav li a.flex-prev,.flex-direction-nav li a.flex-next').each(function(index, element) {		
								addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
							});
							jQuery($js_flexislider('.flex-direction-nav')).stop().transition({
								delay:100,
								opacity:1,
								duration:300,
							});	
							jQuery($js_flexislider('.flex-direction-nav li a.flex-prev')).stop().transition({
								delay:100,
								left:0,
								opacity:1,
								duration:300,
							});	
							jQuery($js_flexislider('.flex-direction-nav li a.flex-next')).stop().transition({
								delay:100,
								right:0,
								opacity:1,
								duration:300,
							});		
						}
					}
				},
				before: function(slider) {
					//PAUSE VIMEO VIDEOS IF POSSIBLE
					if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0 && slider.slides.eq(slider.currentSlide).find('iframe').hasClass('vim_video')) {
						$f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');  
					}
					my_string='#'+jQuery(slider).find('ul').attr('id')+'top_'+slider.currentSlide;
					my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_'+slider.currentSlide;
					jQuery(my_string).stop().animate({opacity:0}, 200 );
					jQuery(my_body_string).stop().animate({opacity:0}, 200 );
				},
				after: function(slider)
				{
					//alert (slider.currentSlide);
					my_string='#'+jQuery(slider).find('ul').attr('id')+'top_'+slider.currentSlide;
					my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_'+slider.currentSlide;
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(jQuery(my_string)).transition({
						delay:600,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(jQuery(my_body_string)).transition({
						delay:800,
						opacity:1,
						duration:300,
						left:0
					});		
				}
			});
		}
		if ($js_flexislider('#comments_slider').length)
		{
			$js_flexislider('#comments_slider').flexslider(
			{
				animation: "fade",
				useCSS  :false,        
				slideshow: true,    
				slideshowSpeed: 5000,    
				animationDuration: 300, 
				smoothHeight: true,
				directionNav: false,   
				controlNav: false,   
				keyboardNav: false,
				touch:false,
				start:function (slider)
				{
					jQuery('.flexslider').css({'min-height':0});
					jQuery(window).trigger("debouncedresize");
					$js_flexislider('#comments_slider').stop().delay(100).animate({'opacity':'1'}, 100 );
				},
				before: function(slider)
				{
					
				},
				after: function(slider)
				{
					  
				}
			});
		}
		jQuery('.flex-direction-nav li .flex-next,.flex-direction-nav li .flex-prev,.es-nav-next,.es-nav-prev').hover(
		function() 
		{
			jQuery(this).find('.tr_wrapper img').stop().transition({
				opacity:0.7,
				duration:300,
			});	
		},
		function()
		{
			jQuery(this).find('.tr_wrapper img').stop().transition({
				opacity:1,
				duration:300,
			});	
		});
		jQuery('.read_more_blog').hover(
		function() 
		{
			jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',active_color);
			addFilter_single(jQuery(this).find('.tr_wrapper img'));
		},
		function()
		{
			jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',clearer_inactive_color);
			addFilter_single(jQuery(this).find('.tr_wrapper img'));
		});	
		jQuery('.type-pirenko_portfolios .navigation-previous,.type-pirenko_portfolios .navigation-next').hover(
		function() 
		{
			jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',active_color);
			addFilter_single(jQuery(this).find('.tr_wrapper img'));
		},
		function()
		{
			jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',darker_inactive_color);
			addFilter_single(jQuery(this).find('.tr_wrapper img'));
		});
		jQuery('.type-post .navigation-previous,.type-post .navigation-next').hover(
		function() 
		{
			jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',active_color);
			addFilter_single(jQuery(this).find('.tr_wrapper img'));
		},
		function()
		{
			jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',clearer_inactive_color);
			addFilter_single(jQuery(this).find('.tr_wrapper img'));
		});
		//SOCIAL WIDGET - ANIMATIONS
		jQuery('#pirenko_social a').find('img').each(function(index, element) {
			if (jQuery(this).attr('data-c_color')!="")
			{
				jQuery(this).attr('data-pb-tint-colour',jQuery(this).attr('data-c_color'));
				addFilter_single(jQuery(this));
			}
		});
		// Enable the API on each Vimeo video
		jQuery('iframe').each(function(){  
      		Froogaloop(this).addEvent('ready', ready);
      	});	
	});
	var left_help=0;
	//THUMBS ROLLOVER
	jQuery('.grid_image_wrapper').hover(
	function() 
	{
		jQuery(this).find('.inner_skills').stop();
		jQuery(this).find('.grid_colored_block').stop();
		jQuery(this).find('.grid_single_title').stop();
		//ADJUST TITLE VERTICALLY
		jQuery(this).find('.grid_single_title').css({'font-size':'20px'});
		jQuery(this).find('.inner_skills').css({'font-size':'14px'});
		var dif=parseInt(jQuery(this).find('.grid_single_title').css('height'))/2;
		var topper_y=Math.floor((jQuery(this).parent().parent().height()/2)-dif);
		jQuery(this).find('.grid_single_title').css({'top':topper_y-25,'opacity':0});
		
		left_help=-1000+parseInt(jQuery(this).parent().parent().width())/2;
		jQuery(this).find('.grid_single_title').css({'font-size':'52px','marginLeft':left_help});
		jQuery(this).find('.inner_skills').css({'font-size':'44px'});
		var w_help=parseInt(jQuery(this).parent().parent().width());
		jQuery(this).find('.inner_skills').stop().delay(150).transition({
			fontSize:'14px',
			opacity:1
		},300);
		jQuery(this).find('.grid_colored_block').stop().transition({
			opacity:0.86
		},300);
		jQuery(this).find('.grid_single_title').stop().delay(150).transition({
			opacity: 1,
			fontSize:'20px',
			marginLeft:0,
			'top':topper_y,
			width:w_help
		},300);
	},
	function()
	{
		jQuery(this).find('.inner_skills').stop();
		jQuery(this).find('.grid_colored_block').stop();
		jQuery(this).find('.grid_single_title').stop();
		//ADJUST TITLE VERTICALLY
		var topper_y=parseInt(jQuery(this).find('.grid_single_title').css('top'))-25;
		var left_help=-1000+parseInt(jQuery(this).parent().parent().width())/2;
		jQuery(this).find('.grid_single_title').stop().animate({
			opacity: 0,
			fontSize:'52px',
			'top':topper_y,
		},300);
		jQuery(this).find('.grid_single_title').transition({
			marginLeft:left_help,
			width:'2000px',
			duration:300
		});
		jQuery(this).find('.inner_skills').stop().animate({
			fontSize:'44px',
			opacity:0
		},300);
		jQuery(this).find('.grid_colored_block').stop().delay(150).animate({
			duration:300,
			opacity:0
		});
		
	});
	
	jQuery('.related_post').hover(
	function() 
	{
		var dif=parseInt(jQuery(this).find('.related_single_title').css('height'))/2;
		var topper_y=Math.floor((jQuery(this).parent().parent().height()/2)-dif);
		jQuery(this).find('.related_fader_grid').stop().animate({'opacity':'0.94'}, 300 );
		jQuery(this).find('.related_single_title').stop();
		jQuery(this).find('.related_single_title').css({'top':topper_y,'opacity':0});
		jQuery(this).find('.related_single_title').stop().delay(50).animate({'opacity':1}, 100 );
				},
				function()
				{
					jQuery(this).find('.related_fader_grid').stop().animate({'opacity':0}, 500 );
					jQuery(this).find('.related_single_title').stop().animate({'opacity':0}, 300 );
	},
	function()
	{
		jQuery(this).stop().animate({'opacity':0}, 2000 );
	});
	
	//LOGO ROLLOVER
	jQuery('#queed_logo_image').parent().hover(function() 
	{
		jQuery(this).stop().animate({opacity:0.85}, 200 );
	}, 
	function() 
	{
		jQuery(this).stop().animate({opacity:1}, 1000 );
		jQuery(this).blur();
	});
	
	//SHOW OVERLAY
	jQuery('.overlay').show();
	
	//FUNCTION THAT WILL BE EXECUTED WHEN THE WINDOW IS RESIZED
	function pirenko_resize()
	{
		jQuery('.commentlist > li > .children').each(
		function(e) 
		{
			var p = jQuery(this).find('li').last();
			var offset = p.position();
			var m_height=offset.top+33;
			jQuery(this).parent().find(".comments_liner").css({'height':m_height});
		});
		offset_sd = p.position();
		btm_val=0;
				if (jQuery('#bottom_sidebar').height()>jQuery(window).height())
				{
					btm_val=jQuery(window).height()-jQuery('#bottom_sidebar').height()-30;//30 is to leave some margin
				}
				jQuery('#bottom_sidebar').followTo(-btm_val);
		if ((jQuery(window).width()<(768 - scrollBarWidth) || jQuery(window).height()<=parseInt(custom_height)) && resp_mode=="true")
		{
			jQuery('body').css({'overflow-y':'visible'});
			jQuery("#nav-main").addClass('resp_mode');
			if (jQuery('#nav-main').hasClass('collapse'))
			{
				jQuery(".left_nav").height('0');
				jQuery('.left_nav').css({'display':'none'});
			}
			jQuery("#collapsed_menu_text").css({'display':'inline'});
			if (jQuery('#alt_logo').length)
			{
				jQuery('#alt_logo').css({'display':'inline'});
				jQuery('#pixia_logo_image').css({'display':'none'});
			}
		}
		else
		{
			if (jQuery('#home_slider').length)
				jQuery('body').css({'overflow-y':'hidden'});
			else
				jQuery('body').css({'overflow-y':''});
			jQuery("#nav-main").removeClass('resp_mode');
			jQuery(".left_nav").height('');
			jQuery('.left_nav').css({'display':''});
			jQuery('#alt_logo').css({'display':'none'});
			jQuery('#pixia_logo_image').css({'display':'inline'});
		}
		
		//ADJUST FOOTER IF NEEDED
		//jQuery('#content-info').offset({ top: auto });
		/*var footer_off=jQuery('#content-info').offset();
		//alert(footer_off.top);
		if ((footer_off.top+jQuery('#content-info').height())<jQuery(window).height())
			jQuery('#content-info').css({ top: jQuery(window).height()-footer_off.top-jQuery('#content-info').height() });
		else
			jQuery('#content-info').css({ top: 0 });
		//alert(footer_off.top);+footer);*/
	}
	
	//COLLAPSED MENU FUNCTIONS
	var collapsed_mode=true;
	//RESIZELISTENER
	jQuery(window).resize(function() 
	{
		pirenko_resize();
	});
	//DELAY BACKGROUND RESIZE
	jQuery(window).on("debouncedresize", function( event ) {
		pirenko_resize();
		if (jQuery('#full-screen-background-image').attr('src')!=undefined)
		{
			var scale=0;
			var original_scale=jQuery("#full-screen-background-image").attr('or_w')/jQuery("#full-screen-background-image").attr('or_h');
			var dth=jQuery(window).width()-parseInt(jQuery("#full-screen-background-image").css('margin-left'));
			var ght=jQuery("#full-screen-background-image").attr('or_h')*dth/jQuery("#full-screen-background-image").attr('or_w');
			if (ght<jQuery(window).height())
			{
				ght=jQuery(window).height();
				dth=ght*jQuery("#full-screen-background-image").attr('or_w')/jQuery("#full-screen-background-image").attr('or_h');
			}
			jQuery("#full-screen-background-image").css({'width':dth,'height':ght,'left':0,'top':-(ght-jQuery(window).height())/2});		
		}
		//REAPPLY FILTERS - BUG?
		jQuery('.flex-direction-nav li a.flex-prev,.flex-direction-nav li a.flex-next').each(function(index, element) {		
			addFilter_single(jQuery(this).parent().find('.tr_wrapper img'));
		});
		jQuery('#google-maps').css({'max-height':jQuery(window).height()-50});
	});
	//LOAD THE BACKGROUND IMAGE
	jQuery('<img/>').attr('src', bk_url).load(function() 
	{
		jQuery('#full-screen-background-image').attr('src', bk_url);
		jQuery('#full-screen-background-image').attr('or_w',jQuery('#full-screen-background-image').width());
		jQuery('#full-screen-background-image').attr('or_h',jQuery('#full-screen-background-image').height());
		jQuery(window).trigger("debouncedresize");
		pirenko_resize();
	});
	
	
	jQuery('.theme_button a').hover(
	function() 
	{
		jQuery(this).addClass('change');
		jQuery(this).css({'backgroundColor': darker_inactive_color});
		jQuery(this).parent().css({'opacity': 1});
	},
	function()
	{
		jQuery(this).removeClass('change');
		jQuery(this).css({'backgroundColor': active_color});
		jQuery(this).blur();
	});
	
	jQuery('.theme_button_inverted a').hover(
	function() 
	{
		jQuery(this).addClass('change');
		jQuery(this).css({'backgroundColor': active_color});
	},
	function()
	{
		jQuery(this).removeClass('change');
		jQuery(this).css({'backgroundColor': body_color});
		jQuery(this).parent().css({'opacity': 1});
		jQuery(this).blur();
	});
	jQuery('.lk_text').hover(
	function() 
	{
		jQuery(this).addClass('change');
		jQuery('#twitter_link').css({'backgroundColor': body_color});
		//jQuery(this).parent().css({'opacity': '0.78'});
	},
	function()
	{
		jQuery(this).removeClass('change');
		jQuery('#twitter_link').css({'backgroundColor': active_color});
		//jQuery(this).parent().css({'opacity': 1});
		jQuery(this).blur();
	});
	
	jQuery('.theme_tags a').hover(
	function() 
	{
		jQuery(this).parent().css({'backgroundColor': active_color});
		jQuery(this).parent().css({'opacity': 1});
	},
	function()
	{
		if (jQuery(this).parent().hasClass('active')==false)
		{
			jQuery(this).parent().css({'backgroundColor': ''});
			
			
		}
		jQuery(this).blur();
	});
	
	//TOP SIDEBAR BUTTON
	var open_mode=false;
	var btm_val=0;
	if (jQuery('.bottom_teaser').length)
	{
		jQuery('.bottom_teaser').hover(
		function() 
		{
			if (open_mode==false)
			{
				//jQuery('.bottom_teaser').animate({'top':'-42px'});
			}
			else
			{
				//jQuery('.bottom_teaser').animate({'top':'-47px'});
			}
		},
		function()
		{
			if (open_mode==false)
			{
				//jQuery('.bottom_teaser').animate({'top':'-47px'});
			}
			else
			{
				//jQuery('.bottom_teaser').animate({'top':'-42px'});
			}
		});
		jQuery('#down_arrow').click(function()
		{
			if (open_mode==false)
			{
				var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
				var matches = patt.exec(background_color);
				open_mode=true;
				btm_val=0;
				if (jQuery('#bottom_sidebar').height()>jQuery(window).height())
				{
					btm_val=jQuery(window).height()-jQuery('#bottom_sidebar').height()-30;//30 is to leave some margin
				}
				//jQuery('#bottom_sidebar').followTo(-btm_val);
				//alert (btm_val);
				jQuery('#bottom_sidebar').css({'bottom':-parseInt(offset_sd.top+200),'display':'block','visibility':'visible'});
				jQuery('#bottom_sidebar').stop().animate(
				{
					bottom: btm_val,
				}, 
				{
					easing:'easeOutCirc',
					duration:600,
					complete:function()
					{
						jQuery('#bottom_sidebar').followTo(-btm_val);	
					}
				});
				jQuery('#down_arrow').stop().animate(
				{
					opacity: 0,
				}, 
				{
					duration:100,
					complete:function()
					{
						jQuery('#down_arrow').css({'display':'none'});
					}
				});
				jQuery('#up_arrow').stop();
				jQuery('#up_arrow').css({'display':'inline-block','opacity':0});
				jQuery('#up_arrow').stop().animate(
				{
					opacity: 1,
				});
			}
			else
			{
				
			}
		});
		jQuery('#up_arrow').click(function()
		{
			
			if (open_mode==true)
			{
				open_mode=false;
				jQuery('#bottom_sidebar').stop().animate(
				{
					'bottom':-parseInt(offset_sd.top+200)
				}, 
				{
					easing:'easeInCirc',
					duration:600,
					complete:function()
					{
						jQuery('#bottom_sidebar').css({'display':'none'});
					}
				});
				jQuery('#up_arrow').stop().animate(
				{
					opacity: 0,
				}, 
				{
					duration:100,
					complete:function()
					{
						jQuery('#up_arrow').css({'display':'none'});
					}
				});
				jQuery('#down_arrow').stop();
				jQuery('#down_arrow').css({'display':'inline-block','opacity':0});
				jQuery('#down_arrow').stop().animate(
				{
					opacity: 1,
				});
			}
			else
			{
				
			}
		});
	}
	
	//TWITTER WIDGET - FUNCTION CALLED AFTER TWEETS ARE FULLY LOADED
	window.ended_tweets=function()
	{

	}
	
	
	jQuery('.blog_fader_grid').hover(
	function() 
	{
		jQuery(this).stop().animate({'opacity':'0.45'}, 200 );
	},
	function()
	{
		jQuery(this).stop().animate({'opacity':0}, 2000 );
	
	});
	
	
	//SIDEBAR ANIMATIONS
	jQuery('.widget_recent_entries a,.widget_categories a,.widget_archive a').hover(
	function() 
	{
		jQuery(this).stop().animate(
		{
			'margin-left':-3
		}
		, 100);
	},
	function()
	{
		jQuery(this).stop().animate(
		{
			'margin-left':2
		}
		, 100);
	});
	jQuery('.pirenko_tags .wp-tag-cloud li a').hover(
	function() 
	{
		jQuery(this).addClass('before_nav_icon');
	},
	function()
	{
		jQuery(this).removeClass('before_nav_icon');
	});
	
	//PRETTYPHOTO INIT
	var $jscript = jQuery.noConflict();
	$jscript("a[rel^='prettyPhoto']").prettyPhoto({
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		markup: '<div class="pp_pic_holder"> \
						<div class="ppt">&nbsp;</div> \
						<div class="pp_top"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"> \
							</div> \
						</div> \
						<div class="pp_content_container"> \
							<div class="pp_left"> \
							<div class="pp_right"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a class="pp_close" href="#">Close</a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#">next</a> \
											<a class="pp_previous" href="#">previous</a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<div class="pp_nav"> \
												<a href="#" class="pp_arrow_previous">Previous</a> \
												<p class="currentTextHolder">0/0</p> \
												<a href="#" class="pp_arrow_next">Next</a> \
											</div> \
											<p class="pp_description"></p> \
											<div class="pp_social">{pp_social}</div> \
											<a href="#" class="pp_expand" title="Expand the image">Expand</a> \
										</div> \
									</div> \
								</div> \
							</div> \
							</div> \
						</div> \
						<div class="pp_bottom"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
					</div> \
					<div class="pp_overlay"></div>',
					gallery_markup: '<div class="pp_gallery"> \
							</div>',
					social_tools: '<div class="pp_social"><a href="http://pinterest.com/pin/create/button/" class="pin-it-button" count-layout="horizontal" style="margin-right:5px;float:left;" target="_blank"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-size="medium" data-text="Check this out: " data-count="none" data-url="'+location.href+'">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=standard&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=25" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:25px;" allowTransparency="true"></iframe></div></div>' /* html or false to disable */,
					changepicturecallback: function()
					{
						var pinit_link='';
						jQuery('#folio_masonry>div').each(function() 
						{
							
							if(jQuery(this).find('.grid_image_wrapper').parent().attr('href')==jQuery('#fullResImage').attr('src'))
							{
								pinit_link=jQuery(this).find('.grid_image_wrapper').parent().attr('href');
							}
						});
						jQuery('.pin-it-button').click(
						function(e) 
						{
							e.preventDefault();
							
						if (pinit_link=='')
						{
							window.alert("You can't Pin this media!");
						}
						else
							window.open('http://pinterest.com/pin/create/button/?url='+pinit_link+'&media='+jQuery('#fullResImage').attr('src')+'');
					});
				}
	});
	
	//SMOOTH SCROLLING ANCHOR TAGS SCRIPT
	jQuery("a.smooth_anchor").click(function(event) {
		event.preventDefault();
		jQuery(this).blur();
		//alert (jQuery(jQuery(this).attr("href")).offset().top);
		var hash = '#'+jQuery(this).attr("href").split('#')[1]; //Puts hash in variable, and removes the # character
		jQuery("html, body").animate({
			scrollTop: jQuery(hash).offset().top + "px"
		}, {
			duration: 500,
			easing: "swing"
		});
		return false;
	});
	
	//AJAX MORE POSTS
	var jq_paged=-1;
	var jq_max=0;
	var jq_load=false;
	var delayed_counter=2;
	function load_more_ps()
	{	
		//CLASSIC BLOG 
		if (jQuery('#entries_navigation a').length)
		{
			jq_load=true;
			jQuery("#pir_loader_wrapper").css({'visibility':'visible','opacity':'1'});
			if (jq_paged==-1)
			{
				jq_paged=parseInt(jQuery('#entries_navigation a').parent().parent().attr('pir_curr'))+1;
			}
			var orig_text=jQuery('#entries_navigation a').html();
			jq_max=jQuery('#entries_navigation a').parent().parent().attr('pir_max');
			var link = jQuery('#entries_navigation a').attr('href');
			if (home_link!="")
			{
				link = link.replace(home_link, home_link+home_slug+'/');
			}
			jQuery('li').removeClass('last_li');
			jQuery('#blog_entries').append('<div id=more_content_'+jq_paged+'></div>');
			jQuery('#more_content_'+jq_paged+'').load(link+' #blog_entries',function()
			{
				//APPLY SPECIAL JQUERY METHODS TO ELEMENTS THAT WERE JUST LOADED
				//APPLY TINTS
				jQuery('#more_content_'+delayed_counter+'').find('.tr_wrapper img').each(function()
				{
					addFilter_single(jQuery(this));
				});
				//SHOW TINTED IMAGES
				$instance=jQuery('#more_content_'+delayed_counter+'');
				$instance.find('img.filter-tint').css({'opacity':'1'});
				//APPLY ROLLOVERS
				$instance.find(".post-like a").hover(function() 
				{
					jQuery(this).find('.count').css('color',active_color);
					jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour','#ff3030');
					addFilter_single(jQuery(this).find('.tr_wrapper img'));
				},
				function()
				{
					//RETURN TO PREVIOUS COLOR
					jQuery(this).find('.count').css('color','');
					if (jQuery(this).attr('pir_title')=="I like this!")
					{
						jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',clearer_inactive_color);
						addFilter_single(jQuery(this).find('.tr_wrapper img'));
					}
				});
				$instance.find('.read_more_blog').hover(
				function() 
				{
					jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',active_color);
					addFilter_single(jQuery(this).find('.tr_wrapper img'));
				},
				function()
				{
					jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',clearer_inactive_color);
					addFilter_single(jQuery(this).find('.tr_wrapper img'));
				});
				$instance.find(".post-like a").qtip(
				{	
					content:
					{
						text:function (api){ return jQuery(this).attr("pir_title");}  
					},
					position: 
					{
						my: 'left center', 
						at: 'center right',
						adjust: 
						{
							y:0,
							x:4
						}
					},
					style: 
					{
						classes: 'ui-tooltip-zuper' //'ui-tooltip-light ui-tooltip-rounded'
					}
				});
				$instance.find('.blog_fader_grid').hover(
				function() 
				{
					jQuery(this).stop().animate({'opacity':'0.30'}, 200 );
				},
				function()
				{
					jQuery(this).stop().animate({'opacity':0}, 2000 );
				
				});
				//INCREASE COUNTER
				delayed_counter++;
				jQuery("#pir_loader_wrapper").stop().fadeTo('slow', 0,function()
				{
					
				});
				if (jq_paged<=jq_max)
				{
					jQuery('#entries_navigation a').html(orig_text);
					jq_load=false;
				}
				else
				{
					jQuery('.next-posts').css({'display':'none'});
					jQuery('#no_more').html("No more posts to show");
					jQuery('#no_more').css({'display':'inline-block'});
				}
				checkAndLoad();
			});
			jq_paged++;
			//ADJUST LINK ACCORDING TO PERMALINK OPTION
				if (jQuery('#entries_navigation a').attr('href').substring(jQuery('#entries_navigation a').attr('href').length - 1, jQuery('#entries_navigation a').attr('href').length)=='/')
				{
					var new_nbr=2;
				}
				else
				{
					var new_nbr=1;
				}
				if (jq_paged>10)
					new_nbr=new_nbr+1;
			var new_url=jQuery('#entries_navigation a').attr('href').substring(0, jQuery('#entries_navigation a').attr('href').length - new_nbr)+jq_paged;
			jQuery('#entries_navigation a').attr('href',new_url);	
		}
		//MASONRY BLOG
		if (jQuery('#entries_navigation_mason a').length)
		{
			jq_load=true;
			jQuery("#pir_loader_wrapper").css({'visibility':'visible','opacity':'1'});
			if (jq_paged==-1)
			{
				jq_paged=parseInt(jQuery('#entries_navigation_mason a').parent().parent().attr('pir_curr'))+1;
			}
			var items_nr_before= jQuery('#blog_entries_masonr>div').length;
			var orig_text=jQuery('#entries_navigation_mason a').html();
			jq_max=jQuery('#entries_navigation_mason a').parent().parent().attr('pir_max');
			var link = jQuery('#entries_navigation_mason a').attr('href');
			if (home_link!="")
			{
				link = link.replace(home_link, home_link+home_slug+'/');
			}
			jQuery('li').removeClass('last_li');
			jQuery('#dump').append('<div id=more_content_'+jq_paged+'></div>');
			jQuery('#more_content_'+jq_paged+'').load(link+' #blog_entries_masonr > *',function()
			{
				//APPLY SPECIAL JQUERY METHODS TO ELEMENTS THAT WERE JUST LOADED
				var $newEls = jQuery('#more_content_'+delayed_counter+' > *');
				$newEls.imagesLoaded(function() 
				{
					$container_blog.append($newEls).isotope( 'appended', $newEls,function()
					{
						var ctr=1;
						jQuery('#blog_entries_masonr>div').each(function(index, element) {
							
							if (ctr>items_nr_before)
							{
								jQuery(this).css({opacity:0});
								jQuery(this).transition({
									opacity:1,
									duration:200,
									easing:'linear'
								});
								jQuery(this).find('.tr_wrapper img').each(function() {
								addFilter_single(jQuery(this));
							});
							}
							
						//SHOW TINTED IMAGES
						jQuery(this).find('img.filter-tint').css({'opacity':'1'});
						//APPLY ROLLOVERS
						jQuery(this).find(".post-like a").hover(function() 
						{
							jQuery(this).find('.count').css('color',active_color);
							jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour','#ff3030');
							addFilter_single(jQuery(this).find('.tr_wrapper img'));
						},
						function()
						{
							//RETURN TO PREVIOUS COLOR
							jQuery(this).find('.count').css('color','');
							if (jQuery(this).attr('pir_title')=="I like this!")
							{
								jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',clearer_inactive_color);
								addFilter_single(jQuery(this).find('.tr_wrapper img'));
							}
						});
						jQuery(this).find(".post-like a").qtip(
						{	
							content:
							{
								text:function (api){ return jQuery(this).attr("pir_title");}  
							},
							position: 
							{
								my: 'left center', 
								at: 'center right',
								adjust: 
								{
									y:0,
									x:4
								}
							},
							style: 
							{
								classes: 'ui-tooltip-zuper' //'ui-tooltip-light ui-tooltip-rounded'
							}
						});
						jQuery(this).find(".post-like a").click(function()
						{
							//CHECK IF WE ARE CLICKING ON THE BUTTON THAT "SHOULD" BE INACTIVE
							if (jQuery(this).hasClass('alreadyvoted'))
							{
								return false;
							}
							else
							{
								heart = jQuery(this);
								post_id = heart.data("post_id");
								jQuery.ajax(
								{
									type: "post",
									url: ajax_var.url,
									data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
									success: function(count)
									{
										if(count != "already")
										{
											heart.addClass("voted");
											heart.find(".count").text(''+count+'');
											heart.qtip("hide");
											heart.attr("pir_title","You already liked this");
										}
									}
								});
								return false;
							}
						});
						jQuery(this).find('.blog_fader_grid').hover(
						function() 
						{
							jQuery(this).stop().animate({'opacity':'0.30'}, 200 );
						},
						function()
						{
							jQuery(this).stop().animate({'opacity':0}, 2000 );
						
						});
						ctr++;
						});
					});//$container_blog.append
					rearrange_layout();
					jQuery('#more_content_'+delayed_counter+'').remove();
					//INCREASE COUNTER
					delayed_counter++;
					if (delayed_counter<=jq_max)
					{
						jQuery('#entries_navigation_mason a').html(orig_text);
						jq_load=false;
					}
					else
					{
						jQuery('.next-posts').css({'display':'none'});
						jQuery('#no_more').html("No more posts to show");
						jQuery('#no_more').css({'display':'inline-block'});
					}
					setTimeout(function(){ checkAndLoad();},1000);
				});//$newEls.imagesLoaded
				
				jQuery("#pir_loader_wrapper").stop().fadeTo('slow', 0,function()
				{
					
				});
					
				});
				//INCREASE COUNTER
				jq_paged++;
				//ADJUST LINK ACCORDING TO PERMALINK OPTION
				if (jQuery('#entries_navigation_mason a').attr('href').substring(jQuery('#entries_navigation_mason a').attr('href').length - 1, jQuery('#entries_navigation_mason a').attr('href').length)=='/')
				{
					var new_nbr=2;
				}
				else
				{
					var new_nbr=1;
				}
				if (jq_paged>10)
					new_nbr=new_nbr+1;
			var new_url=jQuery('#entries_navigation_mason a').attr('href').substring(0, jQuery('#entries_navigation_mason a').attr('href').length - new_nbr)+jq_paged;
			jQuery('#entries_navigation_mason a').attr('href',new_url);	
		}
	};
	function isScrolledIntoView(elem)
	{
		var docViewTop = jQuery(window).scrollTop();
		var docViewBottom = docViewTop + jQuery(window).height();
	
		var elemTop = jQuery(elem).offset().top;
		var elemBottom = elemTop + jQuery(elem).height();
	
		return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
	}
	function checkAndLoad()
	{
		if(isScrolledIntoView(jQuery('.push')) && jq_load==false)
		{
			load_more_ps();
		}
	}
	
	
	//SHORTCODES
	jQuery( ".prk_tabs" ).tabs();
	jQuery(".prk_tabs,.ui-tabs-nav").removeClass("ui-corner-all");
	var ac_icons = {
		header: "ui-icon-plusthick",
		activeHeader: "ui-icon-minusthick"
	};
	jQuery(".prk_accordion").accordion({
		collapsible: true,
		active: false,
		icons: ac_icons,
		autoHeight:false,
		change: function(event, ui) { 
			//MAKE SURE THE HOVER STATE IS GONE
			jQuery(".prk_accordion h3").each(function(){
		  		jQuery(this).blur();
			});
		 }
	});
	jQuery( 'button.prk_button, a.prk_button,input:submit.prk_button,ul.icons_father li').button();
	jQuery('.close_box').click(function()
	{
		jQuery(this).parent().fadeOut("slow");
	});
	
	jQuery(".toggle").each( function () {
		if(jQuery(this).attr('data-id') == 'closed') {
			jQuery(this).accordion({ header: 'h3', collapsible: true, active: false  });
		} else {
			jQuery(this).accordion({ header: 'h3', collapsible: true});
		}
	});
	 // check placeholder browser support
    if (!Modernizr.input.placeholder)
    {
        // set placeholder values
        jQuery('.ultra_wrapper').find('[placeholder]').each(function()
        {
           // if (jQuery(this).val() == '') // if field is empty
            //{
                jQuery(this).val( jQuery(this).attr('placeholder') );
            //}
        });
         
        // focus and blur of placeholders
        jQuery('[placeholder]').focus(function()
        {
            if (jQuery(this).val() == jQuery(this).attr('placeholder'))
            {
                jQuery(this).val('');
                jQuery(this).removeClass('placeholder');
            }
        }).blur(function()
        {
            if (jQuery(this).val() == '' || jQuery(this).val() == jQuery(this).attr('placeholder'))
            {
                jQuery(this).val(jQuery(this).attr('placeholder'));
                jQuery(this).addClass('placeholder');
            }
        });
         
        // remove placeholders on submit
        jQuery('[placeholder]').closest('form').submit(function()
        {
            jQuery(this).find('[placeholder]').each(function()
            {
                if (jQuery(this).val() == jQuery(this).attr('placeholder'))
                {
                    jQuery(this).val('');
                }
            })
        });
         
    }
	jQuery(".post-like a").qtip(
	{	
		content:
		{
			text:function (api){ return jQuery(this).attr("pir_title");}  
		},
		position: 
		{
        	my: 'left center', 
          	at: 'center right',
			adjust: 
			{
				y:0,
				x:4
		  	}
      	},
		style: 
		{
        	classes: 'ui-tooltip-zuper' //'ui-tooltip-light ui-tooltip-rounded'
      	}
	});
	jQuery(".post-like a").hover(function() 
	  {
		  jQuery(this).find('.count').css('color',active_color);
		  jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour','#ff3030');
		  addFilter_single(jQuery(this).find('.tr_wrapper img'));
	  },
	  function()
	  {
		  //RETURN TO PREVIOUS COLOR
		  jQuery(this).find('.count').css('color','');
		  if (jQuery(this).attr('pir_title')=="I like this!")
		  {
			  jQuery(this).find('.tr_wrapper img').attr('data-pb-tint-colour',clearer_inactive_color);
			  addFilter_single(jQuery(this).find('.tr_wrapper img'));
		  }
	  });
	  
	//SOCIAL WIDGET - ANIMATIONS
	jQuery('#pirenko_social a img.qtiped').qtip(
	{	
		content:
		{
			text:function (api){ return jQuery(this).attr('pir_title')} 
		}
		,
		position: 
		{
			my: 'bottom center', 
			at: 'top center',
			adjust: 
			{
				x:0,
				y: -4
			}
		},
		style: 
		{
			classes: 'ui-tooltip-zuper' //'ui-tooltip-light ui-tooltip-rounded',
			//color: 'yellow'
		}
	});

	function is_touch(){
		if((navigator.userAgent.match(/android 3/i)) ||
			(navigator.userAgent.match(/honeycomb/i)))
			return false;
		try{
			document.createEvent("TouchEvent");
			return true;
		}catch(e){
			return false;
		}
	}
	//SCROLL BOTTOM SIDEBAR AND LOCK AT A CERTAIN POINT
	var windw = this;
	jQuery.fn.followTo = function ( pos ) {
		var $this = this,
			$window = jQuery(windw);
		if ($window.scrollTop() < (pos-10)) {
				$this.css({
					position: 'absolute',
					bottom: -pos
				});
			} else {
				$this.css({
					position: 'fixed',
					bottom: 0
				});
			}
		$window.scroll(function(e){
			if ($window.scrollTop() < (pos-10)) {
				$this.css({
					position: 'absolute',
					bottom: -pos
				});
			} else {
				$this.css({
					position: 'fixed',
					bottom: 0
				});
			}
		});
	}; 
	//BACK AND FORWARD ARROWS ON PORTFOLIO SECTION
	jQuery(document).keydown(function(e){
    if (e.keyCode == 37) { 
       	if(jQuery('.prev_link_portfolio').length)
		{
		window.location.href = jQuery('.prev_link_portfolio').parent().attr('href');
		}
		   return false;
		}
	});
	jQuery(document).keydown(function(e){
		if (e.keyCode == 39) { 
		   if(jQuery('.next_link_portfolio').length)
			{
				window.location.href = jQuery('.next_link_portfolio').parent().attr('href');
			}
		   return false;
		}
	});
}