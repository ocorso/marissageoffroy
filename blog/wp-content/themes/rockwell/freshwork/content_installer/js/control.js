
jQuery(document).ready(function($){
 $('.add_slide_down').click(function(){
  $('#action_what').attr('value','add_down'); 
 } );
 $('.add_slide_up').click(function(){
  $('#action_what').attr('value','add_up'); 
 } );

 $('.move_up').live('click',function(){
    var actual_id = parseInt($(this).attr('title'));
    if (actual_id == 0){return false;}
    var up_id = actual_id - 1;
    
    actual_content =  $('.table_id_'+actual_id).html();
    up_content =  $('.table_id_'+up_id).html();
    
         var actual_image_url = $('.table_id_'+actual_id).find('.image_url').attr('value');
     var actual_lightbox = $('.table_id_'+actual_id).find('.lightbox').attr('value');
     var actual_link_url = $('.table_id_'+actual_id).find('.link_url').attr('value');
     var actual_transition = $('.table_id_'+actual_id).find('.transition').attr('value');
     var actual_alt = $('.table_id_'+actual_id).find('.alt').attr('value');
     var actual_description = $('.table_id_'+actual_id).find('.description').attr('value');
     
     var up_image_url = $('.table_id_'+up_id).find('.image_url').attr('value');
     var up_lightbox = $('.table_id_'+up_id).find('.lightbox').attr('value');
     var up_link_url = $('.table_id_'+up_id).find('.link_url').attr('value');
     var up_transition = $('.table_id_'+up_id).find('.transition').attr('value');
     var up_alt = $('.table_id_'+up_id).find('.alt').attr('value');
     var up_description = $('.table_id_'+up_id).find('.description').attr('value');
     // alert(actual_content);
    $('.table_id_'+actual_id).html(up_content);
    $('.table_id_'+up_id).html(actual_content);

 //  alert(actual_id+1);
     $('.table_id_'+actual_id).find('.order_select').attr('value', actual_id);
     $('.table_id_'+up_id).find('.order_select').attr('value', up_id);
     
     $('.table_id_'+actual_id).find('.move_up').attr('title', actual_id);
     $('.table_id_'+actual_id).find('.move_down').attr('title', actual_id);
     
     $('.table_id_'+up_id).find('.move_up').attr('title', up_id);
     $('.table_id_'+up_id).find('.move_down').attr('title', up_id);   
     
         $('.table_id_'+up_id).find('.image_url').attr('value', actual_image_url); 
       $('.table_id_'+up_id).find('.lightbox').attr('value',actual_lightbox);
       $('.table_id_'+up_id).find('.link_url').attr('value',actual_link_url);
       $('.table_id_'+up_id).find('.transition').attr('value',actual_transition);
       $('.table_id_'+up_id).find('.alt').attr('value',actual_alt) 
       $('.table_id_'+up_id).find('.description').attr('value',actual_description);
             // alert('dsds');
       $('.table_id_'+actual_id).find('.image_url').attr('value',up_image_url); 
       $('.table_id_'+actual_id).find('.lightbox').attr('value',up_lightbox);
       $('.table_id_'+actual_id).find('.link_url').attr('value',up_link_url);
       $('.table_id_'+actual_id).find('.transition').attr('value',up_transition);
       $('.table_id_'+actual_id).find('.alt').attr('value',up_alt);
       $('.table_id_'+actual_id).find('.description').attr('value',up_description);  
    
    /*$('.move_up').bind('click',function(){
         var actual_id = parseInt($(this).attr('title'));
    var up_id = actual_id - 1;
    
    actual_content =  $('.table_id_'+actual_id).html();
    up_content =  $('.table_id_'+up_id).html();
     // alert(actual_content);
    $('.table_id_'+actual_id).html(up_content);
    $('.table_id_'+up_id).html(actual_content);
    

   // alert(actual_id);
 //  alert(actual_id+1);
     $('.table_id_'+actual_id).find('.order_select').attr('value', actual_id+1);
     $('.table_id_'+up_id).find('.order_select').attr('value', up_id+1);
     
     $('.table_id_'+actual_id).find('.move_up').attr('title', actual_id);
     $('.table_id_'+actual_id).find('.move_down').attr('title', actual_id);
     
     $('.table_id_'+up_id).find('.move_up').attr('title', up_id);
     $('.table_id_'+up_id).find('.move_down').attr('title', up_id);     
     } );                         */
    
 //   alert(actual_table_id);
 
 } );
 
  $('.move_down').live('click', function(){         
    var last_slide = $('#last_slide').attr('value');
     
    var actual_id = parseInt($(this).attr('title'));
    if(actual_id == last_slide) {return false;}
    var up_id = actual_id + 1;
    
    actual_content =  $('.table_id_'+actual_id).html();
    up_content =  $('.table_id_'+up_id).html();
     // alert(actual_content);
     var actual_image_url = $('.table_id_'+actual_id).find('.image_url').attr('value');
     var actual_lightbox = $('.table_id_'+actual_id).find('.lightbox').attr('value');
     var actual_link_url = $('.table_id_'+actual_id).find('.link_url').attr('value');
     var actual_transition = $('.table_id_'+actual_id).find('.transition').attr('value');
     var actual_alt = $('.table_id_'+actual_id).find('.alt').attr('value');
     var actual_description = $('.table_id_'+actual_id).find('.description').attr('value');
     
     var up_image_url = $('.table_id_'+up_id).find('.image_url').attr('value');
     var up_lightbox = $('.table_id_'+up_id).find('.lightbox').attr('value');
     var up_link_url = $('.table_id_'+up_id).find('.link_url').attr('value');
     var up_transition = $('.table_id_'+up_id).find('.transition').attr('value');
     var up_alt = $('.table_id_'+up_id).find('.alt').attr('value');
     var up_description = $('.table_id_'+up_id).find('.description').attr('value');
     
    $('.table_id_'+actual_id).html(up_content);
    $('.table_id_'+up_id).html(actual_content);
    

   // alert(actual_id);
 //  alert(actual_id+1);
     $('.table_id_'+actual_id).find('.order_select').attr('value', actual_id);
     $('.table_id_'+up_id).find('.order_select').attr('value', up_id);
     
     $('.table_id_'+actual_id).find('.move_up').attr('title', actual_id);
     $('.table_id_'+actual_id).find('.move_down').attr('title', actual_id);
     
     $('.table_id_'+up_id).find('.move_up').attr('title', up_id);
     $('.table_id_'+up_id).find('.move_down').attr('title', up_id);  
                  
       $('.table_id_'+up_id).find('.image_url').attr('value', actual_image_url); 
       $('.table_id_'+up_id).find('.lightbox').attr('value',actual_lightbox);
       $('.table_id_'+up_id).find('.link_url').attr('value',actual_link_url);
       $('.table_id_'+up_id).find('.transition').attr('value',actual_transition);
       $('.table_id_'+up_id).find('.alt').attr('value',actual_alt) 
       $('.table_id_'+up_id).find('.description').attr('value',actual_description);
             // alert('dsds');
       $('.table_id_'+actual_id).find('.image_url').attr('value',up_image_url); 
       $('.table_id_'+actual_id).find('.lightbox').attr('value',up_lightbox);
       $('.table_id_'+actual_id).find('.link_url').attr('value',up_link_url);
       $('.table_id_'+actual_id).find('.transition').attr('value',up_transition);
       $('.table_id_'+actual_id).find('.alt').attr('value',up_alt);
       $('.table_id_'+actual_id).find('.description').attr('value',up_description);

        
 } );
 

 
});