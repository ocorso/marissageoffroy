
jQuery(document).ready(function() {
var switch_speed = 200;
var page_change_speed = 200;
var navigation_hover_speed = 200;
var fading = false;

//////////////////////////////////////////////////////////////////////////////
// NAVIGATION functions
//////////////////////////////////////////////////////////////////////////////    
jQuery(".wrapper_nav li").hover(function(){
  if(jQuery(this).attr("name") != "selected" )
  {
    jQuery(this).find(".active").stop().fadeTo(0,0);
    jQuery(this).find(".active").css("display", "block");
    jQuery(this).find(".active").fadeTo(navigation_hover_speed,1);
  }
},function(){
  if(jQuery(this).attr("name") != "selected" )
  {   
    jQuery(this).find(".active").stop().fadeTo(navigation_hover_speed,0, function() {    jQuery(this).find(".active").css("display", "none");} );

  }
});

jQuery(".wrapper_nav li").click(function(){
	
  jQuery(".wrapper_nav li").attr("name", "");
  jQuery(this).attr("name", "selected");
  jQuery(".wrapper_nav li").find(".active").css("display", "none");
  jQuery(this).find(".active").css("display", "block");
  //jQuery(".wrapper_nav li[name!=selected]").find(".active").css("display", "none");
  
  var new_box_name = "#" + jQuery(this).find(".passive").attr("name") + "_box";
  var new_tab_name = "#" + jQuery(this).find(".passive").attr("name") + "_tab";  
  if(fading == true)
  {
       jQuery(new_box_name).css("display", "block");
     jQuery(".box[name=selected]").fadeTo(0,0, function() { 
          jQuery(".box[name=selected]").css("display", "none"); 
                jQuery(".box").attr("name", "");
      jQuery(new_box_name).attr("name", "selected");
     });

      jQuery(new_box_name).stop().fadeTo(0,1);

  }
  else
  {
    jQuery(".box[name=selected]").css("display", "none");
    jQuery(".box").attr("name", "");
    jQuery(new_box_name).attr("name", "selected");
    jQuery(new_box_name).css("display", "block");

     
  }
  
  jQuery(".tabs_wrapper").css("display", "none");
  jQuery(new_tab_name).css("display", "block");
  jQuery(".content_wrapper[name=selected]").css("display", "block"); 
});

//////////////////////////////////////////////////////////////////////////////
// TAB functions
//////////////////////////////////////////////////////////////////////////////    
jQuery(".tabs_wrapper li").click(function() {
  if(jQuery(this).attr("name") !="selected")
  {
    var this_holder = this;
    var new_wrapper_name = "#" + jQuery(this).find("a").attr("name") + "_wrapper";
    jQuery(this).parent().find("a").removeClass("tab_active");
    jQuery(this).parent().find("a").addClass("tab_passive");
    jQuery(this).find("a").removeClass("tab_passive")
    jQuery(this).find("a").addClass("tab_active");
    
    if(fading == true)
    {       
      jQuery(".content_wrapper[name=selected]").fadeTo(200,0, function() {       
        jQuery(".content_wrapper[name=selected]").css("display", "none"); 
        jQuery(".content_wrapper").attr("name", "");
        jQuery(".tabs_wrapper li").attr("name","");      
        jQuery(this_holder).attr("name","selected");
        jQuery(new_wrapper_name).attr("name", "selected");
        jQuery(new_wrapper_name).css("display", "block");
        jQuery(new_wrapper_name).fadeTo(page_change_speed,1); 
      });
    }
    else
    {
      jQuery(".content_wrapper[name=selected]").css("display","none");
      jQuery(new_wrapper_name).parent().find(".content_wrapper").attr("name", "");
      jQuery(".tabs_wrapper li").attr("name","");      
      jQuery(this_holder).attr("name","selected");
      jQuery(new_wrapper_name).attr("name", "selected");
      jQuery(new_wrapper_name).css("display", "block");

    }  
  }
  return false;
});
jQuery('.btn_reset').click(function(){
  //  alert('dick');
    jQuery('#freshpanel_form').attr('action', '?page=functions.php&action=freshpanel_reset');
});
//////////////////////////////////////////////////////////////////////////////
// SWITCH BUTTON function
//////////////////////////////////////////////////////////////////////////////    
    
    jQuery(".btn_switch").click(function() {
      var new_value = jQuery(this).find(".btn_switch_input").attr("value");
      
      if(new_value == "true")
      {
        jQuery(this).find(".btn_switch_input").attr("value", "false");
        jQuery(this).find(".on_off").stop().animate({left: -53}, switch_speed);  
      }
      else
      {
        jQuery(this).find(".btn_switch_input").attr("value", "true");
        jQuery(this).find(".on_off").stop().animate({left: 0}, switch_speed);  
      }
    });

    jQuery(".info_small").mousemove(function(e){
      var tooltip_text = jQuery(this).parent().find(".desc").html();
      jQuery(".fresh_tooltip").css("display", "block");
      jQuery(".fresh_tooltip").find(".tooltip").html(tooltip_text);
      jQuery(".fresh_tooltip").css("top", e.pageY - 50);
      jQuery(".fresh_tooltip").css("left", e.pageX -260);
      jQuery(".fresh_tooltip").html(jQuery(this).parent().find(".desc").html());

    });
     jQuery(".info_small").mouseout(function(){
      jQuery(".fresh_tooltip").css("display", "none");
     });
     jQuery(window).resize(function() {
      var wp_content_height = jQuery("#wpcontent").css("height");
      jQuery("#freshpanel").css("height", wp_content_height);
    });
//////////////////////////////////////////////////////////////////////////////
// SELECTBOX function
//////////////////////////////////////////////////////////////////////////////    
  var slb_maxheight = 200;
  var scroll_click = 0;
  var last_clicked;
  jQuery(".selected").click(function()
  {
  
    jQuery(this).parent().attr("name", "clicked");
    var status = jQuery(this).parent().attr("rel");
    if(status=="open")
    {
      jQuery(this).parent().find(".select_options_wrapper").css("display","none");
      jQuery(this).parent().attr("rel","");
      jQuery(this).parent().attr("name", "");
    }
    else
    {
      last_clicked = this;
      jQuery(this).parent().find(".select_options_wrapper").css("display","block");
      jQuery(this).parent().attr("rel","open");
      jQuery(this).parent().find(".scrollbar").css("height",100);
      
      var slb_height = jQuery(this).parent().find(".select_options").height();

      if(slb_height > slb_maxheight) {
      
        jQuery(this).parent().find(".scrollbox").css("height",jQuery(this).parent().find(".select_options_container").height());
        var  divider =    jQuery(this).parent().find(".select_options_container").height() / jQuery(this).parent().find(".select_options").height();

  //    alert(jQuery(this).parent().find(".select_options").height() );
        jQuery(this).parent().find(".scrollbar").css("height", jQuery(this).parent().find(".select_options_container").height() * divider );
      }
      else
      {
        jQuery(this).parent().find(".scrollbox").css("display","none");
        jQuery(this).parent().find(".select_options").addClass("select_options_fullwidth");
        jQuery(this).parent().find(".scrollbar").css("display", "none"); 
        jQuery(this).parent().find(".select_options_container").css("height", jQuery(this).parent().find(".select_options").height());
        jQuery(this).parent().find(".scrollbox").css("height",jQuery(this).parent().find(".select_options_container").height());
      }

    }
  });
  
  jQuery(".scrollbox").mousedown(function() {
  last_clicked = jQuery(this).parent();
  });
  jQuery(".scrollbar_wrapper").mousedown(function(e)
  {   
  last_clicked  = jQuery(this).parent().parent().parent();
    jQuery(this).parent().parent().parent().attr("name", "clicked");
   
    jQuery(this).attr("rel","scrolling");  
    scroll_click = e.pageY -  jQuery(this).offset().top;
    

  });
  jQuery("body").mouseup(function()
  {

    jQuery(".scrollbar_wrapper").attr("rel","");
  });
  
  jQuery("body").mousemove(function(e){
    var difference =   (e.pageY - scroll_click);

    if(jQuery(".scrollbar_wrapper[rel=scrolling]").parent().offset() != null)
    {
    var end_offset = jQuery(".scrollbar_wrapper[rel=scrolling]").parent().offset().top + jQuery(".scrollbar_wrapper[rel=scrolling]").parent().height();

    var start_offset = jQuery(".scrollbar_wrapper[rel=scrolling]").parent().offset().top;

    if(difference + jQuery(".scrollbar_wrapper[rel=scrolling]").height() < end_offset && difference > start_offset)
    { 
      jQuery(".scrollbar_wrapper[rel=scrolling]").css("top", difference - jQuery(".scrollbar_wrapper[rel=scrolling]").parent().offset().top);
       
    }
    else if(difference + jQuery(".scrollbar_wrapper[rel=scrolling]").height() > end_offset)
    {
      jQuery(".scrollbar_wrapper[rel=scrolling]").css("top", jQuery(".scrollbar_wrapper[rel=scrolling]").parent().height() - jQuery(".scrollbar_wrapper[rel=scrolling]").height()) ;
  //    jQuery(".scrollbar_wrapper[rel=scrolling]").offset({ top: end_offset - jQuery(".scrollbar_wrapper[rel=scrolling]").height()}); 
    }
    else if(difference < start_offset)
    {
      jQuery(".scrollbar_wrapper[rel=scrolling]").css("top", 0);
    }
    var scale_height =  jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options_container").height();   
    var scale_difference = jQuery(".scrollbar_wrapper[rel=scrolling]").parent().offset().top - jQuery(".scrollbar_wrapper[rel=scrolling]").offset().top;
    var constant =  ((jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options").height() - scale_height) / (jQuery(".scrollbar_wrapper[rel=scrolling]").parent().height() - jQuery(".scrollbar_wrapper[rel=scrolling]").height() )); 
     
   if( constant * scale_difference * -1  <  jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options").height()  -scale_height)
   {
    jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options").css("top", constant * scale_difference);
   }
   else                                                                                                
   {
    jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options").css("top", -1*(jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options").height()  -scale_height));
   }
 }
 });


     
    jQuery("body").click(function(){
    jQuery(".select_options_wrapper").css("display","none");
    jQuery(".select_options_wrapper").parent().attr("rel","");
    
    jQuery(last_clicked).parent().find(".select_options_wrapper").css("display","block");
    jQuery(last_clicked).parent().attr("rel","open");

    last_clicked = null;
  });
  
  jQuery(".select_options li").click(function()
  {

    jQuery(this).parent().parent().parent().parent().find(".selected").html(jQuery(this).html());
    jQuery(this).parent().parent().parent().parent().find("input").attr("value", jQuery(this).html());
    

    jQuery(this).parent().parent().parent().parent().find(".select_options_wrapper").css("display","none");
    jQuery(this).parent().parent().parent().parent().attr("rel","");
  });
  
////////////////////////////////////////////////////
//
///////////////////////////////////////////////////
 jQuery(".selected").css({
      'MozUserSelect' : 'none'
    }).bind('selectstart', function() {
      return false;
    }).mousedown(function() {
      return false;
    });
  jQuery(".scrollbar_wrapper").css({
      'MozUserSelect' : 'none'
    }).bind('selectstart', function() {
      return false;
    }).mousedown(function() {
      return false;
    }); 
 jQuery("ul.select_options li").css({
      'MozUserSelect' : 'none'
    }).bind('selectstart', function() {
      return false;
    }).mousedown(function() {
      return false;
    });
    
    
////////////////////////////////////////////////////
// BROWSE MY THEMES fnction
///////////////////////////////////////////////////    
var slider_const = 0;

//alert(slider_count);
  jQuery(".btn_nav_right").click(function() {
  var slider_count = jQuery('ul.fresh_themes_slider').find('li').size();
    if(slider_const > (slider_count-1)*-100)
    {
      slider_const = slider_const - 100;
      jQuery('ul.fresh_themes_slider').stop()
      jQuery('ul.fresh_themes_slider').animate({left:slider_const},300);//.css("left", slider_const);
    }
 //alert("puca");
  } );
  
  jQuery(".btn_nav_left").click(function() {
    if(slider_const < 0)
    {slider_const = slider_const + 100;
          jQuery('ul.fresh_themes_slider').stop()
    jQuery('ul.fresh_themes_slider').animate({left:slider_const},300);//.css("left", slider_const);
    }    
        

 //alert("puca");
  } );
      jQuery(".fresh_themes_iframe").mousemove(function(e){
      alert('puic');
      });  
/*      jQuery("body").mousemove(function(e){
        alert("pica");
    //  jQuery("#sneak_peak").src = jQuery('.fresh_themes_iframe').contents().find('ul.fresh_themes_slider').find('li').eq(slider_const/100-1).find('img').attr('src');
      //      jQuery("#sneak_peak").css("top", e.pageY - 50);
      //jQuery("#sneak_peak").css("left", e.pageX -260);
    } );*/
    
    
    /*jQuery.get("http://freshface.cz/freshpanel/mythemes.php", function(data, text){
      jQuery('.fresh_themes_wrapper').html(data);
      jQuery('ul.fresh_themes_slider').css("width", (jQuery('ul.fresh_themes_slider').find('li').size()+1)*100);
    
    });  */
  jQuery('ul.fresh_themes_slider').css("width", (jQuery('ul.fresh_themes_slider').find('li').size()+1)*100);  
  jQuery('.fresh_themes_wrapper').hover(function(e){
  jQuery("#sneak_peak").css('display', 'block');
 var eqss = slider_const/100;
// if(eqss==0){eqss= 1 }
 eqss = eqss*-1;
 //alert(jQuery('ul.fresh_themes_slider').find('li').eq((eqss)).find('.peak').attr('src'));
   //    jQuery('ul.fresh_themes_slider').find('li').eq((eqss)).find('a').css("border", "1px solid red");
    //  jQuery('ul.fresh_themes_slider').find('li').eq((eqss)).css("border", "1px solid red");
     
      jQuery("#sneak_peak").attr("src", jQuery('ul.fresh_themes_slider').find('li').eq((eqss)).find('.peak').attr('src'));
//  jQuery("#sneak_peak").css("width", 100);
  //    jQuery("#sneak_peak").css("height", 100);      
      jQuery("#sneak_peak").css("top", e.pageY +20);
      jQuery("#sneak_peak").css("left", e.pageX -600);
  },function(){
    jQuery("#sneak_peak").css('display', 'none');
  } );
  
   jQuery('.fresh_themes_wrapper').mousemove(function(e){
            jQuery("#sneak_peak").css("top", e.pageY + 20);
      jQuery("#sneak_peak").css("left", e.pageX -600);  
   });
  
  
      jQuery(".tabs_wrapper li").css({
      'MozUserSelect' : 'none'
    }).bind('selectstart', function() {
      return false;
    }).mousedown(function() {
      return false;
    });
});

