jQuery(document).ready(function($){
$('#menu-navigation').find('.sub-menu').parent().addClass('has-sub-menu');

$('#menu-navigation').find('.sub-menu').each(function(){
    $(this).children('li').each(function(index){
        if(index%2 ==0) $(this).addClass('odd');
        else $(this).addClass('even');
    });
});

if($.browser.msie && $.browser.version == 7  ) {
    var level = 0;
    $('#menu-navigation').find('li').hover(function(){

        if(level != 0){

        }
      //  $(this).children('.sub-menu').css('opacity','1') ;

        level ++;
    },function(){
        level --;
     //   $(this).children('.sub-menu').css('opacity','0') ;
    });

}

var menu_height=parseInt($('#navigation').outerHeight()) - 1;
$('#menu-navigation').children('li').children('.sub-menu').css('top',menu_height);

});