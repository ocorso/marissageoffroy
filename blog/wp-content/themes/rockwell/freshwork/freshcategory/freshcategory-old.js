jQuery(document).ready(function($){
  var actual_cat_id = -1;
       //alert('dickl');
       //$('.postbox').eq(2).css('display','none');

  // alert(category_data_holder[6].display_date);
/*   $.each(category_data_holder, function( ){
  //  alert (this.display_date);
   });
  */
    $('body').prepend('<div class="freshcategory_tooltip">If you click this "magical" button, all settings applied to this category will be copied to all it\'s subcategories.<br/><br/> Don\'t forget to click the "Save" button when you are done editing.</div>');

   $('.cat_apply').hover(function(){
   //freshcategory_tooltip

    $('.freshcategory_tooltip').css('top', $(this).offset().top -40);
    $('.freshcategory_tooltip').css('left', $(this).offset().left + 40);
    $('.freshcategory_tooltip').stop().css('opacity','0').css('display','block').animate({opacity:1},500);
   },function(){
     $('.freshcategory_tooltip').css('display','none');
   });

   $('#category-options-additional').find('input[type=checkbox]').click(function(){
        if(actual_cat_id == -1) return false;

        var attr_value =  $(this).attr('checked');
        if(attr_value == "") attr_value = "false"
        category_data_holder[actual_cat_id][$(this).attr('name')] =attr_value;
   });
   $('#category-options-additional').find('input').keyup(function(){
        if(actual_cat_id == -1) return false;

        var attr_value =  $(this).attr('value');
        if(attr_value == "") attr_value = "0";

        category_data_holder[actual_cat_id][$(this).attr('name')] =attr_value;
   });

   $('#single-options-additional').find('input').keyup(function(){
        if(actual_cat_id == -1) return false;

        var attr_value =  $(this).attr('value');
        if(attr_value == "") attr_value = "0";

        single_data_holder[actual_cat_id][$(this).attr('name')] =attr_value;
   });
    /*   $('#post-meta').find('#post_meta_ppp').keyup(function(){
        $('#cat-list li').find('.cat_name_active').parent().find('.single_ppp').attr('value',$(this).attr('value'));
    });    */
   $('#single-options-additional').find('input[type=checkbox]').click(function(){
        if(actual_cat_id == -1) return false;

        var attr_value =  $(this).attr('checked');
        if(attr_value == "") attr_value = "false"
        single_data_holder[actual_cat_id][$(this).attr('name')] =attr_value;
   });

    $('.button-primary').click(function(){
        var category_data = ($.toJSON(category_data_holder));
        $('#json_category').attr('value',category_data);
        var single_data = ($.toJSON(single_data_holder));
      //  alert(single_data);
        //return false
        $('#json_single').attr('value',single_data);
    });


   $('.cat_apply').click(function(){




                var id = $(this).parent().attr('rel');
        var depth = parseInt($(this).parent().attr('title'));

        var this_li = $(this).parent();

        var start_it = false;
        $('#cat-list').find('li').each(function(){
              //alert('d');


            if(start_it == true && parseInt($(this).attr('title')) > depth)
            {
                    var next_id = $(this).attr('rel');
                    var cat_data_holder = category_data_holder[this_li.attr('rel')];
                    var sing_data_holder = single_data_holder[this_li.attr('rel')];
                    $.each(cat_data_holder, function(key, value){
                        //alert( $(this).attr('rel') );
                        category_data_holder[next_id][key] = value;
                        //alert(key + value);
                    });
                    $.each(sing_data_holder, function(key, value){
                        single_data_holder[next_id][key] = value;
                      //  alert(key + value);
                    });

                    $(this).find('.cat_template').attr('value', this_li.find('.cat_template').attr('value') );
                    $(this).find('.cat_single_template').attr('value', this_li.find('.cat_single_template').attr('value') );
                    $(this).find('.single_author').attr('value', this_li.find('.single_author').attr('value') );
                    $(this).find('.single_date').attr('value', this_li.find('.single_date').attr('value') );
                    $(this).find('.single_category').attr('value', this_li.find('.single_category').attr('value') );
                    $(this).find('.single_tags').attr('value', this_li.find('.single_tags').attr('value') );
                    $(this).find('.single_comments').attr('value', this_li.find('.single_comments').attr('value') );

                    $(this).find('.single_title').attr('value', this_li.find('.single_title').attr('value') );
                    $(this).find('.single_lightbox').attr('value', this_li.find('.single_lightbox').attr('value') );
                    $(this).find('.single_ppp').attr('value', this_li.find('.single_ppp').attr('value') );

                    $(this).animate({paddingLeft:4},50).animate({paddingLeft:0},50).animate({paddingLeft:4},50).animate({paddingLeft:0},50).animate({paddingLeft:4},50).animate({paddingLeft:0},50).animate({paddingLeft:4},50).animate({paddingLeft:0},50);//.animate({opacity:1},500);


                    //this_li.css('display','none');
                //alert(this_li.find('.cat_template').attr('value'));
             //   $(this).css('opacity',0.5);
            }
            else start_it = false;

            if( $(this).attr('rel') == id ) start_it = true;
        });
   });
////////////////////////////////////////////////////////////////////////////////
// POST META
////////////////////////////////////////////////////////////////////////////////
    $('#post-meta').find('input').click(function(){
        var type = $(this).attr('rel');
        $('#cat-list li').find('.cat_name_active').parent().find('.single_'+type).attr('value',$(this).attr('checked'));
    });
    $('#post-meta').find('#post_meta_ppp').keyup(function(){
        $('#cat-list li').find('.cat_name_active').parent().find('.single_ppp').attr('value',$(this).attr('value'));
    });

////////////////////////////////////////////////////////////////////////////////
// CATEGORY
////////////////////////////////////////////////////////////////////////////////
   $('#category-options').find('input').click(function(){
          $('#cat-list li').find('.cat_name_active').parent().find('.cat_template').attr('value',$(this).attr('value'));
   });
   $('#nav-tab-blog').click(function(){
        $('#category-blog').css('display','block');
        $('#category-portfolio').css('display','none');
        $('#nav-tab-blog').addClass('nav-tab-active');
        $('#nav-tab-portfolio').removeClass('nav-tab-active');
        $('#category-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });
    $('#nav-tab-portfolio').click(function(){
        $('#category-portfolio').css('display','block');
        $('#category-blog').css('display','none');
        $('#nav-tab-portfolio').addClass('nav-tab-active');
        $('#nav-tab-blog').removeClass('nav-tab-active');
        $('#category-portfolio-left').css('display','none');
         $('#category-portfolio-right').css('display','none');
          $('#category-portfolio-no').css('display','block');
         $('#category-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });

   $('#blog-subnav-left').click(function(){
   //class="select_button nav-tab-active"
        $('#category-blog').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#category-blog').find('.templates_wrapper').css('display','none');
        $('#category-blog-left').css('display','block');
         $('#category-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });
    $('#blog-subnav-right').click(function(){
        $('#category-blog').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#category-blog').find('.templates_wrapper').css('display','none');
        $('#category-blog-right').css('display','block');
         $('#category-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });
    $('#blog-subnav-no').click(function(){
        $('#category-blog').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#category-blog').find('.templates_wrapper').css('display','none');
        $('#category-blog-no').css('display','block');
         $('#category-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });

    $('#portfolio-subnav-left').click(function(){
            $('#category-portfolio').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#category-portfolio').find('.templates_wrapper').css('display','none');
        $('#category-portfolio-left').css('display','block');
         $('#category-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });
    $('#portfolio-subnav-right').click(function(){
        $('#category-portfolio').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#category-portfolio').find('.templates_wrapper').css('display','none');
        $('#category-portfolio-right').css('display','block');
         $('#category-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });
    $('#portfolio-subnav-no').click(function(){
        $('#category-portfolio').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#category-portfolio').find('.templates_wrapper').css('display','none');
        $('#category-portfolio-no').css('display','block');
         $('#category-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });

////////////////////////////////////////////////////////////////////////////////
// SINGLE
////////////////////////////////////////////////////////////////////////////////
   $('#single-options').find('input').click(function(){
          $('#cat-list li').find('.cat_name_active').parent().find('.cat_single_template').attr('value',$(this).attr('value'));
   });

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

    $('#single-portfolio-subnav-left').click(function(){
            $('#single-portfolio').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#single-portfolio').find('.templates_wrapper').css('display','none');
        $('#single-portfolio-left').css('display','block');
        $('#single-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });
    $('#single-portfolio-subnav-right').click(function(){
        $('#single-portfolio').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#single-portfolio').find('.templates_wrapper').css('display','none');
        $('#single-portfolio-right').css('display','block');
        $('#single-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });
    $('#single-portfolio-subnav-no').click(function(){
        $('#single-portfolio').find('.select_button').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#single-portfolio').find('.templates_wrapper').css('display','none');
        $('#single-portfolio-no').css('display','block');
        $('#single-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });

   $('#nav-tab-single-blog').click(function(){
        $('#single-blog').css('display','block');
        $('#single-portfolio').css('display','none');
        $('#nav-tab-single-blog').addClass('nav-tab-active');
        $('#nav-tab-single-portfolio').removeClass('nav-tab-active');
        $('#single-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });
    $('#nav-tab-single-portfolio').click(function(){
        $('#single-portfolio').css('display','block');
        $('#single-blog').css('display','none');
        $('#nav-tab-single-portfolio').addClass('nav-tab-active');
        $('#nav-tab-single-blog').removeClass('nav-tab-active');
        $('#single-options').find('.templates_wrapper').animate({opacity:0.5}, 150).animate({opacity:1}, 150);
    });

    function reset_category()
    {
            $('#category-blog').css('display','block');
            $('#category-portfolio').css('display','none');

            $('#category-options').find('.select_button').removeClass('nav-tab-active');
            $('#category-options').find('#nav-tab-blog').addClass('nav-tab-active');
            $('#category-options').find('#blog-subnav-left').addClass('nav-tab-active');
            $('#category-options').find('#portfolio-subnav-left').addClass('nav-tab-active');
            $('#category-options').find('input').attr('checked',false);


            $('#category-blog').find('.templates_wrapper').css('display','none');
            $('#category-blog').find('#category-blog-left').css('display','block');


            $('#category-portfolio').find('.templates_wrapper').css('display','none');
            $('#category-portfolio').find('#portfolio-subnav-no').css('display','block');
    }

    function reset_single()
    {

            $('#single-blog').css('display','block');
            $('#single-portfolio').css('display','none');

            $('#single-options').find('.select_button').removeClass('nav-tab-active');
            $('#single-options').find('#nav-tab-single-blog').addClass('nav-tab-active');
            $('#single-options').find('#single-blog-subnav-left').addClass('nav-tab-active');
            $('#single-options').find('#single-portfolio-subnav-left').addClass('nav-tab-active');
            $('#single-options').find('input').attr('checked',false);


            $('#single-blog').find('.templates_wrapper').css('display','none');
            $('#single-blog').find('#single-blog-left').css('display','block');


            $('#single-portfolio').find('.templates_wrapper').css('display','none');
            $('#single-portfolio').find('#single-portfolio-left').css('display','block');
           //     alert('dick head');
    }


    $('#cat-list li').click(function(){


    //alert('d');
        $('#right-column').css('display','block');
      //  alert('s');
        $('#right-column').animate({opacity:0.5}, 150).animate({opacity:1},150);
        $('#cat-list li').find('.cat_name').removeClass('cat_name_active');
        $(this).find('.cat_name').addClass('cat_name_active');
        actual_cat_id = $(this).attr('rel');

        $('#category-options-additional').find('input').each(function(){
            var input_value = category_data_holder[actual_cat_id][$(this).attr('name')];
            if($(this).attr('type') == 'checkbox')
            {
                if(input_value == "false")
                    $(this).attr('checked', false);
                else
                    $(this).attr('checked', true);
            }
            else
                $(this).attr('value',input_value);
        });
        $('#single-options-additional').find('input').each(function(){
            var input_value = single_data_holder[actual_cat_id][$(this).attr('name')];
            if($(this).attr('type') == 'checkbox')
            {
                if(input_value == "false")
                    $(this).attr('checked', false);
                else
                    $(this).attr('checked', true);
            }
            else
                $(this).attr('value',input_value);
        });

            if( $(this).find('.cat_template').attr('value') != '')
            {

                var new_radio_cat = $('#category-options').find('input[value='+$(this).find('.cat_template').attr('value')+']');
                //alert('d' + $(this).find('.cat_template').attr('value'));
               // new_radio_cat.css('display','none');
                new_radio_cat.attr('checked',true);
                $('#category-blog').css('display','none');
                $('#category-portfolio').css('display','none');
                new_radio_cat.parent().parent().parent().parent().parent().css('display','block');
                new_radio_cat.parent().parent().parent().parent().parent().find('.templates_wrapper').css('display','none');
                new_radio_cat.parent().parent().parent().parent().css('display','block');
                var subnav = new_radio_cat.parent().parent().parent().parent().attr('rel');

                $('#category-options').find('.select_button').removeClass('nav-tab-active');
                $('#category-options').find('#'+subnav).addClass('nav-tab-active');
                if($('#category-blog').css('display') == 'none')
                {
                    $('#category-portfolio').css('display','block');
                    $('#category-blog').css('display','none');
                    $('#nav-tab-portfolio').addClass('nav-tab-active');
                    $('#nav-tab-blog').removeClass('nav-tab-active');
                }
                else
                {
                    $('#category-blog').css('display','block');
                    $('#category-portfolio').css('display','none');
                    $('#nav-tab-blog').addClass('nav-tab-active');
                    $('#nav-tab-portfolio').removeClass('nav-tab-active');
                }
            }
            else
            {
             //alert('d');
             reset_category();
            }
            //single
             if( $(this).find('.cat_single_template').attr('value') != '')
            {
                var new_radio_single = $('#single-options').find('input[value='+$(this).find('.cat_single_template').attr('value')+']');
                new_radio_single.attr('checked',true);
                $('#single-blog').css('display','none');
                $('#single-portfolio').css('display','none');
                new_radio_single.parent().parent().parent().parent().parent().css('display','block');
                new_radio_single.parent().parent().parent().parent().parent().find('.templates_wrapper').css('display','none');
                new_radio_single.parent().parent().parent().parent().css('display','block');

                var single_subnav_tab = new_radio_single.parent().parent().parent().parent().attr('rel');
                  $('#single-options').find('.select_button').removeClass('nav-tab-active');
                $('#single-options').find('#'+single_subnav_tab).addClass('nav-tab-active');

                if($('#single-blog').css('display') == 'none')
                {
                    $('#single-portfolio').css('display','block');
                    $('#single-blog').css('display','none');
                    $('#nav-tab-single-portfolio').addClass('nav-tab-active');
                    $('#nav-tab-single-blog').removeClass('nav-tab-active');
                }
                else
                {
                    $('#single-blog').css('display','block');
                    $('#single-portfolio').css('display','none');
                    $('#nav-tab-single-blog').addClass('nav-tab-active');
                    $('#nav-tab-single-portfolio').removeClass('nav-tab-active');
                }
            }
            else
            {
                reset_single();
            }

        $('#post-meta').find('input').attr('checked',false);
        if( $(this).find('.single_author').attr('value') == 'true' )  $('#post_meta_author').attr('checked', 'true');
        if( $(this).find('.single_date').attr('value') == 'true' )  $('#post_meta_date').attr('checked', 'true');
        if( $(this).find('.single_category').attr('value') == 'true' )  $('#post_meta_category').attr('checked', 'true');
        if( $(this).find('.single_tags').attr('value') == 'true' )  $('#post_meta_tags').attr('checked', 'true');
        if( $(this).find('.single_comments').attr('value') == 'true' )  $('#post_meta_comments').attr('checked', 'true');

         if( $(this).find('.single_title').attr('value') == 'true' )  $('#post_meta_title').attr('checked', 'true');
          if( $(this).find('.single_lightbox').attr('value') == 'true' )  $('#post_meta_lightbox').attr('checked', 'true');
          $('#post_meta_ppp').attr('value', $(this).find('.single_ppp').attr('value'));
          // if( $(this).find('.single_ppp').attr('value') == 'true' )  $('#post_meta_ppp').attr('value', 'true');
    });

});


(function($){$.toJSON=function(o)
{if(typeof(JSON)=='object'&&JSON.stringify)
return JSON.stringify(o);var type=typeof(o);if(o===null)
return"null";if(type=="undefined")
return undefined;if(type=="number"||type=="boolean")
return o+"";if(type=="string")
return $.quoteString(o);if(type=='object')
{if(typeof o.toJSON=="function")
return $.toJSON(o.toJSON());if(o.constructor===Date)
{var month=o.getUTCMonth()+1;if(month<10)month='0'+month;var day=o.getUTCDate();if(day<10)day='0'+day;var year=o.getUTCFullYear();var hours=o.getUTCHours();if(hours<10)hours='0'+hours;var minutes=o.getUTCMinutes();if(minutes<10)minutes='0'+minutes;var seconds=o.getUTCSeconds();if(seconds<10)seconds='0'+seconds;var milli=o.getUTCMilliseconds();if(milli<100)milli='0'+milli;if(milli<10)milli='0'+milli;return'"'+year+'-'+month+'-'+day+'T'+
hours+':'+minutes+':'+seconds+'.'+milli+'Z"';}
if(o.constructor===Array)
{var ret=[];for(var i=0;i<o.length;i++)
ret.push($.toJSON(o[i])||"null");return"["+ret.join(",")+"]";}
var pairs=[];for(var k in o){var name;var type=typeof k;if(type=="number")
name='"'+k+'"';else if(type=="string")
name=$.quoteString(k);else
continue;if(typeof o[k]=="function")
continue;var val=$.toJSON(o[k]);pairs.push(name+":"+val);}
return"{"+pairs.join(", ")+"}";}};$.evalJSON=function(src)
{if(typeof(JSON)=='object'&&JSON.parse)
return JSON.parse(src);return eval("("+src+")");};$.secureEvalJSON=function(src)
{if(typeof(JSON)=='object'&&JSON.parse)
return JSON.parse(src);var filtered=src;filtered=filtered.replace(/\\["\\\/bfnrtu]/g,'@');filtered=filtered.replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']');filtered=filtered.replace(/(?:^|:|,)(?:\s*\[)+/g,'');if(/^[\],:{}\s]*$/.test(filtered))
return eval("("+src+")");else
throw new SyntaxError("Error parsing JSON, source is not valid.");};$.quoteString=function(string)
{if(string.match(_escapeable))
{return'"'+string.replace(_escapeable,function(a)
{var c=_meta[a];if(typeof c==='string')return c;c=a.charCodeAt();return'\\u00'+Math.floor(c/16).toString(16)+(c%16).toString(16);})+'"';}
return'"'+string+'"';};var _escapeable=/["\\\x00-\x1f\x7f-\x9f]/g;var _meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'};})(jQuery);