<?php 
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) {
	_e('This post is password protected. Enter the password to view comments.', 'flowthemes');
	return;
}
?>

<?php if ( have_comments() ) : ?>
	<div id="comments" class="clearfix"><h3><?php comments_number('No Comments', 'One Comment', '% Comments' );?></h3><a href="#commentform" class="post-comment-link"><?php echo __('Post Comment', 'flowthemes'); ?></a></div>
     
    <ul class="commentlist">
		<?php wp_list_comments('type=comment&avatar_size=60&callback=flowthemes_konzept_comment'); get_comment_date(''); ?>
	</ul>
	
   <!--<h3 id="trackbacks">Trackbacks and Pingbacks</h3>

	<ul class="commentlist">
		<?php //wp_list_comments('type=pings'); ?>
	</ul>-->

     
    <!--<div class="navigation">
        <div class="alignleft"><?php //previous_comments_link() ?></div>
        <div class="alignright"><?php //next_comments_link() ?></div>
    </div>-->
    
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ($post->comment_status == 'open') : ?>
		<div class="no-comments"><?php _e('There are no comments yet, add one below.', 'flowthemes'); ?></div>
    <?php else : ?>
		<!--<p><?php //_e('Comments are closed.', 'flowthemes'); ?></p>-->
    <?php endif; ?>

<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

     <div id="respond" class="clearfix">   
        <?php /* <div class="separator"></div> */ ?>
    
        <!--<h3><?php //comment_form_title( 'Leave a Comment', 'Leave a Reply to %s' ); ?></h3>-->
        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p><?php _e('You must be', 'flowthemes'); ?> <a href="<?php bloginfo('url'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in', 'flowthemes'); ?></a> <?php _e('to post a comment.', 'flowthemes'); ?></p>
    
        <?php else : ?>
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
            
            <?php comment_id_fields(); ?>
            
            <?php if ( $user_ID ) : ?>
    
                <p><?php _e('Logged in as', 'flowthemes'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e('Logout', 'flowthemes'); ?></a>.</p>
            <?php else : ?>

			<div class="respond-left-column">
			
				<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" class="input" size="50" /><label for="author"><?php _e('Name', 'flowthemes'); ?> <?php if ($req) echo "*"; ?></label>
    
				<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="50" class="input" /><label for="email"><?php _e('Email', 'flowthemes'); ?> <?php if ($req) echo "*"; ?></label>
    
				<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="50"  class="input"/><label for="url"><?php _e('Website', 'flowthemes'); ?></label>
				
			</div>

            <?php endif; ?>
            
			<div class="respond-right-column <?php if ( $user_ID ) : ?>respond-right-column-full<?php endif; ?>">
			
				<p><label for="comment"><?php _e('Comment', 'flowthemes'); ?></label>
				<textarea name="comment" id="data" cols="10" rows="6" tabindex="4"></textarea></p>
    
				<p class="clearfix"><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'flowthemes'); ?>" />
				<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>
			
			</div>
			
            <?php do_action('comment_form', $post->ID); ?>
    
        </form>
        
        <div id="cancel-comment-reply">
			<small><?php cancel_comment_reply_link() ?></small>
    	</div>

<?php endif; ?>
	</div>
<?php endif; ?>