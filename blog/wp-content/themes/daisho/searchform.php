<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
		<!-- <label class="screen-reader-text" for="s"><?php //_e('Search for:', 'flowthemes'); ?></label> -->
        <input type="text" value="" placeholder="<?php _e('Search...', 'flowthemes'); ?>" name="s" id="sidebar-search-input" />
        <input type="submit" id="searchsubmit" value="&#xf002;" class="sidebar-search-submit" />
    </div>
</form>