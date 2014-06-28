	<div id="header_container">
		<div id="header_wrapper">
		            <div class="menu_navigation_bg_container">
                <div class="menu_navigation_bg_wrapper">
                    <div class="menu_navigation_bg">
                    </div>
                </div>
            </div>
			<div class="header" id="header-3">
                <div class="logo_holder"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_logo(); ?>" alt="<?php echo bloginfo('name'); ?>"/></a></div>

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Navigation                                            // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
				<div id="navigation">
                    <div class="menu-navigation-container">
                        <div class="menu-navigation-color-holder" style="display:none;"></div>
                        <?php wp_nav_menu(array( 'menu'=> 'Navigation', 'walker' => new sub_nav_walker(), 'menu_id'=>'menu-navigation', 'depth'=>2 ));?>
                    </div><!-- END div.menu-navigation-container -->

                </div><!-- END div#navigation -->

                <div class="clear"></div>

			</div><!-- END div#header -->
		</div><!-- END div#header_wrapper -->
	</div><!-- END div#header_container -->
<div class="header-3-push"></div>
