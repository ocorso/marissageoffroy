jQuery(document).ready(function($){
$('#menu-navigation').find('.sub-menu').parent().addClass('has-sub-menu');
$('#menu-navigation').children('li').children('a').children('span').addClass('top-menu-item');
$('#menu-navigation').find('.sub-menu').each(function(){
    $(this).children('li').each(function(index){
        if(index%2 ==0) $(this).addClass('odd');
        else $(this).addClass('even');
    });
});


var menu_height=parseInt($('#navigation').outerHeight()) - 1;
$('#menu-navigation').children('li').children('.sub-menu').css('top',menu_height);

});