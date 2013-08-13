	<div id="header_container" class="header_container_2">
		<div id="header_wrapper">
			<div id="header-2" class="header">
                <div class="logo_holder"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_logo(); ?>"></a></div>
				<div class="contact_holder"><?php echo get_option('ff_header3_contact'); ?></div>
				
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Navigation                                            // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
				<div id="navigation">
                    <div class="menu-navigation-container">
                        <?php wp_nav_menu(array( 'menu'=> 'Navigation', 'menu_id'=>'menu-navigation', 'walker' => new sub_nav_walker2(), ));?>
                    </div><!-- END div.menu-navigation-container -->

                </div><!-- END div#navigation -->
                
                <div class="clear"></div>
                
			</div><!-- END div#header -->
		</div><!-- END div#header_wrapper -->
	</div><!-- END div#header_container -->