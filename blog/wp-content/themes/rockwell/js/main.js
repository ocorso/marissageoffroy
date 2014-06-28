

jQuery(document).ready(function($){



$.fn.disableSelection = function() {
    $(this).attr('unselectable', 'on')
           .css('-moz-user-select', 'none')
           .each(function() {
               this.onselectstart = function() { return false; };
            });
};
    $('#slider-wrapper').find('div').disableSelection();
    $('#slider-wrapper').find('a').disableSelection();
    $('#slider-wrapper').find('ul').disableSelection();
     $('#slider-wrapper').find('li').disableSelection();
  		//.prettyPhoto();
    $('#grid').css( 'height' , $('body').height() );


  
 // .big_image_wrapper, .small_image_wrapper, .fresh_recent_posts_image_wrapper, .gallery_image_wrapper
  $('a .small_image,a .big_image,a .gallery_image,a .fresh_recent_posts_image, .size-thumbnail, .size-medium, .size-large, .size-full, a img').hover(function(){
    $(this).stop().animate({
        'filter':'alpha(opacity=50)',
        '-moz-opacity':'0.5',
        '-khtml-opacity':'0.5',
        'opacity': '0.5'}, 200);
  },function(){
  $(this).stop().animate({
            'filter':'alpha(opacity=100)',
            '-moz-opacity':'1',
            '-khtml-opacity':'1',
            'opacity': '1'}, 200);
  });
/*******************************************************************************
 * CONTACT
 ******************************************************************************/
 
  $(".submit_contact").click(
     function()
     {
  //   alert('ddd');

        var $continue = true;
        if($("#cf_author").attr("value") == "")
        {
          $("#cf_author").stop().animate({marginLeft:20},75).animate({marginLeft:-20},75).animate({marginLeft:20},75).animate({marginLeft:0},75);
          $continue = false;
        }
        //else{ $("#author").removeClass("alert"); }

        var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;

        if($("#cf_email").attr("value") == "")
        {
          $("#cf_email").stop().animate({marginLeft:20},75).animate({marginLeft:-20},75).animate({marginLeft:20},75).animate({marginLeft:0},75);
          $continue = false;
        }
        else if (!filter.test($("#cf_email").attr("value"))) {
          $("#cf_email").stop().animate({marginLeft:20},75).animate({marginLeft:-20},75).animate({marginLeft:20},75).animate({marginLeft:0},75);
          $continue = false;

         }

      if($("#cf_contact").attr("value") == "")
        {
          $("#cf_contact").css('position','relative');
          $("#cf_contact").stop().animate({left:20},75).animate({left:-20},75).animate({left:20},75).animate({left:0},75);
          $continue = false;
        }

        if ($continue == false){return false;}

     });

       $("#fc_submit").click(
     function()
     {

        var $continue = true;
        if($("#fc_name").attr("value") == "")
        {
          $("#fc_name").stop().animate({marginLeft:20},75).animate({marginLeft:-20},75).animate({marginLeft:20},75).animate({marginLeft:0},75);
          $continue = false;
        }
        //else{ $("#author").removeClass("alert"); }

        var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;

        if($("#fc_email").attr("value") == "")
        {
          $("#fc_email").stop().animate({marginLeft:20},75).animate({marginLeft:-20},75).animate({marginLeft:20},75).animate({marginLeft:0},75);
          $continue = false;
        }
        else if (!filter.test($("#fc_email").attr("value"))) {
      $("#fc_email").stop().animate({marginLeft:20},75).animate({marginLeft:-20},75).animate({marginLeft:20},75).animate({marginLeft:0},75);
          $continue = false;

         }


        if($("#fc_text").attr("value") == "")
        {
          $("#fc_text").stop().animate({marginLeft:20},75).animate({marginLeft:-20},75).animate({marginLeft:20},75).animate({marginLeft:0},75);
          $continue = false;
        }


        if ($continue == false){return false;}
     }
     );

     
   $(".submit_comment").click(
     function()
     {

        var $continue = true;
        if($("#author").attr("value") == "" && $("#author").length > 0 )
        {
          $("#author").stop().animate({marginLeft:20},75).animate({marginLeft:-20},75).animate({marginLeft:20},75).animate({marginLeft:0},75);
          $continue = false;
        }
        //else{ $("#author").removeClass("alert"); }

        var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;

        if($("#email").attr("value") == "" && $("#email").length > 0)
        {
          $("#email").stop().animate({marginLeft:20},75).animate({marginLeft:-20},75).animate({marginLeft:20},75).animate({marginLeft:0},75);
          $continue = false;
        }
        else if (!filter.test($("#email").attr("value")) && $("#email").length > 0) { $("#email").stop().animate({marginLeft:20},75).animate({marginLeft:0},75).animate({marginLeft:20},75).animate({marginLeft:0},75); $continue = false; }


        if($("#comment").attr("value") == "")
        {
          $("#comment").stop().animate({marginLeft:20},75).animate({marginLeft:-20},75).animate({marginLeft:20},75).animate({marginLeft:0},75);
          $continue = false;
        }


        if ($continue == false){return false;}
     }
     );
/*******************************************************************************
 * SHORTCODES
 ******************************************************************************/

 $('.sc_tab').click(function() {
    $('.sc_tab').removeClass('sc_tab_active');
    $(this).addClass('sc_tab_active');
    var which = $(this).attr('title');
    $(this).parent().parent().find('.sc_tab_single_box').css('display','none');
    $(this).parent().parent().find('.sc_tab_single_box').eq(which).css('display','block');
  });
  
	jQuery(".toggle_body").hide();

	jQuery("h4.toggle").toggle(function(){
		jQuery(this).addClass("toggle_active");
		}, function () {
		jQuery(this).removeClass("toggle_active");
	});

	jQuery("h4.toggle").click(function(){
		jQuery(this).next(".toggle_body").slideToggle();

	});

});
