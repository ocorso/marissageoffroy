
jQuery(document).ready(function($){
   //     alert('d');

     var transitions_array = new Array(9)
   transitions_array[0] = 'animate_cool';
   transitions_array[1] = 'slot_machine_left_right';
   transitions_array[2] =  'slot_machine_down';
   transitions_array[3] =  'minimize';
   transitions_array[4] =  'dissapear';
   transitions_array[5] =  'dissapear_delay';
   transitions_array[6] =  'random_down';
   transitions_array[7] =  'random_move';
   transitions_array[8] =  'random_move_fade';
   transitions_array[9] =  'simple';
var last_trans_nubmer = 0;

   var w = 156;
   var h = 156;

   if(show_slider_title == 'false') {
    $('.info_line').css('display','none');
    $('.slider_nav').css('display','none');
   }
   if(show_slider2_grid == 'false') {
    w = 157;
    h = 157;
  //  alert('ss');
   }

   var cubes = $('.cube');
   var counter=0;
   var img_count = $('#slider-feed').find('.slider-img-count').html();


   var slider_autoslide_holder = null;
   if(slider_autoslide != 0)
        slider_autoslide_holder = setInterval(function(){ counter++; if(counter >= img_count) {counter = 0;} reset_grid();change_image(counter);},slider_autoslide);

   jQuery('.cube_button_right, .cube_right_arrow').click(function(){
        clearInterval(slider_autoslide_holder);
        if( $('#slider-2').find('div:animated').length == 0 )
        {

        counter++;
        if(counter >= img_count) counter = 0;
        reset_grid();
        change_image(counter);
        }
    });
    
    jQuery('.cube_button_left, .cube_left_arrow').click(function(){
        clearInterval(slider_autoslide_holder);
        if( $('#slider-2').find('div:animated').length == 0 )
        {

        counter--;
        if(counter < 0) counter = img_count - 1;
        reset_grid();
        change_image(counter);
        }
    });
    
    jQuery('.cube, .info_line').click(function(){

        var lightbox = $('#slider-feed').find('.slide').eq(counter).find('.lightbox').html();

        if(lightbox == 1){
          //  $('#menu-navigation').html($('#slider-feed').find('.slide').eq(counter).find('.slide_source').attr('src'));

            $.prettyPhoto.open( $('#slider-feed').find('.slide').eq(counter).find('.slide_source').attr('src'),'','');
            return false;
        }
        else {
        
            window.location = $('#slider-feed').find('.slide').eq(counter).find('.link_url').html();
        }

    })
    
    function reset_grid() {
        cubes.each(function(){
        //alert(($this).css('width'));
            if( !$(this).css('width') == '155px' )
                $(this).css({'width':w});
            if( !$(this).css('height') == '156px' )
                $(this).css({'height':h})

        /*    {
                $(this).css({'width':155, 'height':h});
            }
           else
                $(this).css({'width':w, 'height':h});     */
           // $('.info_line').css('height',h);
       //    $('.cube_button_right').css('height',h);
           // $('.cube_button_left').css('height',h);
            $(this).find('.inner_b').css({'display':'block', 'top':'0px', 'left':'0px', 'opacity': '1', 'width':w+'px', 'height':h+'px'});
            $(this).find('.inner_a').css({'display':'block', 'top':'0px', 'left':'0px', 'opacity': '1', 'width':w+'px', 'height':h+'px'});
            $(this).find('.inner_a').css('background-image', $(this).find('.inner_b').css('background-image'));
        });
    }
    $('.slider_nav').find('li').click(function(){
     clearInterval(slider_autoslide_holder);
                 if( $('#slider-2').find('div:animated').length == 0 )
        {


        reset_grid();
         counter=parseInt($(this).html());
        change_image(counter);
        }



    });
    function change_image(src_id) {
    $('.slider_nav').find('li').removeClass('slider_nav_active');
    $('.slider_nav').find('li').eq(src_id).addClass('slider_nav_active');
    var transition_type = $('#slider-feed').find('.slide').eq(src_id).find('.transition').html();
    if(transition_type == 'random')
    {
        var trans_number = Math.floor(Math.random()*9) ;
        if(trans_number == last_trans_nubmer)
        {
            if(trans_number > 0) trans_number --;
            else trans_number ++;
        }
        transition_type = transitions_array[trans_number];
        last_trans_nubmer = trans_number
    }
       // alert(transition_type);
      var old_src =  $('#slider-content').find('.inner_a').css('background-image');
      var new_src = $('#slider-feed').find('.slide').eq(src_id).find('.slide_source').attr('src');
  //    var transition_type = $('#slider-feed').find('.slide').eq(src_id).find('.transition').html();
      var title =  $('#slider-feed').find('.slide').eq(src_id).find('.title').html();
      var link = $('#slider-feed').find('.slide').eq(src_id).find('.link_url').html();
      var desc = $('#slider-feed').find('.slide').eq(src_id).find('.s_description').html();
      //alert(title);

        $('.slider_nav').animate({opacity:0},0);
        $('.info_line').find('a').animate({opacity:0},0, function(){
        ////////////////////////////////////////////$('.info_line').find('a').css('font-size',47);


     //   $('.slider_description').html(desc);
            $(this).html(title).attr('href',link).animate({opacity:1, 
            //fontSize:47
            },0);
            $('.slider_nav').animate({opacity:1},0);
        })
      //alert(old_src);
    //  transition_random_move(new_src, old_src);
      
      var function_name = "transition_"+transition_type+"('"+new_src+"','"+old_src+"')";
     // alert(function_name);
      eval(function_name);
    }

    function transition_animate_cool(new_src, old_src) {
        var delay_counter = 0;
       cubes.each(function(){
        $(this).find('.inner_b').css('background-image', 'url('+new_src+')');
        $(this).find('.inner_a').delay(delay_counter).animate({opacity:0},300);
        delay_counter = delay_counter +25;
         //$(this).animate({opacity:0},2000);
          // $()
       });
    }
    
    function transition_slot_machine_up(new_src, old_src) {
       var delay_counter = 0;
       cubes.each(function(){
        $(this).find('.inner_b').css('background-image', 'url('+new_src+')').css('top', h).css('left',-w).css('opacity', 0);
        $(this).find('.inner_b').delay(delay_counter).animate({top:0,left:0, opacity:1},300,'easeInOutCirc');
        $(this).find('.inner_a').delay(delay_counter).animate({top:-h,left:w, opacity:0},300,'easeInOutCirc');
        delay_counter = delay_counter +35;
         //$(this).animate({opacity:0},2000);
          // $()
       });
    }
    function transition_slot_machine_left_right(new_src, old_src) {
       var delay_counter = 0;
       var wawe_counter = 0;
       cubes.each(function(){
        wawe_counter++;

        $(this).find('.inner_b').css('background-image', 'url('+new_src+')').css('top', h).css('left',-w).css('opacity', 0);
        $(this).find('.inner_b').delay(delay_counter).animate({top:0,left:0, opacity:1},300,'easeInOutCirc');
        $(this).find('.inner_a').delay(delay_counter).animate({top:-h,left:w, opacity:0},300,'easeInOutCirc');
        delay_counter = delay_counter +35;
        if(wawe_counter == 6) {wawe_counter = 0; delay_counter = 0;}
         //$(this).animate({opacity:0},2000);
          // $()
       });
    }
    function transition_slot_machine_down(new_src, old_src) {
       var delay_counter = 0;
       cubes.each(function(){
        $(this).find('.inner_b').css('background-image', 'url('+new_src+')').css('top', -h).css('opacity', 0);
        $(this).find('.inner_b').delay(delay_counter).animate({top:0, opacity:1},500,'easeInOutCirc');
        $(this).find('.inner_a').delay(delay_counter).animate({top: h, opacity:0},500,'easeInOutCirc');
        delay_counter = delay_counter +50;
         //$(this).animate({opacity:0},2000);
          // $()
       });
    }
    function transition_minimize(new_src, old_src) {
        var delay_counter = 0;
        cubes.find('.inner_b').css('display','none');
        cubes.find('.inner_b').css('background-image', 'url('+new_src+')');
        cubes.each(function(){
          //  $(this).find('.inner_b').css('background-image', 'url('+new_src+')').css('top', -156).css('opacity', 0);
           // $(this).find('.inner_b').delay(delay_counter).animate({top:0, opacity:1},500);
            $(this).find('.inner_a').delay(delay_counter).animate({top: h/4, left:w/4, width:w/2, height:h/2, opacity:0.5},200,'easeInBack', function(){
                $(this).css('background-image', 'url('+new_src+')').animate({top: 0, left:0, width:w, height:h, opacity:1},200, 'easeOutBack');

            }) ;

            delay_counter = delay_counter +30;
         //$(this).animate({opacity:0},2000);
          // $()
       });
    }

    function transition_simple(new_src, old_src) {
        var delay_counter = 0;
        cubes.find('.inner_b').css('display','block');
        cubes.find('.inner_b').css('background-image', 'url('+new_src+')');
        cubes.each(function(){
          //  $(this).find('.inner_b').css('background-image', 'url('+new_src+')').css('top', -156).css('opacity', 0);
           // $(this).find('.inner_b').delay(delay_counter).animate({top:0, opacity:1},500);
            $(this).find('.inner_a').animate({opacity:0},300 , function(){
                $(this).css('background-image', 'url('+new_src+')');//.animate({top: 0, left:0, width:w, height:h, opacity:1},200 );

            }) ;

           // delay_counter = delay_counter +30;
         //$(this).animate({opacity:0},2000);
          // $()
       });
    }
    
    function transition_move_up(new_src, old_src) {
        var delay_counter = 0;
       // cubes.find('.inner_b').css('display','none');
        cubes.find('.inner_b').css('background-image', 'url('+new_src+')');
        cubes.each(function(){
          //  $(this).find('.inner_b').css('background-image', 'url('+new_src+')').css('top', -156).css('opacity', 0);
           // $(this).find('.inner_b').delay(delay_counter).animate({top:0, opacity:1},500);
            $(this).find('.inner_a').delay(delay_counter).animate({ height:0, opacity:0.5},150, function(){
            //    $(this).css('background-image', 'url('+new_src+')').animate({top: 0, left:0, width:156, height:156, opacity:1},150);

            }) ;

            delay_counter = delay_counter +30;
         //$(this).animate({opacity:0},2000);
          // $()
       });
    }
    function transition_dissapear(new_src,old_src)
    {
        var delay_counter = 0;
    //    cubes.find('.inner_b').css('display','none');
        cubes.find('.inner_b').css('background-image', 'url('+new_src+')');
        cubes.each(function(){
          //  $(this).find('.inner_b').css('background-image', 'url('+new_src+')').css('top', -156).css('opacity', 0);
           // $(this).find('.inner_b').delay(delay_counter).animate({top:0, opacity:1},500);
            $(this).find('.inner_a').delay(delay_counter).animate({top: h/4, left:w/4, width:w/2, height:h/2, opacity:0},1000, 'easeOutExpo', function(){
     //           $(this).css('background-image', 'url('+new_src+')').animate({top: 0, left:0, width:156, height:156, opacity:1},150);

            }) ;

        //    delay_counter = delay_counter +30;
         //$(this).animate({opacity:0},2000);
          // $()
       });
    }
    
    function transition_dissapear_delay(new_src,old_src)
    {
        var delay_counter = 0;
    //    cubes.find('.inner_b').css('display','none');
        cubes.find('.inner_b').css('background-image', 'url('+new_src+')');
        cubes.each(function(){
          //  $(this).find('.inner_b').css('background-image', 'url('+new_src+')').css('top', -156).css('opacity', 0);
           // $(this).find('.inner_b').delay(delay_counter).animate({top:0, opacity:1},500);
            $(this).find('.inner_a').delay(delay_counter).animate({top: h/4, left:w/4, width:w/2, height:h/2, opacity:0},500, function(){
     //           $(this).css('background-image', 'url('+new_src+')').animate({top: 0, left:0, width:156, height:156, opacity:1},150);

            }) ;

            delay_counter = delay_counter +30;
         //$(this).animate({opacity:0},2000);
          // $()
       });
    }
    

    function transition_dissapear_up_delay(new_src,old_src)
    {
        var delay_counter = 0;
    //    cubes.find('.inner_b').css('display','none');
        cubes.find('.inner_b').css('background-image', 'url('+new_src+')');
        var key = 1;
        cubes.each(function(){
            if(key == 7){
           delay_counter = delay_counter +150;
           key = 1;
           }
          //  $(this).find('.inner_b').css('background-image', 'url('+new_src+')').css('top', -156).css('opacity', 0);
           // $(this).find('.inner_b').delay(delay_counter).animate({top:0, opacity:1},500);
            $(this).find('.inner_a').delay(delay_counter).animate({top: h/4, left:w/4, width:w/2, height:h/2, opacity:0},500, function(){
     //           $(this).css('background-image', 'url('+new_src+')').animate({top: 0, left:0, width:156, height:156, opacity:1},150);

            }) ;

          key++;
         //$(this).animate({opacity:0},2000);
          // $()
       });
    }
    
    function transition_snake_right(new_src,old_src)
    {
        var delay_counter = 0;
        cubes.find('.inner_b').css('background-image', 'url('+new_src+')');
        cubes.each(function(){
            $(this).find('.inner_a').delay(delay_counter).animate({left:w, opacity:0}, 100);
            delay_counter = delay_counter +50;
        });
    }
    
    function transition_random_down(new_src, old_src)
    {
        cubes.find('.inner_b').css('background-image', 'url('+new_src+')');
        cubes.each(function(){

         //   $(this).find('.inner_a').delay(Math.random()*500).animate({top:w, opacity:0}, 250);
              var delay = Math.random()*500;
              $(this).find('.inner_b').css('top', -h);
               $(this).find('.inner_a').delay(delay).animate({top:h+10}, 250);
               $(this).find('.inner_b').delay(delay).animate({top:0}, 250);
        });
    }
    
    function transition_random_move(new_src, old_src)
    {
        cubes.find('.inner_b').css('background-image', 'url('+new_src+')');
        cubes.each(function(){
        
            var direction_up = Math.random();
            var direction_left = Math.random();
            if(direction_up < 0.333 ) direction_up = -1;
            else if(direction_up < 0.666) direction_up = 0;
            else direction_up = 1
            
            if(direction_left < 0.333 ) direction_left = -1;
            else if(direction_left < 0.666) direction_left = 0;
            else direction_left = 1
            
            if(direction_up == 0 && direction_left == 0)direction_up = 1;
            var delayaa =Math.random()*250;
            $(this).find('.inner_b').css('top', -1*direction_up*h).css('left', -1*direction_left*w).delay(delayaa).animate({top:0,left:0}, 250);
            $(this).find('.inner_a').delay(delayaa).animate({top:(h+5)*direction_up ,left:(w+5)*direction_left }, 250);

        });
    }
    
    function transition_random_move_fade(new_src, old_src)
    {
        cubes.find('.inner_b').css('background-image', 'url('+new_src+')');
        cubes.each(function(){

            var direction_up = Math.random();
            var direction_left = Math.random();
            if(direction_up < 0.333 ) direction_up = -1;
            else if(direction_up < 0.666) direction_up = 0;
            else direction_up = 1

            if(direction_left < 0.333 ) direction_left = -1;
            else if(direction_left < 0.666) direction_left = 0;
            else direction_left = 1
            $(this).find('.inner_a').delay(Math.random()*250).animate({top:h*direction_up,left:w*direction_left, opacity:0}, 250);

        });
    }
    
});