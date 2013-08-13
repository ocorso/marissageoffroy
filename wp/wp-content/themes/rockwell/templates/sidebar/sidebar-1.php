				<div id="sidebar-1" class="sidebar">
                  <?php
                  if( is_home()  || is_front_page() ) {
                     if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Home Sidebar") ) :
                     endif;
                  }
                  else if( get_cat_type() != 'portfolio' && !is_page() ) {
                     if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) :
                     endif;
                  }
                  else if( get_cat_type() == 'portfolio' && !is_page() ) {
                     if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Portfolio Sidebar") ) :
                     endif;
                  }
                  else if( is_page() && strpos(get_page_template_name(),'gallery')) {
                     if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Gallery Page Sidebar") ) :
                     endif;
                  }
                  else if(  is_page() ) {
                     if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Page Sidebar") ) :
                     endif;
                  }
                   ?>
                  
				</div><!-- END div.sidebar -->
