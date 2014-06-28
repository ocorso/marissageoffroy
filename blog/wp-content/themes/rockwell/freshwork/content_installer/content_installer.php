<?php
  
  //////////////////////////////////////////////////////////////////////////////
  // FRESHPANEL ADD FUNCTION
  ////////////////////////////////////////////////////////////////////////////// 

  function content_installer_init()
  {
     if($_GET['page'] == 'content_installer')
    {
        $file_dir=get_bloginfo('template_directory');
        wp_enqueue_style("freshslider_css", $file_dir."/freshwork/content_installer/content_installer.css", false, "1.0", "all");
       // wp_enqueue_script("freshslider_js", $file_dir."/freshwork/freshslider/js/control.js", false, "1.0");
        //wp_enqueue_script("freshpanel_select_js", $file_dir."/freshwork/freshpanel/jquery.select.js", false, "1.0");
    }
  }
  add_action('admin_init', 'content_installer_init');
  function content_installer()
  {


   ?>

<div class="wrap">



	<div id="icon-themes" class="icon32"><br /></div>
	<h2>Content Installer</h2>
	<div id="content_installer">

		<!-- /////////////////////////////////////////////////////////////////////// -->
		<!-- //             Left Column                                           // -->
		<!-- /////////////////////////////////////////////////////////////////////// -->
		<div id="content_installer_window_wrapper" class="metabox-holder">

			<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- //             Box                                                   // -->
			<!-- /////////////////////////////////////////////////////////////////////// -->
			<div id="content_installer_window" class="postbox" >
				<form method="post">
					<h3 class='postbox-title'>
						<span>One-Click Installation of Demo Content</span>
					</h3>
					<div class="inside">
						<p class="howto">
							<img src="<?php echo get_bloginfo('template_url'); ?>/freshwork/content_installer/gfx/exclamation_frame.png" class="warning_small" />
							<strong>WARNING:</strong> <span class="underline">Install <strong>only</strong> if you are using a completely new and clean database!</span> <br/><br/>In other words, installing this Demo Content on your old site, where you already have some content, is <strong>not recommended</strong> because you will most likely ran into some problems. <br/><br/>Use at your own risk.<br/><br/>
						</p>
						<div class="another_template">
							<div class="select_button another_template_button">Install</div>
							<div class="another_template_active">
								<span class="another_template_or">or</span>
								<span class="another_template_cancel">Cancel</span>
							</div>
							<div class="clear"></div>
						</div>						
					</div>
				</form>
			</div>
		</div>
	</div>












</div>

   <?php
  }

