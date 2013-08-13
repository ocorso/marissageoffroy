<?php
if(is_single()){ ?>
<div class="navigation clearfix">
	<div class="alignright older_entries"><?php next_post_link('<div class="older_entries_text">%link </div><div class="older_entries_icon">></div>', __('Next', 'flowthemes')); ?></div>
	<div class="alignleft newer_entries"><?php previous_post_link('<div class="newer_entries_icon"><</div><div class="newer_entries_text"> %link</div>', __('Previous', 'flowthemes')); ?></div>
</div>
<?php }else{
	$prev_link = get_previous_posts_link(__('&laquo; Older Entries'));
	$next_link = get_next_posts_link(__('Newer Entries &raquo;'));
	if($prev_link || $next_link){ ?>
		<div class="navigation clearfix">
			<?php if(function_exists('wp_pagenavi')){ wp_pagenavi(); }else{ ?>
				<?php if($next_link){ ?>
					<div class="alignright older_entries"><?php next_posts_link('<div class="older_entries_text">'.__('Older Entries ', 'flowthemes').'</div><div class="older_entries_icon">></div>'); ?></div>
				<?php } ?>
				<?php if($prev_link){ ?>
					<div class="alignleft newer_entries"><?php previous_posts_link('<div class="newer_entries_icon"><</div><div class="newer_entries_text">'.__(' Newer Entries', 'flowthemes').'</div>'); ?></div>
				<?php } ?>
			<?php } ?>
		</div>
	<?php }
} ?>