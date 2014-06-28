<?php

function category_manager()
{
global $category_options_json, $category_additional_options,$single_options_json,
$single_additional_options, $category_blog_templates, $category_portfolio_templates,$single_blog_templates;


?>

<div class="wrap">

	<div id="icon-themes" class="icon32"><br /></div>
	<h2>Category Options</h2>
	<div id="freshcategory">

		<div id="cat_apply_icon_tooltip">This is a huge help for those who are dumb...</div>

		<!-- /////////////////////////////////////////////////////////////////////// -->
		<!-- //             Left Column                                           // -->
		<!-- /////////////////////////////////////////////////////////////////////// -->
		<div id="left-column" class="metabox-holder">

			<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- //             Box                                                   // -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<div id="select-category" class="postbox" >
			<form method="post">
				<h3 class='postbox-title'>
					<span>Categories</span>
				</h3>
				<div class="inside">
					<p class="howto">Select which category you would like to edit:</p>
					<p>

					<ul id="cat-list">
                    <?php
                        global $cat_list;
                        foreach ($cat_list as $key=>$one_cat) {
                            $cat_padding = '';
                            if($one_cat[1] == 'Search') $cat_padding = 'style="padding-bottom:50px;"';
                            echo '<li class="cat-list-'.$one_cat[0].'" rel="'.$key.'" '.$cat_padding.' title="'.$one_cat[0].'">';
                                echo '<div class="cat_name">'.$one_cat[1].'</div>';
                                echo '<div class="cat_apply"><div class="cat_apply_icon"></div></div>';
                            echo '</li>';
                        }
                    ?>
                    </ul>

                    </p>
					<p class="button-controls">
						<img class="waiting" src="http://freshface.cz/work/rw/wp-admin/images/wpspin_light.gif" alt="" />
                        <input type="hidden" name="save_category_manager" value="true">
                        <input type="hidden" name="json_category" id="json_category">
                        <input type="hidden" name="json_single" id="json_single">
						<input type="submit" class="button-primary" name="nav-menu-locations" value="Save" />
					</p>
				</div><!-- /.inside -->
			</form>
			</div>
<?php
echo '<script>';
echo 'var category_data_holder = jQuery.parseJSON(\''.json_encode ($category_options_json).'\');';
echo 'var single_data_holder = jQuery.parseJSON(\''.json_encode ($single_options_json).'\');';
echo '</script>';
?>
		</div><!-- /#left-column -->

		<!-- /////////////////////////////////////////////////////////////////////// -->
		<!-- //             Right Column                                          // -->
		<!-- /////////////////////////////////////////////////////////////////////// -->
		<div id="right-column">

 			<div class="postbox">
				<div class="nav-menu-header">

					<div class="nav-menu-title">
						<span>'Category view' Options</span>
					</div><!-- END .nav-menu-title -->
				</div><!-- END .nav-menu-header -->
				<div class="inside">
					<ul id="category-options-additional">
                        <?php
                            foreach($category_additional_options as $one_option)
                            {
                                if($one_option['id'] == 'cat_fixed_height') {
                                echo '<li style="width:100%;"><hr>';
                                 echo "<h4>'Category Post view' Main Image Height</h4>";
	                             echo '<p>';
                                    echo '<input id="'.$one_option['id'].'" type="'.$one_option['type'].'" name="'.$one_option['id'].'" value="'.$one_option['default'].'">';
		                          echo '<label for="single_image_height">Insert the desired height of your image (in pixels). This settings will be then automatically applied to this post under any "Single Post view" template. It will also override the default settings from Category Manager which allows you to set each post differently according to your needs. If you rather wish to leave the default value extracted from template\'s .php file, please input zero like this: 0</label>';
	                            echo '</p>';
	                            echo '</li>';
                                }
                                else if($one_option['id'] == 'cat_cat_exclude') {
                                echo '<li style="width:100%;"><hr>';
                                 echo "<h4>Exclude / Include categories</h4>";
	                             echo '<p>';
                                    echo '<input id="'.$one_option['id'].'" type="'.$one_option['type'].'" name="'.$one_option['id'].'" value="'.$one_option['default'].'">';
		                          echo '<label for="single_image_height">Exclude / Include categories in this format: 15,25,11 for INCLUDING.  -15,-25,-11 for EXCLUDING</label>';
	                            echo '</p>';
	                            echo '</li>';
                                }
                                else if($one_option['type'] == 'select')
                                {
                                    echo '<li>';
                                    echo '<label for="'.$one_option['id'].'">';
                                    echo '<select id="'.$one_option['id'].'" name="'.$one_option['id'].'" >';
                                    foreach( $one_option['options'] as $key => $value )
                                    {
                                        echo '<option value="'.$value.'">'.$key.'</option>';
                                    }
                                    echo '</select>'.$one_option['name'];
                                    echo '</label>';
                                    echo '</li>';
                                }
                                else
                                {
                                echo '<li>';
                                echo '<label for="'.$one_option['id'].'">';
                                echo '<input id="'.$one_option['id'].'" type="'.$one_option['type'].'" name="'.$one_option['id'].'" value="'.$one_option['default'].'">'.$one_option['name'];
                                echo '</label>';
                                echo '</li>';
                                }
                            }
                        ?>
                        <div class="clear"></div>
					</ul>
					<div class="clear"></div>
				</div>
			</div><!-- /postbox -->


			<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- //             Box - with tabs on top                                // -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<div class="postbox">
							<div class="nav-menu-header">
								<div class="nav-menu-title">
									<span>'Category view' Templates</span>
								</div><!-- END .nav-menu-title -->
							</div><!-- END .nav-menu-header -->
				<div class="inside">

					<!-- /////////////////////////////////////////////////////////////////////// -->
					<!-- //             CATEGORY OPTIONS - Box - with tabs on top             // -->
					<!-- /////////////////////////////////////////////////////////////////////// -->
					<div id="category-options" >

							<div class="nav-tabs-wrapper">
								<span class="select_name">Select Post Type:</span>
								<div class="nav-tabs">
									<span id="nav-tab-blog" class="select_button nav-tab-active">Blog</span>
									<span id="nav-tab-portfolio" class="select_button">Portfolio</span>
								</div>
								<div class="clear"></div>
							</div><!-- /.nav-tabs-wrapper -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             Category Blog                                         // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="category-blog">
								<div class="sidebar_option_wrapper">
									<span class="select_name">Select Sidebar:</span>
									<div id="blog-subnav-left" class="select_button">Left Sidebar</div>
									<div id="blog-subnav-right" class="select_button">Right Sidebar</div>
									<div id="blog-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div>
								</div>

								<ul class="templates_wrapper" id="category-blog-left" rel="blog-subnav-left">
								<?php
                                    foreach($category_blog_templates['left'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/blogcat/left/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-blog-left -->

								<ul class="templates_wrapper" id="category-blog-right" rel="blog-subnav-right">
								<?php
                                    foreach($category_blog_templates['right'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/blogcat/right/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-blog-right -->

								<ul class="templates_wrapper" id="category-blog-no" rel="blog-subnav-no">
								<?php
                                    foreach($category_blog_templates['fullwidth'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/blogcat/full/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-blog-no -->

								<div class="clear"></div>
							</div><!-- /#category-blog -->

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             Category Portfolio                                    // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="category-portfolio">
								<div class="sidebar_option_wrapper">
								<!--	<span class="select_name">Select Sidebar:</span>
									<div id="portfolio-subnav-left" class="select_button">Left Sidebar</div>
									<div id="portfolio-subnav-right" class="select_button">Right Sidebar</div>
									<div id="portfolio-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div> -->
								</div>

								<ul class="templates_wrapper" id="category-portfolio-no" rel="portfolio-subnav-no">
								<?php
                                    foreach($category_portfolio_templates['fullwidth'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/portcat/full/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="category-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#category-portfolio-no -->

								<div class="clear"></div>
							</div><!-- /#category-portfolio -->
					</div><!-- /#category-options -->
				</div>
			</div>

 			<div class="postbox">
				<div class="nav-menu-header">
					<div class="nav-menu-title">
						<span>'Single Post view' Options</span>
					</div><!-- END .nav-menu-title -->
				</div><!-- END .nav-menu-header -->
				<div class="inside">
					<ul id="single-options-additional">
                        <?php
                            foreach($single_additional_options as $one_option)
                            {
                                if($one_option['id'] == 'sin_fixed_height') {
                                echo '<li style="width:100%;"><hr>';
                                 echo "<h4>'Single Post view' Main Image Height</h4>";
	                             echo '<p>';
                                    echo '<input id="'.$one_option['id'].'" type="'.$one_option['type'].'" name="'.$one_option['id'].'" value="'.$one_option['default'].'">';
		                          echo '<label for="single_image_height">Insert the desired height of your image (in pixels). This settings will be then automatically applied to this post under any "Single Post view" template. It will also override the default settings from Category Manager which allows you to set each post differently according to your needs. If you rather wish to leave the default value extracted from template\'s .php file, please input zero like this: 0</label>';
	                            echo '</p>';
	                            echo '</li>';
                                }
                                else
                                {
                                echo '<li>';
                                echo '<label for="'.$one_option['id'].'">';
                                echo '<input id="'.$one_option['id'].'" type="'.$one_option['type'].'" name="'.$one_option['id'].'" value="'.$one_option['default'].'">'.$one_option['name'];
                                echo '</label>';
                                echo '</li>';
                                }
                            }
                        ?>
                        <div class="clear"></div>
					</ul>
					<div class="clear"></div>
				</div>
			</div><!-- /postbox -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- //             Box - with tabs on top                                // -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<div class="postbox">
							<div class="nav-menu-header">
								<div class="nav-menu-title">
									<span>'Single Post view' Templates</span>
								</div><!-- END .nav-menu-title -->
							</div><!-- END .nav-menu-header -->
				<div class="inside">

					<!-- /////////////////////////////////////////////////////////////////////// -->
					<!-- //             SINGLE OPTIONS - Box - with tabs on top               // -->
					<!-- /////////////////////////////////////////////////////////////////////// -->
					<div id="single-options">

							<!-- /////////////////////////////////////////////////////////////////////// -->
							<!-- //             single Blog                                         // -->
							<!-- /////////////////////////////////////////////////////////////////////// -->
							<div id="single-blog">
								<div class="sidebar_option_wrapper">
									<span class="select_name">Select Sidebar:</span>
									<div id="single-blog-subnav-left" class="select_button">Left Sidebar</div>
									<div id="single-blog-subnav-right" class="select_button">Right Sidebar</div>
									<div id="single-blog-subnav-no" class="select_button">No Sidebar</div>
									<div class="clear"></div>
								</div>

								<ul class="templates_wrapper" id="single-blog-left" rel="single-blog-subnav-left" title="nav-tab-single-blog">
								<?php
                                    foreach($single_blog_templates['left'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/single/left/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="single-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-left -->

								<ul class="templates_wrapper" id="single-blog-right" rel="single-blog-subnav-right" title="nav-tab-single-blog">
								<?php
                                    foreach($single_blog_templates['right'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/single/right/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="single-template" value="'.$category_template['name'].'"></span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                ?>
									<div class="clear"></div>
								</ul><!-- /#single-blog-right -->

								<ul class="templates_wrapper" id="single-blog-no" rel="single-blog-subnav-no" title="nav-tab-single-blog">
								<?php
                                    foreach($single_blog_templates['fullwidth'] as $category_template)
                                    {
                                        echo '<li>';
                                        echo '<a href="#"><img src="'.get_bloginfo("template_url").'/freshwork/freshcategory/single/full/'.$category_template['img'].'"></a>';
                                        echo '<label>';
                                        echo '<span class="select_template_value">'.$category_template['name'].'</span>';
                                        echo '<span class="select_template_radio"><input type="radio" name="single-template" value="'.$category_template['name'].'"></span>';
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



								<div class="clear"></div>
							</div><!-- /#category-portfolio -->
					</div><!-- /#category-options -->
				</div>
			</div>

		</div><!-- /#right-column --><!-- /RIGHT COLUMN -->

	</div><!-- /#freshcategory -->
</div><!-- /.wrap-->
<div class="clear"></div>

<?php
}
?>