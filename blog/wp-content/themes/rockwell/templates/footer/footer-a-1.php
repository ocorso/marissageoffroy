	<div id="footer1_container">
		<div id="footer1_wrapper">
			<div id="footer1">
            
				<div class="footer1_top_line"></div>      
<?php
                    $footer_widget_count = get_option('ff_footer_widget_count');
                    for($i = 1; $i<= $footer_widget_count; $i++)
                    {
                        echo '<div class="widget_'.$footer_widget_count.'">';
                            if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget '.$i) ) :
                            endif;
                        echo '</div><!-- END div.widget_'.$footer_widget_count.' -->';
                    }
?>
<?php /*
				<div class="widget_8">
					<div class="footer_widget">   
					<img src="gfx/logo-footer.png">
					</div>
				</div><!-- END div.widget_8 -->
                
				<div class="widget_8"></div>
                
				<div class="widget_8">   
					<div class="footer_widget">           
                        <h2>Contacts</h2>
                        <ul>
							<li><a href="#">Contacts</a></li>
							<li><a href="#">Company</a></li>
							<li><a href="#">People</a></li>
							<li><a href="#">We are hiring</a></li>
							<li><a href="#">Contacts</a></li>
							<li><a href="#">Company</a></li>
						</ul>
					</div><!-- END div.footer_widget -->
				</div><!-- END div.widget_8 -->
                
                <div class="widget_8">
					<div class="footer_widget">           
                        <h2>Contacts</h2>
						<ul>
							<li><a href="#">Contacts</a></li>
							<li><a href="#">Company</a></li>
							<li><a href="#">People</a></li>
							<li><a href="#">We are hiring</a></li>
							<li><a href="#">Contacts</a></li>
							<li><a href="#">Company</a></li>
						</ul>
					</div><!-- END div.footer_widget -->
				</div><!-- END div.widget_8 -->
                
				<div class="widget_8">
					<div class="footer_widget">           
                        <h2>Contacts</h2>
                        <ul>
							<li><a href="#">Contacts</a></li>
							<li><a href="#">Company</a></li>
							<li><a href="#">People</a></li>
							<li><a href="#">We are hiring</a></li>
							<li><a href="#">Contacts</a></li>
							<li><a href="#">Company</a></li>
						</ul>
					</div><!-- END div.footer_widget -->
				</div><!-- END div.widget_8 -->

				<div class="widget_8">
					<div class="footer_widget">           
						<h2>Contacts</h2>
						<ul>
                            <li><a href="#">Contacts</a></li>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">People</a></li>
						</ul>
					</div><!-- END div.footer_widget -->
                    <div class="footer_widget">           
                        <h2>Contacts</h2>
                        <ul>
                            <li><a href="#">Contacts</a></li>
                            <li><a href="#">Company</a></li>
                        </ul>
					</div><!-- END div.footer_widget -->
				</div><!-- END div.widget_8 -->

				<div class="widget_8">
					<div class="footer_widget">           
                        <h2>Contacts</h2>
                        <ul>
							<li><a href="#">Contacts</a></li>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">People</a></li>
                            <li><a href="#">We are hiring</a></li>
                            <li><a href="#">Contacts</a></li>
                            <li><a href="#">Company</a></li>
						</ul>
					</div><!-- END div.footer_widget -->
				</div><!-- END div.widget_8 -->
                    
				<div class="widget_8">
					<div class="footer_widget">           
                        <h2>Contacts</h2>
                        <ul>
                            <li><a href="#">Contacts</a></li>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">People</a></li>
                            <li><a href="#">We are hiring</a></li>
                            <li><a href="#">Contacts</a></li>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">People</a></li>
						</ul>
					</div><!-- END div.footer_widget -->
				</div><!-- END div.widget_8 -->
 */?>
                <div class="clear"></div>
          
            </div><!-- END div#footer1 -->
        </div><!-- END div#footer1_wrapper -->
    </div><!-- END div#footer1_container -->