//jQuery(document).ready(function(){ 
    //jQuery("ul.sf-menu").supersubs({ 
    //    minWidth:    12,                                // minimum width of sub-menus in em units 
    //    maxWidth:    27,                                // maximum width of sub-menus in em units 
    //    extraWidth:  1                                  // extra width can ensure lines don't sometimes turn over 
    //                                                    // due to slight rounding differences and font-family 
   // }).superfish({ 
    //    delay:       600,                              // delay on mouseout 
    //    animation:   {opacity:'show',height:'show'},    // fade-in and slide-down animation 
    //    speed:       'fast',                            // faster animation speed 
   //     autoArrows:  false,                             // disable generation of arrow mark-up 
    //    dropShadows: false                              // disable drop shadows 
   // }); 
//});


$(document).ready(function(){
 $("#menu > li").each(function(){
  var fa_menuli = $(this);
  var fa_childul = fa_menuli.children("ul");
  if(fa_childul.length){
   fa_childul.hide();
   fa_menuli.hover(function(){
    if(!fa_childul.hasClass("fahover")){
     $("#menu > li ul.fahover").removeClass("fahover").stop(1,1).slideUp("slow");
     fa_childul.addClass("fahover").stop(1,1).slideDown(300);
    }
   });
  }
 });
});