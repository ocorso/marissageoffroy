
<?php
if( isset($_GET['livepanel_header_template'] ) )  $_SESSION['live_header_template'] = $_GET['livepanel_header_template'];
if( isset($_GET['live_google_fonts'] ) )  $_SESSION['live_google_fonts'] = $_GET['live_google_fonts'];
if( isset($_GET['live_google_fonts'] ) )  $_SESSION['live_google_fonts'] = $_GET['live_google_fonts'];

/*******************************************************************************
 *  SKIN CHANGER
 ******************************************************************************/
 //  5 - 12 nacte vsechny skiny z adresare
  $folder_handle = is_dir(TEMPLATEPATH.'/skins/');
  if($folder_handle) {
    $folder_handle= (scandir(TEMPLATEPATH.'/skins/'));
    $skins_scanned = array();
    foreach( $folder_handle as $value)
      if($value != '.' && $value != '..') array_push($skins_scanned, $value);
  }
  // vsechny skiny jsou nyni ulozeny ve $skins_scanned
  $default_skin = get_option('ff_template_skin');
  if( isset( $_COOKIE['skin_changer_default'] ) ) $default_skin = $_COOKIE['skin_changer_default'];
if( isset( $_COOKIE['stencil_fixed'] ) )  $_SESSION['stencil_fixed'] = $_COOKIE['stencil_fixed'] ;
  if( isset($_COOKIE['stencil_default'] ) )  $_SESSION['live_stencils'] = $_COOKIE['stencil_default'] ;
  // vsechny skiny preloadujeme, at se pri meneni nesekaji
/*.info_line, .message, .post_title, .comments_number, .comment_form_left h3, #cat_title h1, contact_form_left h2*/
  $google_font_family = array(    "DEFAULT",
                         "Cantarell",
						 "Cardo",
						 "Crimson Text",
						 "Droid Sans",
						 "Droid Sans Mono",
						 "Droid Serif",
						 "IM Fell DW Pica",
						 "Inconsolata",
						 "Josefin Sans Std Light",
						 "Josefin Slab",
						 "Lobster",
						 "Molengo",
						 "Nobile",
						 "OFL Sorts Mill Goudy TT",
						 "Old Standard TT",
						 "Reenie Beanie",
						 "Tangerine",
						 "Vollkorn",
						 "Yanone Kaffeesatz",
						 "Cuprum",
						 "Neucha",
						 "Neuton",
						 "PT Sans",
						 "Philosopher",
						 "Allerta",
						 "Allerta Stencil",
						 "Arimo",
						 "Arvo",
						 "Bentham",
						 "Coda",
						 "Cousine",
						 "Covered By Your Grace",
			 			 "Geo",
						 "Just Me Again Down Here",
						 "Puritan",
						 "Raleway",
						 "Tinos",
						 "UnifrakturCook",
						 "UnifrakturMaguntia",
						 "Mountains of Christmas",
						 "Lato",
						 "Orbitron",
						 "Allan",
						 "Anonymous Pro",
						 "Copse",
						 "Kenia",
						 "Ubuntu",
						 "Vibur",
						 "Sniglet",
						 "Syncopate",
						 "Cabin",
						 "Merriweather",
						 "Just Another Hand",
						 "Kristi",
						 "Corben",
						 "Gruppo",
						 "Buda",
						 "Lekton",
						 "Luckiest Guy",
						 "Crushed",
						 "Chewy",
						 "Coming Soon",
						 "Crafty Girls",
						 "Fontdiner Swanky",
						 "Permanent Marker",
						 "Rock Salt",
						 "Sunshiney",
						 "Unkempt",
						 "Calligraffitti",
						 "Cherry Cream Soda",
						 "Homemade Apple",
						 "Irish Growler",
						 "Kranky",
						 "Schoolbell",
						 "Slackey",
						 "Walter Turncoat",
						 "Radley",
						 "Meddon",
						 "Kreon",
						 "Dancing Script",
						 "Goudy Bookletter 1911",
						 "PT Serif Caption",
						 "PT Serif",
						 "Astloch"
);

?>
<div class="livepanel_wrapper<?php if($_COOKIE['close_preview'] != 'yes') echo ' livepanel_wrapper_active';?>">

<div class="style_holder">

<!-- STYLE -->
	<h7 class="live_header_first">Skin</h7>
    <select id="live_style_select">
    <?php
     $default_skin2 = array("black","grey","emo","party","army","white");
        echo '<option value="'.$default_skin.'" selected="selected">'.$default_skin.'</option>';
        foreach ($default_skin2 as $one_skin_name) {
            if($default_skin == $one_skin_name) continue;
            echo '<option value="'.$one_skin_name.'">'.$one_skin_name.'</option>';
        }
    ?>
    </select>
    <div id="live_style_left" class="live_button_left">&lt;</div>
    <div id="live_style_right" class="live_button_right">&gt;</div>
<!-- STYLE -->
<!-- STENCIL -->

<?php
    $stencils = array(
    "black" => array("turntable","skate","clothing","DEFAULT"),
    "summer" => array("surfer","DEFAULT"),
    "emo" =>  array("clothing","skulls","DEFAULT"),
    "grey"=>  array("grid","london","cross_s", "bolt","DEFAULT"),
    "white"=>  array("DEFAULT","turntable","skate","clothing",),
    "party" => array("disco","skate","turntable","clothing","DEFAULT"),
    "army" => array("camouflage","DEFAULT"),
    );
    echo '<script type="text/javascript">var js_stencils = '.json_encode($stencils).'</script>';
?>
	<div class="clear"></div>
    <h7>Stencil</h7>
    <select id="live_stencils_select">

<?php
    foreach($stencils[$default_skin] as $one_stencil)
    {
        $selected = "";
        if($one_stencil == $_SESSION['live_stencils'] ) $selected = 'selected="selected"';
        echo '<option value="'.$one_stencil.'">'.$one_stencil.'</option>';
    }
?>
    </select>
    <div id="live_stencil_left" class="live_button_left">&lt;</div>
    <div id="live_stencil_right" class="live_button_right">&gt;</div>

	<div class="clear"></div>



	<?php
	 if($_SESSION['stencil_fixed'] == "true")
	 $stencil_fixed_checked = "checked='checked'";
	?>
    <input type="checkbox" id="live_stencil_fixed" <?php echo $stencil_fixed_checked; ?> ><label for="live_stencil_fixed">Fixed Stencil Position</label>


	<div class="clear"></div>
    <h7>Menu</h7>
<!-- HEADER -->
    <select id="live_header_select">
        <?php
        for($i = 1; $i <= 3; $i++)
        {
           $selected = '';
            if(  $_SESSION['live_header_template'] == 'header-'.$i) $selected = "selected='selected'";
            else if(!isset($_SESSION['live_header_template']) && $i == 1 ) $selected = "selected='selected'";
          //  else if( !isset($_SESSION['live_header_template']) && $i==4) $selected = "selected";
            echo '<option '.$selected.' value="header-'.$i.'">menu-'.$i.'</option>';
        }
        ?>

    </select>
    <div id="live_header_left" class="live_button_left">&lt;</div>
    <div id="live_header_right" class="live_button_right">&gt;</div>
<!-- /HEADER -->

<!-- SLIDER -->
<?php if(true){?>
	<div class="clear"></div>
    <h7>Slider</h7>
    <select id="live_slider_select">
        <?php
        for($i = 1; $i <= 3; $i++)
        {
           $selected = '';
            if(  $_SESSION['live_slider_type'] == 'slider-'.$i) $selected = "selected='selected'";
            else if(!isset($_SESSION['live_slider_type']) && $i == 1 ) $selected = "selected='selected'";
          //  else if( !isset($_SESSION['live_header_template']) && $i==4) $selected = "selected";
            echo '<option '.$selected.' value="slider-'.$i.'">slider-'.$i.'</option>';
        }
        ?>

    </select>
    <div id="live_slider_left" class="live_button_left">&lt;</div>
    <div id="live_slider_right" class="live_button_right">&gt;</div>
    
  	<div class="clear"></div>

    <?php

    $checked = "";
    if( !isset( $_SESSION['live_slider_grid'] ) || $_SESSION['live_slider_grid'] == 'true') $checked = 'checked="checked"';
    echo '<input type="checkbox" '.$checked.' id="live_slider_grid" /><label for="live_slider_grid">Slider Grid</label>';
    
    $checked = "";
    if( !isset( $_SESSION['live_slider_title'] )||$_SESSION['live_slider_title'] == 'true') $checked = 'checked="checked"';
    echo '<input type="checkbox" '.$checked.' id="live_slider_title" /><label for="live_slider_title">Slider HUD</label>';
    }?>
<!-- /SLIDER -->


	<div class="clear"></div>
    <h7>Portfolio Layouts</h7>
    <select id="live_portfolio_templates" class="live_template_changer" rel="portfolio">
        <option value=" "></option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-1/">portfolio-1</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-2/">portfolio-2</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-3/">portfolio-3</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-4/">portfolio-4</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-5/">portfolio-5</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-6/">portfolio-6</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-7/">portfolio-7</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-8/">portfolio-8</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-9/">portfolio-9</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-10/">portfolio-10</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-11/">portfolio-11</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-12/">portfolio-12</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-13/">portfolio-13</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/portfolio/portfolio-14/">portfolio-14</option>
    </select>
    <div class="template_left live_button_left" rel="portfolio">&lt;</div>
    <div class="template_right live_button_right" rel="portfolio">&gt;</div>



	<div class="clear"></div>
    <h7>Blog Layouts</h7>
    <select id="live_blog_templates" class="live_template_changer" rel="blog">
        <option value=" "></option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-1/">blog-cat-1</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-2/">blog-cat-2</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-3/">blog-cat-3</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-4/">blog-cat-4</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-5/">blog-cat-5</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-6/">blog-cat-6</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-7/">blog-cat-7</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-8/">blog-cat-8</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-9/">blog-cat-9</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-10/">blog-cat-10</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-11/">blog-cat-11</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-12/">blog-cat-12</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-13/">blog-cat-13</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-14/">blog-cat-14</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-15/">blog-cat-15</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-16/">blog-cat-16</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-17/">blog-cat-17</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-18/">blog-cat-18</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-19/">blog-cat-19</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-20/">blog-cat-20</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-21/">blog-cat-21</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-22/">blog-cat-22</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-23/">blog-cat-23</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-24/">blog-cat-24</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-25/">blog-cat-25</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-26/">blog-cat-26</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-27/">blog-cat-27</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-28/">blog-cat-28</option>
        <option value="http://demo.freshface.net/file/rw/wp/category/blog/blog-29/">blog-cat-29</option>
    </select>
    <div class="template_left live_button_left" rel="blog">&lt;</div>
    <div class="template_right live_button_right" rel="blog">&gt;</div>
  
	<div class="clear"></div>
    <h7>Single Post Layouts</h7>
    <select id="live_single_templates" class="live_template_changer" rel="single">
        <option value=" "></option>
        <option value="http://demo.freshface.net/file/rw/wp/bauhaus-in-da-house/">blog-single-1 HOT</option>
        <option value="http://demo.freshface.net/file/rw/wp/traveling-the-world/">blog-single-2 HOT</option>
        <option value="http://demo.freshface.net/file/rw/wp/faded-in-the-bloom/">blog-single-3 HOT</option>
        <option value="http://demo.freshface.net/file/rw/wp/reading-in-the-rain/">blog-single-4</option>
        <option value="http://demo.freshface.net/file/rw/wp/rockstar-publisher/">blog-single-5</option>
        <option value="http://demo.freshface.net/file/rw/wp/generation-of-rock/">blog-single-6</option>
        <option value="http://demo.freshface.net/file/rw/wp/sail-on-the-spirit-lake/">blog-single-7</option>
        <option value="http://demo.freshface.net/file/rw/wp/silver-brushe-spoon/">blog-single-8</option>
        <option value="http://demo.freshface.net/file/rw/wp/valley-of-darkness/">blog-single-9</option>
        <option value="http://demo.freshface.net/file/rw/wp/candy-land-shoppin/">blog-single-10 HOT</option>
        <option value="http://demo.freshface.net/file/rw/wp/let-the-elephants-fly/">blog-single-11</option>
        <option value="http://demo.freshface.net/file/rw/wp/seizure-of-magic-power/">blog-single-12</option>
        <option value="http://demo.freshface.net/file/rw/wp/son-of-a-preacher-man/">blog-single-13 HOT</option>
        <option value="http://demo.freshface.net/file/rw/wp/the-cinderella-ma/">blog-single-14 HOT</option>
        <option value="http://demo.freshface.net/file/rw/wp/next-gen-algorithms/">blog-single-15</option>
        <option value="http://demo.freshface.net/file/rw/wp/roses-have-no-scent/">blog-single-16</option>
        <option value="http://demo.freshface.net/file/rw/wp/apples-and-oranges/">blog-single-17</option>
        <option value="http://demo.freshface.net/file/rw/wp/dance-puppets-dance/">blog-single-18</option>
        <option value="http://demo.freshface.net/file/rw/wp/stop-looking-around/">blog-single-19</option>
        <option value="http://demo.freshface.net/file/rw/wp/she-is-laughing-hard/">blog-single-20 HOT</option>
    </select>
    <div class="template_left live_button_left" rel="single">&lt;</div>
    <div class="template_right live_button_right" rel="single">&gt;</div>




<!-- FONTS -->

	<div class="clear"></div>
    <div id="live_google_fonts_wrapper">
	    <h7 class="live_google_fonts_header">Google Fonts</h7>
	    <select id="live_google_fonts">
	        <?php
	        //print_r($google_font_family);
	
	        $selected = 'DEFAULT';
	        if(isset($_SESSION['live_google_fonts']) ) $selected = $_SESSION['live_google_fonts'];
	         foreach ($google_font_family as $one_font)
	         {
	            $this_sel = '';
	            if($one_font == $selected) $this_sel = 'selected="selected"';
	          $font_name_normalized = str_replace(' ', '+', $one_font);
	           $font_name_normalized = str_replace(',', '\',\'', $font_name_normalized);
	            echo '<option '.$this_sel.' value="'.$font_name_normalized.'">'.$one_font.'</option>';
	         }
	        ?>
	    </select>
	    <?php
	     if($selected!= 'DEFAULT')
	     {
	         echo "<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=".str_replace(' ', '+', $selected)."' type='text/css'/>";
	     }
	    ?>
    </div>
<!-- /FONTS -->

<!-- RESET -->
    <form method="get" action="?live_google_fonts=DEFAULT&amp;live_slider_grid=true&amp;live_slider_title=true&amp;live_slider_type=slider-1&amp;livepanel_header_template=header-1">
        <div id="live_reset_wrapper">
	        <input type="submit" id="live_reset" value="RESET ALL" />
	    </div>
    </form>
<!-- /RESET -->

<?php
    if(!$default_skin) $default_skin = $skin_names[0];
echo '<div id="skins_preloading" style="display:none;">';
    foreach ($skins_scanned as $one_skin_name) {
        if($default_skin == $one_skin_name) continue;
        echo '<img src="'.get_bloginfo('template_url').'/skins/'.$one_skin_name.'/'.$one_skin_name.'.css" alt="" />';
    }
echo '</div>';
?>
</div>
<div class="livepanel_button"></div>
</div> <!-- end livepanel wrapper-->
<script type="text/javascript">
jQuery(document).ready(function($){
function getCookieVal (offset) {
  var endstr = document.cookie.indexOf (";", offset);
  if (endstr == -1) { endstr = document.cookie.length; }
  return unescape(document.cookie.substring(offset, endstr));
  }
function getCookie (name) {
  var arg = name + "=";
  var alen = arg.length;
  var clen = document.cookie.length;
  var i = 0;
  while (i < clen) {
    var j = i + alen;
    if (document.cookie.substring(i, j) == arg) {
      return getCookieVal (j);
      }
    i = document.cookie.indexOf(" ", i) + 1;
    if (i == 0) break;
    }
  return null;
  }
$('#live_google_fonts').change(function(){
    document.location = '?was_change=true&'+'live_google_fonts='+$(this).val();
});
$('#live_stencil_fixed').click(function(){
    if($(this).attr('checked') == true) {
    $('body').addClass('stencil_fixed');
    document.cookie='stencil_fixed=true ; path=/';
    }
    else{
    $('body').removeClass('stencil_fixed');
    document.cookie='stencil_fixed=false ; path=/';
    }
});

var template_url = "<?php echo get_bloginfo('template_url');  ?>";
var blog_url = "<?php echo get_bloginfo('wpurl');  ?>";
    //live_stencils_select
    function change_stencil(stencil_name) {
    if(stencil_name == null || stencil_name == 'null') return false;
    if(stencil_name != 'null')
    {
    //alert(stencil_name);
        var slider_class = '';
        if($('body').hasClass('option-slider-1')) slider_class = 'option-slider-1';
        if($('body').hasClass('option-slider-2')) slider_class = 'option-slider-2';
        if($('body').hasClass('option-slider-3')) slider_class = 'option-slider-3';
        if($('body').hasClass('option-slider-4')) slider_class = 'option-slider-4';
        
        $('body').removeClass();
        $('body').addClass(slider_class);
        if( $('#live_stencil_fixed').attr('checked') == true ){ $('body').addClass('stencil_fixed');   }
        $('body').addClass('stencil_'+stencil_name);
         $('#live_stencils_select').val(stencil_name).blur();
        document.cookie='stencil_default='+stencil_name+' ; path=/';
    }
    }
 if( $('#live_stencil_fixed').attr('checked') == true ){ $('body').addClass('stencil_fixed');   }

    change_stencil(getCookie('stencil_default'));


        $('.template_left').click(function(){
        
        
        var type = $(this).attr('rel');                         //live_portfolio_templates
        var next_val= $('#live_'+type+'_templates').find('option:selected').prev().val();
        if(next_val == $('#live_'+type+'_templates').find('option').eq(0).val())
            next_val = $('#live_'+type+'_templates').find('option').last().val()
        $('#live_'+type+'_templates').val(next_val);

        //alert($('#live_'+type+'_templates').val());
      //  alert ($('live_'+type+'_templates').find('option:selected').next().attr('selected'));
       // $('live_'+type+'_templates').val(next_val)
        document.cookie= $(this).attr('rel') + '_template_selected='+$('#live_'+type+'_templates').val()+' ; path=/';
         window.location = $('#live_'+type+'_templates').val() + '?was_change=true';
    });

    $('.template_right').click(function(){
        var type = $(this).attr('rel');                         //live_portfolio_templates
        var next_val= $('#live_'+type+'_templates').find('option:selected').next().val();
        if(next_val == undefined) {
            next_val = $('#live_'+type+'_templates').find('option').eq(1).val();

        }
        $('#live_'+type+'_templates').val(next_val);

      //  alert ($('live_'+type+'_templates').find('option:selected').next().attr('selected'));
       // $('live_'+type+'_templates').val(next_val)
        document.cookie= $(this).attr('rel') + '_template_selected='+$('#live_'+type+'_templates').val()+' ; path=/';
         window.location = $('#live_'+type+'_templates').val() + '?was_change=true';
    });

    $('.live_template_changer').change(function(){
        document.cookie= $(this).attr('rel') + '_template_selected='+$(this).val()+' ; path=/';
     //   alert($(this).attr('rel') + '_template_selected='+$(this).val()+' ; path=/');
        window.location = $(this).val() + '?was_change=true';
    });
    
    if(getCookie('blog_template_selected') != null)
        $('#live_blog_templates').val(getCookie('blog_template_selected'));
        
    if(getCookie('portfolio_template_selected') != null) $('#live_portfolio_templates').val(getCookie('portfolio_template_selected'));
    if(getCookie('single_template_selected') != null)  $('#live_single_templates').val(getCookie('single_template_selected'));
    
    
    $('#live_stencils_select').change(function(){
        change_stencil($(this).val());
    });
    
        $('#live_stencil_left').click(function() {

        stencil_left('live_stencils_select');
    });
    $('#live_stencil_right').click(function() {

        stencil_right('live_stencils_select');
    });

    
    $('#live_reset').click(function(){
    change_skin('black');

     document.cookie= 'single_template_selected=null ; path=/';
      document.cookie= 'portfolio_template_selected=null ; path=/';
      document.cookie= 'blog_template_selected=null ; path=/';
    // $('#live_portfolio_template').val( $('#live_portfolio_template').find('option').eq(0).val() );
        //alert($(this).parent().attr('action'));
     //alert($(this).parent().parent().attr('action'));
     document.location = $(this).parent().parent().attr('action') + '&was_change=true';
     
     return false;
    });
    function change_param(header_name,param_name) {
        if(param_name == 'live_slider_type') window.location =  blog_url +   '?'+param_name+'='+header_name + '&was_change=true';
        else
        document.location =  '?'+param_name+'='+header_name + '&was_change=true';
    }
    $('#live_slider_grid').click(function(){
        window.location =  blog_url + '?'+'live_slider_grid'+'='+$(this).attr('checked') + '&was_change=true';
    });
    
    $('#live_slider_title').click(function(){
        window.location =  blog_url + '?'+'live_slider_title'+'='+$(this).attr('checked') + '&was_change=true';
    });
    $('#live_slider_select').change(function() {
        change_param($(this).val(),'live_slider_type');
    });
    $('#live_slider_left').click(function() {

        template_left('live_slider_select','live_slider_type');
    });
    $('#live_slider_right').click(function() {

        template_right('live_slider_select','live_slider_type');
    });
    
    
     // s 83, d 68
     $(document).keyup(function(event) {
      if( event.keyCode == 37 ) {
      style_left('live_style_select');
        $('#live_style_select').blur();
      }
            if( event.keyCode == 39 ) {
             $('#live_style_select').blur();
      style_right('live_style_select');
      }
        if( event.keyCode == 38 ) {
        $('#live_stencils_select').blur();
      stencil_right('live_stencils_select');
      }
        if( event.keyCode == 105 ||  event.keyCode == 57) {
        if( $('#grid').css('display') == 'none' ){
            $('#grid').css('display','block');
        }
        else {
            $('#grid').css('display','none');
        }
     }
            if( event.keyCode == 40 ) {
   //   stencil_left('live_stencils_select');
      }
    });
    $('#live_header_select').change(function() {
        change_param($(this).val(),'livepanel_header_template');
    });
    $('#live_header_left').click(function() {

        template_left('live_header_select','livepanel_header_template');
    });
    $('#live_header_right').click(function() {

        template_right('live_header_select','livepanel_header_template');
    });


    function change_skin(skin_name) {
        $('#live_style_select').blur();
        //live_stencils_select
        $('#live_stencils_select').html('');
        var new_html = '';
        if( js_stencils[skin_name] != undefined )
        {
        $(js_stencils[skin_name]).each(function(index, value){
          //  alert(value);
        new_html = new_html + '<option value="'+value+'">'+value+'</option>';
        });
        change_stencil(js_stencils[skin_name][0]);
        $('#live_stencils_select').html(new_html);
        //alert(js_stencils[skin_name]);
        }
        $('#changeable_stylesheet').attr('href', template_url + '/skins/' + skin_name + '/' + skin_name + '.css');
        document.cookie='skin_changer_default='+skin_name+'; path=/';
        $('.logo_holder a img').attr('src', template_url + '/skins/'+skin_name+'/gfx/logo.png');

    }
    $('#live_style_select').change(function(){
        change_skin( $(this).attr('value') );
        document.cookie='skin_changer_default='+$(this).attr('value')+'; path=/';
        $(this).find('option').each(function(){ } );
    });
    
    $('#live_style_left').click(function(){

    style_left('live_style_select');
    });
    
    $('#live_style_right').click(function(){
        style_right();
    });
    function template_left(select_name, param_name)
    {
        var skin_holder = new Array($('#'+select_name).find('option').length);
        var skin_counter = 0;

        $('#'+select_name).find('option').each(function(){

           skin_holder[skin_counter] = $(this).val();

            if ($(this).val() == $('#'+select_name).val() && skin_counter > 0) {

                $('#'+select_name).val(skin_holder[skin_counter-1]);
                change_param(skin_holder[skin_counter-1], param_name);

            }
            skin_counter++;
        });
    }

    function template_right(select_name, param_name)
    {
        var skin_holder = new Array($('#'+select_name).find('option').length);
        var skin_counter = 0;
        var actual_skin_id = -1;
        $('#'+select_name).find('option').each(function(){

           skin_holder[skin_counter] = $(this).val();

            if ($(this).val() == $('#'+select_name).val() && skin_counter < $('#'+select_name).find('option').length -1) {

                actual_skin_id = skin_counter;
                //$('#live_style_select').val(skin_holder[skin_counter+1]);
                //change_skin(skin_holder[skin_counter+1]);

            }
            skin_counter++;
        });
        if(actual_skin_id != -1)
        {
            $('#'+select_name).val(skin_holder[actual_skin_id+1]);
            change_param(skin_holder[actual_skin_id+1], param_name);
        }
    }

    function stencil_left(select_name)
    {
            var next_val= $('#'+select_name).find('option:selected').prev().val();
         if(next_val == undefined) next_val= $('#'+select_name).find('option').last().val();
         $('#'+select_name).val(next_val);
         change_stencil(next_val);
    
    /*    var skin_holder = new Array($('#'+select_name).find('option').length);
        var skin_counter = 0;

        $('#'+select_name).find('option').each(function(){

           skin_holder[skin_counter] = $(this).val();

            if ($(this).val() == $('#'+select_name).val() && skin_counter > 0) {

                $('#'+select_name).val(skin_holder[skin_counter-1]);
                change_stencil(skin_holder[skin_counter-1]);

            }
            skin_counter++;
        });     */
    }
    function stencil_right(select_name)
    {
         var next_val= $('#'+select_name).find('option:selected').next().val();
         if(next_val == undefined) next_val= $('#'+select_name).find('option').eq(0).val();
         $('#'+select_name).val(next_val);
         change_stencil(next_val);
        // alert(next_val);
    }
    
    
    function style_left(select_name)
    {
         var next_val= $('#'+select_name).find('option:selected').prev().val();
         if(next_val == undefined) next_val= $('#'+select_name).find('option').last().val();
         $('#'+select_name).val(next_val);
         change_skin(next_val);
    }
    function style_right()
    {
              var select_name = "live_style_select";
             var next_val= $('#'+select_name).find('option:selected').next().val();
         if(next_val == undefined) next_val= $('#'+select_name).find('option').eq(0).val();
         $('#'+select_name).val(next_val);
         change_skin(next_val);

    }

    //$('#live_style_select').find('option').css('display','none');//.select(function(){
    //alert('d');
    //});
    
    var closed_preview = false;
    if(getCookie('close_preview') != 'yes') {
        closed_preview= false;
    }
    else {
        closed_preview = true;
    }
    $('.livepanel_button').click(function(){
         if(closed_preview == false) {
            $('.livepanel_wrapper').stop().animate({left: -200  },200);
            document.cookie='close_preview=yes ; path=/';
            $('.livepanel_wrapper').removeClass('livepanel_wrapper_active');
         }
         else {
            $('.livepanel_wrapper').stop().animate({left: 0  },200);
            document.cookie='close_preview=no ; path=/';
            $('.livepanel_wrapper').addClass('livepanel_wrapper_active');
         }
         closed_preview = !closed_preview;
    });
     /*
    if(getCookie('firsttime_user') == null){
        $('.livepanel_wrapper').stop().animate({left: -20},200).animate({left: 0},200).animate({left: -20},200).animate({left: 0},200);
        document.cookie='firsttime_user=no ; path=/';
    }
    else
    {
      $(document).mousemove(function(e){
        if(e.pageX > $('.style_holder').width() )
        {
            $('.livepanel_wrapper').stop().css('left',- parseInt( $('.style_holder').css('width')));
        }
         $(this).unbind('mousemove');
       // alert(e.pageX);
      });
    }


       $('.livepanel_button, .style_holder').hover(function(){
        //var livepanel_wrapper = $('.livepanel_wrapper');
        $('.livepanel_wrapper').stop().animate({left:0},200);
       //alert('dioc');
       // $('.livepanel_wrapper').animate({left:0},1000);
      }, function(e){
              if(e.pageX > $('.style_holder').width() )
              {
      //var livepanel_wrapper = $('.livepanel_wrapper');
      $('.livepanel_wrapper').stop().animate({left: - 199  },200);
        //$('.livepanel_wrapper').animate({left: parseInt(livepanel_wrapper.css('width'))}, 1000);
      }
      });
        */
});
</script>
<?php //echo $_GET['was_change'].'xxx'; ?>
<style type="text/css">
.livepanel_wrapper {
    position:fixed;
    top:0px;
<?php
    if($_COOKIE['close_preview'] == 'yes') echo 'left:-200px;';   // this is NOT first invite, so we move livepanel to -200px (hide it)
    else echo 'left:0px;';  // this is first time invite, so we show livepanel!
?>

    z-index:999;
    width:250px;
}
.livepanel_wrapper .livepanel_button	{ cursor:pointer;float:right; width:38px; height: 40px; background-repeat: no-repeat; background-position: 0px 3px; position: relative; top: 71px; left: -11px; -moz-border-radius: 0 99px 99px 0; -webkit-border-radius: 0 99px 99px 0; -o-border-radius: 0 99px 99px 0; border-radius: 0 99px 99px 0;}

.livepanel_wrapper .style_holder { width:179px; padding: 0 10px 0 10px; float:left;}

.livepanel_wrapper h7	{width: 179px; display: block; padding: 5px 0 0 0; margin: 8px 0 0 0; font-size: 11px; letter-spacing: normal; text-transform: none;}
.livepanel_wrapper h7.live_header_first	{ margin: 0; border: none;}
.livepanel_wrapper #live_style_select, .livepanel_wrapper #live_style_select, .livepanel_wrapper #live_stencils_select, .livepanel_wrapper #live_portfolio_templates, .livepanel_wrapper #live_blog_templates, .livepanel_wrapper #live_single_templates, .livepanel_wrapper #live_header_select, .livepanel_wrapper #live_slider_select, .livepanel_wrapper #live_google_fonts	{ width: 134px; float: left;}
.livepanel_wrapper #live_google_fonts	{ width: 179px;}
.livepanel_wrapper .live_button_left	{ width: 17px; height: 17px; font-weight: bold; float: left; line-height: 16px; text-align: center; margin: 0 0 0 5px; font-size: 10px; -moz-border-radius: 2px; -webkit-border-radius: 2px; -o-border-radius: 2px; border-radius: 2px; cursor: pointer;}
.livepanel_wrapper .live_button_right	{ width: 17px; height: 17px; font-weight: bold; float: left; line-height: 16px; text-align: center; margin: 0 0 0 5px; font-size: 10px; -moz-border-radius: 2px; -webkit-border-radius: 2px; -o-border-radius: 2px; border-radius: 2px; cursor: pointer;}
#live_stencil_fixed, #live_slider_grid, #live_slider_title	{ margin: 0 5px 0 0;}
.livepanel_wrapper label	{ margin: 0 10px 0 0; font-size: 11px; }


.livepanel_wrapper #live_google_fonts_wrapper	{ float: left; height: 76px;}
.livepanel_wrapper .live_google_fonts_header	{ width: 93px; padding-right: 5px;}
.livepanel_wrapper #live_google_fonts	{ width: 90px; margin-right: 5px;}

.livepanel_wrapper #live_reset_wrapper	{ float: right; width: 75px; height: 42px; margin: 8px 0 0 0; padding: 25px 0 0 5px;}
.livepanel_wrapper #live_reset	{ float: left; font-size: 10px; font-weight: bold; padding: 2px 3px; margin: 0 0 0 5px; text-transform: uppercase; cursor: pointer; border: none; -moz-border-radius: 2px; -webkit-border-radius: 2px; -o-border-radius: 2px; border-radius: 2px; }




<?php
 $g_fonts = $_SESSION['live_google_fonts'];

 if(isset($_SESSION['live_google_fonts']) &&  $g_fonts != 'DEFAULT')
    echo " .info_line, .message, .post_title, .comments_number, .comment_form_left h3, #cat_title h1, contact_form_left h2{ font-family: '".$g_fonts."' !important;}\n";
?>
</style>