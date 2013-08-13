<?php 
if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
	die('Please do not load this page directly. Thanks!');
	/* die(_x('Please do not load this page directly. Thanks!', 'Comments template', 'flowthemes')); // Can not translate that */
}
if(post_password_required()){
	_ex('This post is password protected. Enter the password to view comments.', 'Comments template', 'flowthemes');
	return;
}
?>

<?php if(have_comments()){ ?>
	<div id="comments" class="clearfix">
		<h2><?php printf(_n('One Comment', '%s Comments', get_comments_number(), 'flowthemes'), number_format_i18n(get_comments_number())); ?></h2>
		<a href="#commentform" class="post-comment-link"><?php //_ex('Post Comment', 'Link that goes to comment form', 'flowthemes'); ?><?php _e('Post Comment', 'flowthemes'); ?></a>
	</div>
		
    <ul class="commentlist">
		<?php wp_list_comments('type=comment&avatar_size=60&callback=flowthemes_konzept_comment'); get_comment_date(''); ?>
	</ul>
	
	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')){ /* are there comments to navigate through */ ?>
		<nav id="comment-nav-below" class="clearfix">
			<div class="comment-nav-older alignright"><?php previous_comments_link(sprintf(_x('<div class="comment-nav-older-text">Older Comments</div> %s', 'previous comments page link - do not modify HTML', 'flowthemes'), '<div class="comment-nav-older-arrow">></div>')); ?></div>
			<div class="comment-nav-newer alignleft"><?php next_comments_link(sprintf(_x('%s <div class="comment-nav-newer-text">Newer Comments</div>', 'next comments page link - do not modify HTML', 'flowthemes'), '<div class="comment-nav-newer-arrow"><</div>')); ?></div>
		</nav>
	<?php } ?>
    
<?php }else{ /* this is displayed if there are no comments yet */ ?>
	<?php if($post->comment_status == 'open'){ ?>
		<div class="no-comments"><?php _e('There are no comments yet, add one below.', 'flowthemes'); ?></div>
    <?php }else if(!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')){ /* if comments are closed */ ?>
		<!-- <p class="commentsclosed"><?php //_e('Comments are closed.', 'flowthemes'); ?></p> -->
	<?php }else{ ?>
    <?php } ?>
<?php } ?>


<?php if('open' == $post->comment_status){ /* comments are opened */ ?>

     <div id="respond" class="clearfix">
    
        <?php if(get_option('comment_registration') && !$user_ID){ /* comments are for registered users only */ ?>
		
		<div class="comments-login-required">
			<?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'flowthemes'), get_bloginfo('url') . '/wp-login.php?redirect_to=' . get_permalink()); ?>
		</div>
    
        <?php }else{ /* comments are for registered and not registered users */ ?>
		
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			
				<?php comment_id_fields(); ?>
				
				<?php if($user_ID){ /* user is logged in, $user_ID and $user_identity should be here */ ?>
					<div class="comments-logged-in"><?php //printf(_x('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Logout</a>.', 'Comments template', 'flowthemes'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity, get_option('siteurl') . '/wp-login.php?action=logout') ?><?php printf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Logout</a>.', 'flowthemes'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity, get_option('siteurl') . '/wp-login.php?action=logout') ?></div>
				<?php }else{ /* user is not logged in */ ?>
				<div class="respond-left-column">
					<label for="author">
						<?php //_ex('Name', 'Comment form name field label', 'flowthemes'); ?><?php _e('Name', 'flowthemes'); ?><?php if($req){ _ex(' *', 'Required field symbol in comment form', 'flowthemes'); } ?>
					</label>
					<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" class="input" size="50" placeholder="<?php //_ex('Name', 'Comment form name field label', 'flowthemes'); ?><?php _e('Name', 'flowthemes'); ?><?php if($req){ _ex(' *', 'Required field symbol in comment form', 'flowthemes'); } ?>" />
					<label for="email">
						<?php //_ex('Email', 'Comment form email field label', 'flowthemes'); ?><?php _e('Email', 'flowthemes'); ?><?php if($req){ _ex(' *', 'Required field symbol in comment form', 'flowthemes'); } ?>
					</label>
					<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="50" class="input" placeholder="<?php //_ex('Email', 'Comment form email field label', 'flowthemes'); ?><?php _e('Email', 'flowthemes'); ?><?php if($req){ _ex(' *', 'Required field symbol in comment form', 'flowthemes'); } ?>" />
					<label for="url">
						<?php //_ex('Website', 'Comment form website field label', 'flowthemes'); ?><?php _e('Website', 'flowthemes'); ?>
					</label>
					<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="50"  class="input" placeholder="<?php _ex('Website', 'Comment form website field label', 'flowthemes'); ?>" />
				</div>
				<?php } ?>
				
				<div class="respond-right-column <?php if($user_ID){ ?>respond-right-column-full<?php } ?>">
					<div class="clearfix">
						<label for="comment"><?php //_ex('Comment', 'Comment form textarea label', 'flowthemes'); ?><?php _e('Comment', 'flowthemes'); ?></label>
						<textarea name="comment" id="data" cols="10" rows="6" tabindex="4" placeholder="<?php //_ex('Comment', 'Comment form textarea label', 'flowthemes'); ?><?php _e('Comment', 'flowthemes'); ?>"></textarea>
					</div>
					<div class="clearfix">
						<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'flowthemes'); ?>" />
						<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
					</div>
				</div>
				
				<?php do_action('comment_form', $post->ID); ?>
				
			</form>
			
			<div id="cancel-comment-reply">
				<small><?php cancel_comment_reply_link() ?></small>
			</div>

		<?php } ?>
	</div>
<?php } ?>