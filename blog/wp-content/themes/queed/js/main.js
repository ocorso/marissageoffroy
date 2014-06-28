/* 
	THIS PAGE CONTAINS THE MAIN SCRIPTS OF THE QUEED THEME
*/
function queed_init() 
{
	jQuery('.widget-3').each(function(index)
	{
		if (jQuery(this).hasClass('widget'))
			jQuery(this).after('<div class="cf"></div>');
	});
	//FADE IN MENU
	jQuery('ul.sf-menu').css({'opacity':'0'});
	jQuery('ul.sf-menu').delay(700).animate({opacity:1}, 200 );
	//ADD ACTIVE CLASS TO CHILDREN OF SINGLE PORFOLIO POSTS
	jQuery('#nav-main li a,#nav_footer li a').each(function(index) 
	{
    	if (jQuery(this).attr('href')==portfolio_link)
			jQuery(this).parent().addClass('active');
	});
	
	//ADD ACTIVE CLASS TO BLOG WHEN TAGS ARE SELECTED
	jQuery('#nav-main .left_nav .sf-menu>li:not(:first-child),#nav-main .right_nav .sf-menu>li:not(:first-child)').each(function(index) 
	{
		jQuery(this).prepend('<div class="pir_divider"></div>');
	});
	//ADD ACTIVE CLASS TO BLOG WHEN TAGS ARE SELECTED
	jQuery('#nav-main li a,#nav_footer li a').each(function(index) 
	{
    	if (jQuery(this).attr('href')==blog_link)
			jQuery(this).parent().addClass('active');
	});
	
	//MAKE THE COLLAPSED MENU OPEN SMOOTHLY FOR THE FIRST TIME IT OPENS
	if (jQuery(window).width()<980)
	{
		//jQuery("#nav-main").addClass('collapse');
	}
	
	//INITIALIZE MENU
	jQuery('.left_nav ul.sf-menu,.right_nav ul.sf-menu').supersubs({ 
            minWidth:    1,   // minimum width of sub-menus in em units 
            maxWidth:    20,   // maximum width of sub-menus in em units 
            extraWidth:  2     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish(
		{
			delay:400,
			animation: {height:'show'},
			autoArrows:    false, 
			speed:         'fast',
			dropShadows:   false,
		});
	//NUMBER 9 IS TO COMPENSATE THE PADDING ON THE MENU BUTTONS
	var my_int=parseInt(jQuery('.left_nav').width()-jQuery('.right_nav').width());
	jQuery('.left_nav').css({'margin-left':-my_int,'margin-right':parseInt(logo_w)+68});

	//ADD LAST CLASS TO TEAM MEMBERS IF NEEDED
	if (jQuery('.prk_member_ul').length)
	{
		var count=1;
		jQuery('.prk_member_ul>li').each(function(index, element) {
			if (count%3===0)
				jQuery(this).addClass('last');
            count++;
        });
	}
	
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
	jQuery('.pirenko_highlighted').focus(function () 
	{
		jQuery(this).css({'border': '1px solid '+active_color+'','outline': 'none','-webkit-box-shadow': '0px 0px 2px 0px '+active_color+'','box-shadow': '0px 0px 2px 0px '+active_color+''});
	});
	
	//FIX MENU BUTTONS STATE
	if (jQuery('.current-post-ancestor').length)
	{
		jQuery('.current-post-ancestor').parent().parent().addClass('active');
	}
	
	//FLEXISLIDER MANIPULATION
	var $js_flexislider = jQuery.noConflict();
	
	var p = jQuery('#height_helper');
	var offset = p.offset();
	jQuery(window).load(function() 
	{
		jQuery('.home_fader_grid,.blog_fader_grid').each(
		function() 
		{
			jQuery(this).css({'height':jQuery(this).parent().find('.custom-img').css('height')});	
		});
		var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
		var matches = patt.exec(body_color);
		if (custom_shadow!='0')
			jQuery('.boxed_shadow').css({'-webkit-box-shadow': '0px 0px 4px 0px rgba('+parseInt(matches[1], 16)+','+parseInt(matches[2], 16)+','+parseInt(matches[3], 16)+','+custom_shadow+')','box-shadow': '0px 0px 4px 0px rgba('+parseInt(matches[1], 16)+','+parseInt(matches[2], 16)+','+parseInt(matches[3], 16)+','+custom_shadow+')'});
			
		offset = p.offset();
		//HOMEPAGE PORTFOLIO CAROUSEL
		if ($js_flexislider('#carousel').length)
		{
			var $size_helper=1;
			if ($js_flexislider('#carousel li').size()<$size_helper)
				$size_helper=$js_flexislider('#carousel li').size();
			jQuery('#carousel').elastislide({
				imageW 	: 234,
				minItems	: $size_helper,
				margin      : 1,
			});
			
			//FORCE HIDDING ARROWS ON HOMEPAGE LATEST POSTS IF NEEDED
			if ($js_flexislider('#carousel li').size()<=4)
				jQuery('.es-nav').css({'display':'none'});
		}
		//RELATED PORTFOLIO POSTS CAROUSEL
		if ($js_flexislider('#carousel_single').length)
		{
			var $size_helper=3;
			if ($js_flexislider('#carousel_single li').size()<$size_helper)
				$size_helper=$js_flexislider('#carousel_single li').size();
			jQuery('#carousel_single').elastislide({
					imageW 	: 206,
					minItems	: $size_helper,
					margin      : 1,
				});
		}
		//HOMEPAGE MAIN SLIDER	
		if ($js_flexislider('#home_slider').length)
		{
			autoplay_homepage = autoplay_homepage === "true" ? true : false;
			$js_flexislider('#home_slider').flexslider(
			{
				slideshow : autoplay_homepage,
				slideshowSpeed : delay_homepage,
				smoothHeight: false,
				useCss:false,
				start:function (slider)
				{
					jQuery('#queed_slidetop_0').stop().animate({opacity:1}, 1000 );
					jQuery('#queed_slidebody_0').stop().animate({opacity:1}, 1000 );
				},
				before: function(slider)
				{
					my_string='#queed_slidetop_'+slider.currentSlide;
					my_body_string='#queed_slidebody_'+slider.currentSlide;
					jQuery(my_string).stop().animate({opacity:0}, 200 );
					jQuery(my_body_string).stop().animate({opacity:0}, 200 );
				},
				after: function(slider)
				{
					//alert (slider.currentSlide);
					my_string='#queed_slidetop_'+slider.currentSlide;
					my_body_string='#queed_slidebody_'+slider.currentSlide;
					jQuery(my_string).stop().animate({opacity:1}, 1000 );
					jQuery(my_body_string).stop().animate({opacity:1}, 1000 );
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
				controlNav: false,
				smoothHeight: true, 
				start:function (slider)
				{
	
				},
				before: function(slider)
				{
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
				controlNav: true,
				smoothHeight: true,
				start:function (slider)
				{
					jQuery('#'+jQuery(slider).find('ul').attr('id')+'top_0').stop().animate({opacity:1}, 1000 );
					jQuery('#'+jQuery(slider).find('ul').attr('id')+'body_0').stop().animate({opacity:1}, 1000 );
				},
				before: function(slider)
				{
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
					jQuery(my_string).stop().animate({opacity:1}, 1000 );
					jQuery(my_body_string).stop().animate({opacity:1}, 1000 );
				}
			});
		}
		if ($js_flexislider('#comments_slider').length)
		{
			$js_flexislider('#comments_slider').flexslider(
			{
				animation: "slide",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: true,                //Boolean: Animate slider automatically
				slideshowSpeed: 5000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 600, 
				slideshow: true,
				useCSS  :false,     
				smoothHeight: true,
				directionNav: false,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: false,
				start:function (slider)
				{
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
		//ROLLOVER BURN EFFECT
		jQuery('.flex-direction-nav li .flex-next,.flex-direction-nav li .flex-prev,.es-nav-next,.es-nav-prev,.next_link_portfolio,.prev_link_portfolio').hover(
		function() 
		{
			//alert (slider.count);
			jQuery(this).stop().animate({'backgroundColor': active_color,'opacity':1}, 10 );
		},
		function()
		{
			jQuery(this).stop().animate({'backgroundColor': background_color,'opacity':0.78}, 2000 );
		});
		//TOOLTIPS
		jQuery('.prev_link_portfolio').qtip(
		{	
			
			content:
			{
				text:function (api){ return jQuery('.prev_link_portfolio').parent().attr('pir_title');} 
			},
			position: 
			{
				my: 'bottom right', 
				at: 'center top',
				adjust: 
				{
					y:-13,
					x:-1
				}
			},
			style: 
			{
				classes: 'ui-tooltip-tipsy' //'ui-tooltip-light ui-tooltip-rounded'
			}
		});
		jQuery('.next_link_portfolio').qtip(
		{	
			
			content:
			{
				text:function (api){ return jQuery('.next_link_portfolio').parent().attr('pir_title');} 
			},
			position: 
			{
				my: 'bottom left', 
				at: 'center top',
				adjust: 
				{
					y:-13,
					x:-1
				}
			},
			style: 
			{
				classes: 'ui-tooltip-tipsy' //'ui-tooltip-light ui-tooltip-rounded'
			}
		});
	});
	
	//THUMBS ROLLOVER
	jQuery('.portfolio_entry_li').hover(
	function() 
	{
		if (use_lightbox=='both')
		{
			var light_space='36%';
			var link_space='52%'
		}
		if (use_lightbox=='light_only')
		{
			var light_space='43%';
			var link_space='110%';
		}
		if (use_lightbox=='link_only')
		{
			var light_space='-20%';
			var link_space='43%';
		}
		//ADJUST TITLE VERTICALLY IF NEEDED
		var dif=136+(parseInt(jQuery(this).find('.home_folio_title_grid').find('a').css('height')));
		jQuery(this).find('.lightbox_btn').stop();
		jQuery(this).find('.readmore_btn').stop();
		jQuery(this).find('.lightbox_btn').css({'top':240,'left':light_space,'opacity':1});
		jQuery(this).find('.readmore_btn').css({'top':240,'left':link_space,'opacity':1});
		jQuery(this).find('.lightbox_btn').delay(500).animate({'top':194}, 150 );
		jQuery(this).find('.readmore_btn').delay(500).animate({'top':194}, 150 );
		jQuery(this).find('h4').stop().transition({
			fontSize:'15px',
			'marginLeft':'0px',
			width:'214px',
			opacity:1,
			duration:300
		});
		jQuery(this).find('.special_italic').stop().transition({
			fontSize:'12px',
			'marginLeft':'0px',
			width:'234px',
			opacity:1,
			duration:300
		});
	},
	function()
	{
		jQuery(this).find('.lightbox_btn').stop().animate({'opacity':0}, 400 );
		jQuery(this).find('.readmore_btn').stop().animate({'opacity':0}, 400 );
		jQuery(this).find('h4').stop().transition({
			fontSize:'52px',
			'marginLeft':'-894px',
			width:'2000px',
			opacity:0,
			duration:200
		});
		jQuery(this).find('.special_italic').stop().transition({
			fontSize:'42px',
			'marginLeft':'-894px',
			width:'2000px',
			opacity:0,
			duration:200
		});

	});
	//THUMBS ROLLOVER - 2 CLOMUNS
	jQuery('.grid_image_wrapper_db').hover(
	function() 
	{
		if (use_lightbox=='both')
		{
			var light_space='43%';
			var link_space='53%'
		}
		if (use_lightbox=='light_only')
		{
			var light_space='43%';
			var link_space='110%';
		}
		if (use_lightbox=='link_only')
		{
			var light_space='-20%';
			var link_space='43%';
		}
		jQuery(this).find('.grid_colored_block_db').stop().animate({'opacity':0.86}, 300 );
		jQuery(this).find('.lightbox_btn').stop();
		jQuery(this).find('.readmore_btn').stop();
		jQuery(this).find('.lightbox_btn').css({'left':-30,'opacity':1});
		jQuery(this).find('.readmore_btn').css({'left':470,'opacity':1});
		jQuery(this).find('.lightbox_btn').animate({'left':light_space}, {easing:'easeOutExpo',duration:550} );
		jQuery(this).find('.readmore_btn').animate({'left':link_space}, {easing:'easeOutExpo',duration:400} );
	},
	function()
	{
		jQuery(this).find('.grid_colored_block_db').stop().animate({'opacity':0}, 500 );
		jQuery(this).find('.lightbox_btn').stop().animate({'opacity':0}, 400 );
		jQuery(this).find('.readmore_btn').stop().animate({'opacity':0}, 400 );
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
	
	//FUNCTION TO RESIZE BACKGROUND WHEN THE BROWSER WINDOW IS RESIZED
	function pirenko_resize()
	{
		//MANAGE TOP SIDEBAR HEIGHT
		offset = p.offset();
		if (open_mode==true)
		{
			jQuery('#top_widgets').css({'height': offset.top});
		}	
		if (jQuery('.navbar .btn-navbar').css('display')=='none')
		{
			collapsed_mode=true;
			//MAKE SURE WE ONLY CALL THIS SCRIPT ONCE
			if (jQuery('#nav-main').hasClass('collapse'))
			{	
				jQuery('#nav-main').removeClass('collapse');
				var my_int=parseInt(jQuery('.left_nav').width()-jQuery('.right_nav').width());
				jQuery(".sf-menu").css({'height':'0px'});
				jQuery(".sub-menu").css({'width':'auto'});
				collapsed_mode=true;
			}
		}
		else
		{
			jQuery('#nav-main').addClass('collapse');
		}
		var scale=0;
		var stageWidth=jQuery(window).width();
		var newWidth=jQuery("#full-screen-background-image").width();
		var stageHeight=jQuery(window).height();
		var newHeight=jQuery("#full-screen-background-image").height();
		var original_scale=jQuery("#full-screen-background-image").width()/jQuery("#full-screen-background-image").height();
		var dth=jQuery(window).width();
		if (dth<1024)//FOR IPAD
		{
			dth=1024;	
		}
		var ght=(1/original_scale)*dth;
		if (ght<jQuery(window).height())
		{
			ght=jQuery(window).height();
			dth=ght*original_scale;
		}
		//FOR IPAD AND SMALL WINDOWS
		if (jQuery(window).width()<1024)
		{
			jQuery("#full-screen-background-image").css({'width':dth,'height':ght,'left':'0px','top':-(ght-jQuery(window).height())/2});
			//jQuery('#left_area').css({'position':'absolute'});
			//jQuery('body').css({'overflow-x':'visible'});
		}
		else
		{
			jQuery("#full-screen-background-image").css({'width':dth,'height':ght,'left':-(dth-jQuery(window).width())/2,'top':-(ght-jQuery(window).height())/2});
			//jQuery('#left_area').css({'position':'fixed'});
			//jQuery('body').css({'overflow-x':'hidden'});
		}
	}
	
	//COLLAPSED MENU FUNCTIONS
	if (jQuery('.navbar .btn-navbar').css('display')=='none')
		var collapsed_mode=false;
	else
		var collapsed_mode=true;
	jQuery(".btn-navbar").click(function()
		{
			//alert (collapsed_mode);
			if (collapsed_mode==false)
			{
				collapsed_mode=true;
				jQuery(".sf-menu").animate({'height':'0px'});
			}
			else
			{
				collapsed_mode=false;
				jQuery(".sf-menu").css({'height':'auto','display':'none'});
				jQuery(".left_nav .sf-menu").slideDown('slow', function() {
					// Animation complete.
				  });
				  jQuery(".right_nav .sf-menu").delay(200).slideDown('slow', function() {
					// Animation complete.
				  });
			}
		});
	//RESIZELISTENER
	jQuery(window).resize(function() 
	{
		pirenko_resize();
	});
	pirenko_resize();
	//LOAD THE BACKGROUND IMAGE
	jQuery('<img/>').attr('src', bk_url).load(function() 
	{
		jQuery('#full-screen-background-image').attr('src', bk_url);
		pirenko_resize();
	});
	
	
	jQuery('.theme_button a').hover(
	function() 
	{
		jQuery(this).addClass('change');
		jQuery(this).css({'backgroundColor': active_color});
		
	},
	function()
	{
		jQuery(this).removeClass('change');
		jQuery(this).css({'backgroundColor': ''});
		jQuery(this).blur();
	});
	
	jQuery('.theme_button_inverted a').hover(
	function() 
	{
		jQuery(this).addClass('change');
		jQuery(this).css({'backgroundColor': background_color});
	},
	function()
	{
		jQuery(this).removeClass('change');
		jQuery(this).css({'backgroundColor': active_color});
		jQuery(this).blur();
	});
	jQuery('.lk_text').hover(
	function() 
	{
		jQuery(this).addClass('change');
		jQuery(this).find('.twitter_link').css({'backgroundColor': body_color});
		//jQuery(this).parent().css({'opacity': '0.78'});
	},
	function()
	{
		jQuery(this).removeClass('change');
		jQuery(this).find('.twitter_link').css({'backgroundColor': active_color});
		//jQuery(this).parent().css({'opacity': 1});
		jQuery(this).blur();
	});
	
	jQuery('.theme_tags a').hover(
	function() 
	{
		jQuery(this).parent().css({'backgroundColor': active_color});
		
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
	if (jQuery('.top_teaser').length)
	{
		jQuery('.top_teaser').hover(
		function() 
		{
			if (open_mode==false)
			{
				//jQuery('.top_teaser').animate({'top':'-42px'});
			}
			else
			{
				//jQuery('.top_teaser').animate({'top':'-47px'});
			}
		},
		function()
		{
			if (open_mode==false)
			{
				//jQuery('.top_teaser').animate({'top':'-47px'});
			}
			else
			{
				//jQuery('.top_teaser').animate({'top':'-42px'});
			}
		});
		jQuery('#down_arrow').click(function()
		{
			if (open_mode==false)
			{
				var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
				var matches = patt.exec(background_color);
				open_mode=true;
				jQuery('#top_sidebar').css({'-webkit-box-shadow': '0px 0px 3px 2px rgba('+parseInt(matches[1], 16)+','+parseInt(matches[2], 16)+','+parseInt(matches[3], 16)+','+custom_opacity_half+')','box-shadow': '0px 0px 3px 2px rgba('+parseInt(matches[1], 16)+','+parseInt(matches[2], 16)+','+parseInt(matches[3], 16)+','+custom_opacity_half+')'});
				jQuery('#top_widgets').css({height:'0'});
				jQuery('#top_widgets').stop().animate(
				{
					height: offset.top,
				}, 
				{
					easing:'easeOutBack',
					duration:1000
				});
				jQuery('#down_arrow').stop().animate(
				{
					opacity: 0,
				}, 
				{
					easing:'easeOutBack',
					duration:100,
					complete:function()
					{
						jQuery('#down_arrow').css({'display':'none'});
					}
				});
				jQuery('#up_arrow').stop();
				jQuery('#up_arrow').css({'display':'inline-block','opacity':1});
				//jQuery('#banner').css({'border-top':'1px dotted '+darker_inactive_color+''});
				jQuery('.top_teaser').css({});
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
				jQuery('#top_widgets').stop().animate(
				{
					height: '0'
				}, 
				{
					easing:'easeInBack',
					duration:1000,
					complete:function()
					{
						//jQuery('#top_widgets').css({display:'none'});
						jQuery('.mini_triangle').css({'border-bottom': '0px solid '+darker_inactive_color+'','border-top':'5px solid '+darker_inactive_color+''});
						//jQuery('#banner').css({'border-top':'0px solid '+clearer_inactive_color+''});
						jQuery('.top_teaser').css({});
						//jQuery('#trapezoid').css({'border-top': '50px solid '+active_color+''});
						jQuery('#top_sidebar').css({'-webkit-box-shadow': '0px 0px 0px 0px','box-shadow': '0px 0px 0px 0px'});
					}
				});
				jQuery('#down_arrow').stop();
				jQuery('#down_arrow').css({'display':'inline-block','opacity':0});
				jQuery('#down_arrow').delay(1100).animate(
				{
					opacity: 1,
				}, 
				{
					easing:'linear',
					duration:500,
					complete:function()
					{
						jQuery('#up_arrow').css({'display':'none'});
					}
				});
				//jQuery('#banner').css({'border-top':'1px dotted '+darker_inactive_color+''});
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
	
	jQuery('.folio_grid').hover(
	function() 
	{
		jQuery(this).find('h4').stop().transition({
			fontSize:'15px',
			'marginLeft':'0px',
			width:'214px',
			opacity:1,
			duration:300
		});
		jQuery(this).find('.special_italic').stop().transition({
			fontSize:'12px',
			'marginLeft':'0px',
			width:'234px',
			opacity:1,
			duration:300
		});
	},
	function()
	{
		jQuery(this).find('h4').stop().transition({
			fontSize:'52px',
			'marginLeft':'-894px',
			width:'2000px',
			opacity:0,
			duration:200
		});
		jQuery(this).find('.special_italic').stop().transition({
			fontSize:'42px',
			'marginLeft':'-894px',
			width:'2000px',
			opacity:0,
			duration:200
		});
	});
	jQuery('.home_fader_grid,.blog_fader_grid').hover(
	function() 
	{
		
		jQuery(this).css({'height':jQuery(this).parent().find('.custom-img').css('height')});
		jQuery(this).stop().animate({'opacity':'0.30'}, 200 );
	},
	function()
	{
		jQuery(this).stop().animate({'opacity':0}, 2000 );
	
	});
	
	//FORMS INPUT FOCUS ANIMATION
	jQuery('.pirenko_highlighted').blur(function() 
	{
		var s=hex2rgb(inactive_color);
		var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
		var matches = patt.exec(s);
 		jQuery(this).css({'border': '1px solid '+inactive_color+'','outline': 'none','-webkit-box-shadow': '0px 0px 0px 0px '+active_color+'','box-shadow': '0px 0px 0px 0px '+active_color+''});
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
	
	function portfolio_quicksand() 
	{
		
		var $filter;
		var $container;
		var $containerClone;
		var $filterLink;
		var $filteredItems
		
		// Set Our Filter
		$filter = jQuery('.filter li.active a').attr('class');
		
		// Set Our Filter Link
		$filterLink = jQuery('.filter li a');
		
		// Set Our Container
		$container = jQuery('ul.filterable-grid');
		
		// Clone Our Container
		$containerClone = $container.clone();
		
		// Apply our Quicksand to work on a click function
		// for each for the filter li link elements
		$filterLink.click(function(e) 
		{
			// Remove the active class
			jQuery('.filter li').removeClass('active');
			jQuery('.filter li').css({'background-color': ''});
			// Split each of the filter elements and override our filter
			$filter = jQuery(this).attr('class').split(' ');
			
			// Apply the 'active' class to the clicked link
			jQuery(this).parent().addClass('active');
			jQuery(this).parent().css({'background-color': active_color});
			// If 'all' is selected, display all elements
			// else output all items referenced to the data-type
			if ($filter == 'all') 
			{
				$filteredItems = $containerClone.find('li'); 
			}
			else {
				$filteredItems = $containerClone.find('li[data-type~=' + $filter + ']'); 
			}
			
			// Finally call the Quicksand function
			$container.quicksand($filteredItems, 
			{
				// The Duration for animation
				duration: 1250,
				// the easing effect when animation
				easing: 'easeInOutExpo',
				// height adjustment becomes dynamic
				adjustHeight: 'dynamic',
				useScaling 	: true
				
			}, function() 
			{
				//THUMBS ROLLOVER
				jQuery('.portfolio_entry_li').hover(
				function() 
				{
					if (use_lightbox=='both')
					{
						var light_space='36%';
						var link_space='52%'
					}
					if (use_lightbox=='light_only')
					{
						var light_space='43%';
						var link_space='110%';
					}
					if (use_lightbox=='link_only')
					{
						var light_space='-20%';
						var link_space='43%';
					}
					//ADJUST TITLE VERTICALLY IF NEEDED
					var dif=136+(parseInt(jQuery(this).find('.home_folio_title_grid').find('a').css('height')));
					jQuery(this).find('.lightbox_btn').stop();
					jQuery(this).find('.readmore_btn').stop();
					jQuery(this).find('.lightbox_btn').css({'top':240,'left':light_space,'opacity':1});
					jQuery(this).find('.readmore_btn').css({'top':240,'left':link_space,'opacity':1});
					jQuery(this).find('.lightbox_btn').delay(500).animate({'top':194}, 150 );
					jQuery(this).find('.readmore_btn').delay(500).animate({'top':194}, 150 );
					jQuery(this).find('h4').stop().transition({
						fontSize:'15px',
						'marginLeft':'0px',
						width:'214px',
						opacity:1,
						duration:300
					});
					jQuery(this).find('.special_italic').stop().transition({
						fontSize:'12px',
						'marginLeft':'0px',
						width:'234px',
						opacity:1,
						duration:300
					});
				},
				function()
				{
					jQuery(this).find('.lightbox_btn').stop().animate({'opacity':0}, 400 );
					jQuery(this).find('.readmore_btn').stop().animate({'opacity':0}, 400 );
					jQuery(this).find('h4').stop().transition({
						fontSize:'52px',
						'marginLeft':'-894px',
						width:'2000px',
						opacity:0,
						duration:200
					});
					jQuery(this).find('.special_italic').stop().transition({
						fontSize:'42px',
						'marginLeft':'-894px',
						width:'2000px',
						opacity:0,
						duration:200
					});		
				});
				//THUMBS ROLLOVER - 2 CLOMUNS
				jQuery('.grid_image_wrapper_db').hover(
				function() 
				{
					if (use_lightbox=='both')
					{
						var light_space='43%';
						var link_space='53%'
					}
					if (use_lightbox=='light_only')
					{
						var light_space='43%';
						var link_space='110%';
					}
					if (use_lightbox=='link_only')
					{
						var light_space='-20%';
						var link_space='43%';
					}
					jQuery(this).find('.grid_colored_block_db').stop().animate({'opacity':0.86}, 300 );
					jQuery(this).find('.lightbox_btn').stop();
					jQuery(this).find('.readmore_btn').stop();
					jQuery(this).find('.lightbox_btn').css({'left':-30,'opacity':1});
					jQuery(this).find('.readmore_btn').css({'left':470,'opacity':1});
					jQuery(this).find('.lightbox_btn').animate({'left':light_space}, {easing:'easeOutExpo',duration:550} );
					jQuery(this).find('.readmore_btn').animate({'left':link_space}, {easing:'easeOutExpo',duration:400} );
				},
				function()
				{
					jQuery(this).find('.grid_colored_block_db').stop().animate({'opacity':0}, 500 );
					jQuery(this).find('.lightbox_btn').stop().animate({'opacity':0}, 400 );
					jQuery(this).find('.readmore_btn').stop().animate({'opacity':0}, 400 );
				});
				//REENABLE LIGHTBOX
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
								social_tools: '<div class="pp_social"><a href="http://pinterest.com/pin/create/button/" class="pin-it-button" count-layout="horizontal" style="margin-right:5px;float:left;" target="_blank"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=25" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:25px;" allowTransparency="true"></iframe></div></div>' /* html or false to disable */,
								changepicturecallback: function()
					{
						jQuery('.pin-it-button').click(
						function(e) 
						{
							e.preventDefault();
							var pinit_link='';
							jQuery('.filterable-grid li').each(function() 
							{
								if(jQuery(this).children('.grid_image_wrapper').children('.lightbox_btn').attr('href')==jQuery('#fullResImage').attr('src'))
								{
									pinit_link=jQuery(this).children('.grid_image_wrapper').children('.readmore_btn').attr('href');
								}
						});
						if (pinit_link=='')
						{
							window.alert("You can't Pin this media!");
						}
						else
							window.open('http://pinterest.com/pin/create/button/?url='+pinit_link+'&media='+jQuery('#fullResImage').attr('src')+'');
					});
								}
					});
					
					var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
		var matches = patt.exec(body_color);
		if (custom_shadow!='0')
			jQuery('.boxed_shadow').css({'-webkit-box-shadow': '0px 0px 4px 0px rgba('+parseInt(matches[1], 16)+','+parseInt(matches[2], 16)+','+parseInt(matches[3], 16)+','+custom_shadow+')','box-shadow': '0px 0px 4px 0px rgba('+parseInt(matches[1], 16)+','+parseInt(matches[2], 16)+','+parseInt(matches[3], 16)+','+custom_shadow+')'});
				});
			});
	};
	if(jQuery().quicksand) 
	{
		portfolio_quicksand();	
	}
	
	
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
					social_tools: '<div class="pp_social"><a href="http://pinterest.com/pin/create/button/" class="pin-it-button" count-layout="horizontal" style="margin-right:5px;float:left;" target="_blank"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=25" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:25px;" allowTransparency="true"></iframe></div></div>' /* html or false to disable */,
					changepicturecallback: function()
					{
						jQuery('.pin-it-button').click(
						function(e) 
						{
							e.preventDefault();
							var pinit_link='';
							jQuery('.filterable-grid li').each(function() 
							{
								if(jQuery(this).children('.grid_image_wrapper').children('.lightbox_btn').attr('href')==jQuery('#fullResImage').attr('src'))
								{
									pinit_link=jQuery(this).children('.grid_image_wrapper').children('.readmore_btn').attr('href');
								}
						});
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
	
	//AJAX BLOG MORE POSTS
	var jq_paged=-1;
	var jq_max=0;
	jQuery('#entries_navigation a').live('click', function(e)
	{
		e.preventDefault();
		jQuery('#entries_navigation a').blur();
		jQuery("#pir_loader_wrapper").css({'visibility':'visible','opacity':'1'});
		if (jq_paged==-1)
		{
			jq_paged=parseInt(jQuery(this).parent().parent().attr('pir_curr'))+1;
	 
		}
		var orig_text=jQuery(this).html();
		jq_max=jQuery(this).parent().parent().attr('pir_max');
		//jQuery(this).paattr('href','2');
		var link = jQuery(this).attr('href');
		if (home_link!="")
		{
			link = link.replace(home_link, home_link+home_slug+'/');
		}
		jQuery('li').removeClass('last_li');
		jQuery('.blog_entries').append('<div id=more_content_'+jq_paged+'></div>');
		jQuery('#more_content_'+jq_paged+'').load(link+' .blog_entries',function()
		{
			jQuery('.blog_fader_grid').each(
			function() 
			{
				jQuery(this).css({'height':'200'});	
			});
			jQuery("#pir_loader_wrapper").stop().fadeTo('slow', 0,function()
			{
				
			});
			if (jq_paged<=jq_max)
			{
				jQuery('#entries_navigation a').html(orig_text);
			}
			else
			{
				jQuery('.next-posts').css({'display':'none'});
				jQuery('#no_more').html("No more posts to show");
				jQuery('#no_more').css({'display':'inline-block'});
			}
			jQuery('.blog_fader_grid').hover(
			function() 
			{
				jQuery(this).stop().animate({'opacity':'0.30'}, 200 );
			},
			function()
			{
				jQuery(this).stop().animate({'opacity':0}, 2000 );
			
			});
			var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
		var matches = patt.exec(body_color);
			if (custom_shadow!='0')
			jQuery('.boxed_shadow').css({'-webkit-box-shadow': '0px 0px 4px 0px rgba('+parseInt(matches[1], 16)+','+parseInt(matches[2], 16)+','+parseInt(matches[3], 16)+','+custom_shadow+')','box-shadow': '0px 0px 4px 0px rgba('+parseInt(matches[1], 16)+','+parseInt(matches[2], 16)+','+parseInt(matches[3], 16)+','+custom_shadow+')'});
			
		});
		jq_paged++;
		jQuery(this).html("Loading...");
		//ADJUST LINK ACCORDING TO PERMALINK OPTION
		if (jQuery(this).attr('href').substring(jQuery(this).attr('href').length - 1, jQuery(this).attr('href').length)=='/')
			var new_url=jQuery(this).attr('href').substring(0, jQuery(this).attr('href').length - 2)+jq_paged;
		else
			var new_url=jQuery(this).attr('href').substring(0, jQuery(this).attr('href').length - 1)+jq_paged;
		jQuery(this).attr('href',new_url);
	});
	
	//SHORTCODES
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
}