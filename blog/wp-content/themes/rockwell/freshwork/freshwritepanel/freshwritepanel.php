<?php
////////////////////////////////////////////////////////////////////////////////
// POST & PAGE WRITE PANELS
////////////////////////////////////////////////////////////////////////////////
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_writepanels');

add_action('edit_post', 'post_css');
$single_blog_templates = array(
    "left" => array(
        array("name" =>"blog-single-4",
        "img"=>"sing4.jpg"),

        array("name" =>"blog-single-5",
        "img"=>"sing5.jpg"),
        array("name" =>"blog-single-6",
        "img"=>"sing6.jpg"),
        array("name" =>"blog-single-7",
        "img"=>"sing7.jpg"),
        array("name" =>"blog-single-8",
        "img"=>"sing8.jpg"),
        array("name" =>"blog-single-9",
        "img"=>"sing9.jpg"),
        array("name" =>"blog-single-10",
        "img"=>"sing10.jpg"),

        array("name" =>"blog-single-20",
        "img"=>"sing20.jpg"),

    ),
    "fullwidth" => array(
        array("name" =>"blog-single-16",
        "img"=>"sing16.jpg"),
        array("name" =>"blog-single-17",
        "img"=>"sing17.jpg"),
        array("name" =>"blog-single-18",
        "img"=>"sing18.jpg"),
        array("name" =>"blog-single-19",
        "img"=>"sing19.jpg"),
    ),
    "right" => array(
        array("name" =>"blog-single-1",
        "img"=>"sing1.jpg"),
        array("name" =>"blog-single-2",
        "img"=>"sing2.jpg"),
        array("name" =>"blog-single-3",
        "img"=>"sing3.jpg"),
        array("name" =>"blog-single-11",
        "img"=>"sing11.jpg"),
        array("name" =>"blog-single-12",
        "img"=>"sing12.jpg"),
        array("name" =>"blog-single-13",
        "img"=>"sing13.jpg"),
        array("name" =>"blog-single-14",
        "img"=>"sing14.jpg"),
        array("name" =>"blog-single-15",
        "img"=>"sing15.jpg"),
    )
);
function post_css()
{
}
function save_postdata_writepanels($post_id)
{
    delete_post_meta($post_id, 'single_image_height');
    delete_post_meta($post_id, 'category_image_height');
    
    add_post_meta($post_id, 'single_image_height', $_POST['single_image_height'], true);
    add_post_meta($post_id, 'category_image_height', $_POST['category_image_height'], true);
   /* $image_s_height = get_post_meta($post_id, 'single_image_height',true);
    //echo $image_s_height.$_POST['single_image_height'].'xx';
    if($image_s_height == '')  add_post_meta($post_id, 'single_image_height', $_POST['single_image_height'], true);
    else update_post_meta($post_id, 'single_image_height', $_POST['single_image_height']);

    
    $image_c_height = get_post_meta($post_id, 'category_image_height',true);
    if($image_c_height == '')  add_post_meta($post_id, 'category_image_height', $_POST['category_image_height'], true);
    else update_post_meta($post_id, 'category_image_height', $_POST['category_image_height']);
     */
 if(get_post_meta($post_id, 'single_template_custom',true) == "" && $_POST['single-template'] != "")
    {
        add_post_meta($post_id, 'single_template_custom', $_POST['single-template'], true);

    }
    elseif($_POST['single-template'] == '')
    {
        delete_post_meta($post_id, 'single_template_custom');
    }
    else
    {

        update_post_meta($post_id, 'single_template_custom', $_POST['single-template']);
     //   echo 'ddd'.get_post_meta($post_id, 'single_template_custom',true);
     }
     
     if($_POST['page_title']) {
        delete_post_meta($post_id, 'hide_title');
         add_post_meta($post_id, 'hide_title', true, true);

     }
     else
     {

      delete_post_meta($post_id, 'hide_title');
      add_post_meta($post_id, 'hide_title', false, true);
     }
     
    if($_POST['post_meta']) {
        delete_post_meta($post_id, 'hide_meta');
         add_post_meta($post_id, 'hide_meta', true, true);

     }
     else
     {

      delete_post_meta($post_id, 'hide_meta');
      add_post_meta($post_id, 'hide_meta', false, true);
     }


  //  echo " ".$post_id." ".$_POST['single_template_input'];
     // echo $_POST['single_template_input'];
    // echo $_POST['single_template_input'].'s';
    //echo  '.aa.'.$_POST['single-template'].'xxx';
  /* //  echo   $_POST['single_image_height'].'dick';
     add_post_meta($post_id, 'single_image_height', $_POST['single_image_height'], true);
        add_post_meta($post_id, 'category_image_height', $_POST['category_image_height'], true);
        update_post_meta($post_id, 'single_image_height', $_POST['single_image_height']);
        update_post_meta($post_id, 'category_image_height', $_POST['category_image_height']);

    if(get_post_meta($post_id, 'single_template_custom',true) == "" && $_POST['single-template'] != "")
    {
        add_post_meta($post_id, 'single_template_custom', $_POST['single-template'], true);
        add_post_meta($post_id, 'single_image_height', $_POST['single_image_height'], true);
        add_post_meta($post_id, 'category_image_height', $_POST['category_image_height'], true);
    }
    elseif($_POST['single-template'] == '')
    {
        delete_post_meta($post_id, 'single_template_custom');
        delete_post_meta($post_id, 'single_image_height');
        delete_post_meta($post_id, 'category_image_height');
    //    echo 's';
    }
    else
    {
        update_post_meta($post_id, 'single_template_custom', $_POST['single-template']);

     }       */

 //   echo  (get_post_meta($post_id, 'single_template_custom',true).'ss');
}

  function create_meta_box() {

    global $theme_name;
      if ( function_exists('add_meta_box') ) {

      //  add_meta_box( 'page-writepanels-new', 'Page settings', 'page_writepanels', 'page', 'normal', 'high' );
        add_meta_box( 'post-template', 'Post Template', 'post_template', 'post', 'normal', 'high' );
        add_meta_box( 'post-image', 'Post Settings', 'post_image', 'post', 'normal', 'high' );
        add_meta_box( 'page-title', 'Page Settings', 'page_title', 'page', 'normal', 'high' );
/*                $file_dir=get_bloginfo('template_directory');
  //  if(is_post())
          wp_enqueue_style("freshwritepanel_css", $file_dir."/freshwork/freshwritepanel/freshwritepanel.css", false, "1.0", "all");
    wp_enqueue_script("freshwritepanel_js", $file_dir."/freshwork/freshwritepanel/freshwritepanel.js", false, "1.0");
  */    } // end(if)
  } // end(create_meta_box)
function page_title()
{
global $post;
$show_title = get_post_meta( $post->ID, 'hide_title', true);
$checked = '';
if($show_title != false)
    $checked = 'checked="checked"';

?>
<div id="post_image">


	<p>
		<input type="checkbox" id="page_title" name="page_title" <?php  echo $checked ?>>
			<label for="page_title">Hide the Page Title ?</label>
	</p>

	<div class="clear"></div>

</div>
 <?php
}
  
function post_image()
{
global $post;
$height_single = get_post_meta( $post->ID, 'single_image_height', true);
//echo get_post_meta( $post->ID, 'single_image_height', true).'dick';
if( $height_single == '') $height_single = 0;

$height_category = get_post_meta( $post->ID, 'category_image_height', true);
if( $height_category == '') $height_category = 0;

$show_title = get_post_meta( $post->ID, 'hide_title', true);
$checked = '';
if($show_title != false)
    $checked = 'checked="checked"';
    
$show_title = get_post_meta( $post->ID, 'hide_meta', true);
$checked2 = '';
if($show_title != false)
    $checked2 = 'checked="checked"';
?>
<div id="post_image">
    <div>
       <div style="float:left; margin-right:10px;">
           <p>
                 <label for="page_title">
        		<input type="checkbox" id="page_title" name="page_title" <?php  echo $checked ?>>
        			Hide the Page Title ?</label>
           </p>
       </div>
       <div style="float:left;" >
            <p>
                <label for="post_meta">
        		<input type="checkbox" id="post_meta" name="post_meta" <?php  echo $checked2 ?>>
        			Hide the Post Meta ?</label>
           </p>
	   </div>
	   <div class="clear"></div>
	</div>
	<h4>'Category view' Main Image Height</h4>
	<p>
		<input type="text" id="category_image_height" name="category_image_height" name="category_image_height" value="<?php  echo $height_category ?>">
			<label for="single_image_height">Insert the desired height of your image (in pixels). This settings will be then automatically applied to this post under any 'Category view' template. It will also override the default settings from Category Manager which allows you to set each post differently according to your needs. If you rather wish to leave the default value extracted from template's .php file, please input zero like this: 0</label>
	</p>

	<h4>'Single Post view' Main Image Height</h4>
	<p>
		<input type="text" id="single_image_height" name="single_image_height" name="single_image_height" value="<?php  echo $height_single ?>">
		<label for="single_image_height">Insert the desired height of your image (in pixels). This settings will be then automatically applied to this post under any 'Single Post view' template. It will also override the default settings from Category Manager which allows you to set each post differently according to your needs. If you rather wish to leave the default value extracted from template's .php file, please input zero like this: 0</label>
	</p>

	<div class="clear"></div>

</div>
 <?php
}

  function post_template() {
  global $single_blog_templates, $post;
 // var_dump ($post);
  $actual_template = get_post_meta($post->ID, 'single_template_custom',true);
//  echo $actual_template.'xxx';
 // echo $actual_template.'xxx'.get_post_meta($post_id, 'single_template_custom',true).$post->ID;
  //echo 'x'.get_post_meta($post_id, 'single_template_custom',true).$post_id.'addd';
?>
<link rel='stylesheet' id='freshwritepanel_css-css'  href='<?php echo get_bloginfo('template_directory'); ?>/freshwork/freshwritepanel/freshwritepanel.css?ver=1.0' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo get_bloginfo('template_directory'); ?>/freshwork/freshwritepanel/freshwritepanel.js?ver=1.0'></script>


<div id="post_templates">

	<!-- /////////////////////////////////////////////////////////////////////// -->
	<!-- //             Box - with tabs on top                                // -->
	<!-- /////////////////////////////////////////////////////////////////////// -->
         <input type="hidden" id="aaxx" name="aaxx"    value="kokot">
        <input type="hidden" id="single_template_input" name="single_template_input" value="<?php global $post; echo get_post_meta( $post->ID, 'single_template_custom', true); ?>">
		<div class="another_template">
			<div class="select_button another_template_button">Customize</div>
			<div class="another_template_active">
				<span class="another_template_or">or</span>
				<span class="another_template_cancel">Cancel</span>
			</div>
			<div class="clear"></div>
		</div>
					<div id="single-options">

							<div class="nav-tabs-wrapper">
								<span class="select_name" style="display:none;">Select Post Type:</span>
								<div class="nav-tabs" style="display:none;">
									<span id="nav-tab-single-blog" class="select_button nav-tab-active">Blog</span>
									<span id="nav-tab-single-portfolio" class="select_button">Portfolio</span>
								</div>
								<div class="clear"></div>
							</div><!-- /.nav-tabs-wrapper -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             single Blog                                         // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="single-blog">
								<div class="sidebar_option_wrapper">
									<span class="select_name">Select Sidebar:</span>
									<div id="single-blog-subnav-left" class="select_button nav-tab-active">Left Sidebar</div>
									<div id="single-blog-subnav-right" class="select_button">Right Sidebar</div>
									<div id="single-blog-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div>
								</div>

								<ul class="templates_wrapper" id="single-blog-left" rel="single-blog-subnav-left" title="nav-tab-single-blog">
								<?php
                                    $counter = 0;
                                    foreach($single_blog_templates['left'] as $category_template)
                                    {
                                        $checked = "";
                                        if ($actual_template ==  $category_template['name']) $checked = 'checked="checked"';
                                        //if($actual_template == '' && $counter == 0) $checked = 'checked="checked"';
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/single/left/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio"  '.$checked.' name="single-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                        $counter ++;
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-left -->

								<ul class="templates_wrapper" id="single-blog-right" rel="single-blog-subnav-right" title="nav-tab-single-blog" style="display:none">
								<?php
                                    foreach($single_blog_templates['right'] as $category_template)
                                    {
                                        $checked = "";
                                        if ($actual_template ==  $category_template['name']) $checked = 'checked="checked"';
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/single/right/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" '.$checked.' name="single-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-right -->

								<ul class="templates_wrapper" id="single-blog-no" rel="single-blog-subnav-no" title="nav-tab-single-blog" style="display:none">
								<?php
                                    foreach($single_blog_templates['fullwidth'] as $category_template)
                                    {
                                        $checked = "";
                                        if ($actual_template ==  $category_template['name']) $checked = 'checked="checked"';
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/single/full/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" '.$checked.' name="single-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-no -->

								<div class="clear"></div>
							</div><!-- /#single-blog -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             single Portfolio                                    // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="single-portfolio" style="display:none;">
								<div class="sidebar_option_wrapper">
									<span class="select_name">Select Sidebar:</span>
									<div id="single-portfolio-subnav-left" class="select_button">Left Sidebar</div>
									<div id="single-portfolio-subnav-right" class="select_button">Right Sidebar</div>
									<div id="single-portfolio-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div>
								</div>

								<ul class="templates_wrapper" id="single-portfolio-left" rel="single-portfolio-subnav-left" title="nav-tab-single-portfolio">
									<li>
										<a href="#">
											<img src="http://www.freshdev.cz/file/rw/wp/wp-content/themes/rw12/gfx/layout_demo.png" />
										</a>
										<label>
											<span class="select_template_value">portfolio-cat-sss1</span>
											<span class="select_template_radio"><input type="radio" name="single-template" value="portfolio-cat-1"></span>
										</label>
									</li>
									<li>
										<a href="#">
											<img src="http://www.freshdev.cz/file/rw/wp/wp-content/themes/rw12/gfx/layout_demo.png" />
										</a>
										<label>
											<span class="select_template_value">portfolio-cat-2</span>
											<span class="select_template_radio"><input type="radio" name="single-template" value="portfolio-cat-2"></span>
										</label>
									</li>
									<li>
										<a href="#">
											<img src="http://www.freshdev.cz/file/rw/wp/wp-content/themes/rw12/gfx/layout_demo.png" />
										</a>
										<label>
											<span class="select_template_value">portfolio-cat-3</span>
											<span class="select_template_radio"><input type="radio" name="single-template" value="portfolio-cat-3"></span>
										</label>
									</li>
									<div class="clear"></div>
								</ul><!-- /#single-portfolio-left -->

								<ul class="templates_wrapper" id="single-portfolio-right" rel="single-portfolio-subnav-right" title="nav-tab-single-portfolio">
									<li>
										<a href="#">
											<img src="http://www.freshdev.cz/file/rw/wp/wp-content/themes/rw12/gfx/layout_demo.png" />
										</a>
										<label>
											<span class="select_template_value">portfolio-cat-4</span>
											<span class="select_template_radio"><input type="radio" name="single-template" value="portfolio-cat-4"></span>
										</label>
									</li>
									<li>
										<a href="#">
											<img src="http://www.freshdev.cz/file/rw/wp/wp-content/themes/rw12/gfx/layout_demo.png" />
										</a>
										<label>
											<span class="select_template_value">portfolio-cat-5</span>
											<span class="select_template_radio"><input type="radio" name="single-template" value="portfolio-cat-5"></span>
										</label>
									</li>
									<li>
										<a href="#">
											<img src="http://www.freshdev.cz/file/rw/wp/wp-content/themes/rw12/gfx/layout_demo.png" />
										</a>
										<label>
											<span class="select_template_value">portfolio-cat-6</span>
											<span class="select_template_radio"><input type="radio" name="single-template" value="portfolio-cat-6"></span>
										</label>
									</li>
									<div class="clear"></div>
								</ul><!-- /#single-portfolio-right -->



								<div class="clear"></div>
							</div><!-- /#category-portfolio -->
					</div><!-- /#category-options -->
		<div class="clear"></div>

</div><!-- /#freshwritepanel -->
<?php
  }

?>