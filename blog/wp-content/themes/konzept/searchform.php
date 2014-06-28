<form method="get" action="<?php bloginfo('url'); ?>/">

<!-- <textarea value="<?php echo esc_html($s); ?>" name="s" cols="15" rows="2" class="s SearchInput"></textarea> -->
<textarea name="s" cols="15" rows="2" class="s SearchInput"></textarea>
<input type="image" alt="Search" src="<?php bloginfo('template_directory'); ?>/images/search.png" class="search_submit" />

</form>
<div class="search-message"><?php _e('Press Enter to Search', 'flowthemes'); ?></div>