jQuery(document).ready(function($){
var template = '';
var parent_template;
$('.select_template_radio').find('input').each(function (){
    if( $(this).attr('checked') == 'checked' )
    {
    template = $(this).attr('value');
    parent_template = $(this).parent().parent().parent().parent();
    }
});
//template = $('#single_template_input').val();
if(template ==''){

$('#single-options').css('display','none');

}
else {
    //alert('x' +template);
    $('#single-options').css('display','block');
    $('#single-blog').find('.select_button').removeClass('nav-tab-active');
    $('#'+parent_template.attr('rel')).addClass('nav-tab-active');
    $('#single-blog').find('.templates_wrapper').css('display','none');
    parent_template.css('display','block');
    $('#single-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
}
//parent_template.css('color','red');
//alert(parent_template.attr('rel'));
    $('.another_template_button').click(function(){$('#single-options').css('display','block'); $('#single-options').find('input[type=radio]').eq(0).attr('checked',true);});
    $('.another_template_cancel').click(function(){$('#single-options').css('display','none'); $('.select_template_radio').find('input').attr('checked',false); });

 $('#single-blog-subnav-left').click(function(){
   //class="select_button nav-tab-active"
        $('#single-blog').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#single-blog').find('.templates_wrapper').css('display','none');
        $('#single-blog-left').css('display','block');
        $('#single-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);

    });
    $('#single-blog-subnav-right').click(function(){
        $('#single-blog').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#single-blog').find('.templates_wrapper').css('display','none');
        $('#single-blog-right').css('display','block');
        $('#single-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });
    $('#single-blog-subnav-no').click(function(){
        $('#single-blog').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#single-blog').find('.templates_wrapper').css('display','none');
        $('#single-blog-no').css('display','block');
        $('#single-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });

});