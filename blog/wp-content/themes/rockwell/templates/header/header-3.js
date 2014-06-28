jQuery(document).ready(function($){
$('#menu-navigation').find('.sub-menu').parent().addClass('has-sub-menu');

var submenu_height = 0;
var submenu_mini_height = 0;
var header_container_height = $('#header_container').outerHeight() + parseInt($('.menu_navigation_bg').css('border-bottom-width').replace("px", "")) + parseInt($('.menu_navigation_bg_wrapper').css('border-bottom-width').replace("px", "")) + parseInt($('.menu_navigation_bg_container').css('border-bottom-width').replace("px", ""));

var default_background = 'none';
$('#menu-navigation').children('li').children('ul.sub-menu').each(function() {
    if( submenu_height < $(this).outerHeight() ) {
        submenu_height = $(this).outerHeight();
        submenu_mini_height = $(this).outerHeight();
    }
});
submenu_height = submenu_height-1;
submenu_mini_height = submenu_height;
$('#menu-navigation').children('li').children('ul.sub-menu').each(function() {
        $(this).css('height', submenu_mini_height);

});
$('#header_wrapper').find('.menu_navigation_bg_container').css('height', submenu_height);
$('#header_wrapper').find('.menu_navigation_bg_wrapper').css('height', submenu_height);
$('#header_wrapper').find('.menu_navigation_bg').css('height', submenu_height);

    $('#menu-navigation').hover(function(){
        $('#header_wrapper').find('.menu_navigation_bg_container').css('display','block');
        $('#header_container').find('.sub-menu').css('display','block');
        $('#header_container').stop().animate({height: header_container_height + submenu_height}, 150);
         //alert('d');

    }, function(){
        $('#header_container').stop().animate({height: header_container_height - 1 }, 150,function(){$('#header_container').find('.sub-menu').css('display','none'); $('#header_wrapper').find('.menu_navigation_bg_container').css('display','none');} );

    });
});