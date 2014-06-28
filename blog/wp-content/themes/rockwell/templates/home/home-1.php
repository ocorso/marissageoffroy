	<div id="home_widget_area_container">
		<div id="home_widget_area_wrapper">
			<div id="home-1">
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Widget                                                // -->
<!-- /////////////////////////////////////////////////////////////////////// --> 
				<div id="home_widget_area">
				<?php
                    $home_widget_count = get_option('ff_home_widget_count');
                    for( $i = 1; $i <= $home_widget_count; $i++ ) {
                        echo '<div class="widget_'.$home_widget_count.'">';
                          if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Home Widget $i") ) :
                          endif;
                        echo '</div><!-- END div.widget_'.$home_widget_count.'-->';

                    }
                ?>

                    <div class="clear"></div>
				</div><!-- END div.home_widget_area -->
			</div><!-- END div#content -->
		</div><!-- END div#home_widget_area_wrapper -->
	</div><!-- END div#home_widget_area_container -->