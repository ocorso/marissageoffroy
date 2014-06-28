<?php
	global $queed_frontend_options; 
	$queed_frontend_options=get_option('queed_theme_options');
?>
<?php function queed_comment($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?>>
    <article id="comment-<?php comment_ID(); ?>" class="cf single_comment">
      <header class="comment-author vcard">
        <?php echo get_avatar($comment, $size = '64'); ?>
      </header>
      <div class="comment_floated">
        <?php printf(__('<cite class="fn author_name">%s</cite>', 'queed'), get_comment_author_link()); ?>
        <div class="simple_line"></div>
        <time datetime="<?php echo comment_date('c'); ?>" class="comment_date">
				<?php 
					echo get_comment_date(); 
					echo " @ ";
					echo get_comment_time(); 
                ?>
       	</time>
        <?php edit_comment_link(__('(Edit)', 'queed'), '', ''); ?>
      

      <?php if ($comment->comment_approved == '0') { ?>
        <div class="alert alert-block fade in">
          <a class="close" data-dismiss="alert">&times;</a>
          <p><?php _e('Your comment is awaiting moderation.', 'queed'); ?></p>
        </div>
      <?php } ?>

      <section class="comment comment_text">
        <?php comment_text() ?>
      </section>

      <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('Reply', 'queed')))); ?>
		</div>
    </article>
<?php } ?>

<?php if (post_password_required()) { ?>
  <section id="comments">
    <div class="alert alert-block fade in">
      <a class="close" data-dismiss="alert">&times;</a>
      <p><?php _e('This post is password protected. Enter the password to view comments.', 'queed'); ?></p>
    </div>
  </section><!-- /#comments -->
<?php
  return;
} ?>

<?php if (have_comments()) { ?>
  <section id="comments">
  	<div class="h3_title">
    	<h3>
			<?php printf(_n(__($queed_frontend_options['comments_one_response'], 'queed').' '.__($queed_frontend_options['comments_on_separator'], 'queed').' &ldquo;%2$s&rdquo;', '%1$s '.__($queed_frontend_options['comments_oneplus_response'], 'queed').' '.__($queed_frontend_options['comments_on_separator'], 'queed'). ' &ldquo;%2$s&rdquo;', get_comments_number(), 'queed'), number_format_i18n(get_comments_number()), get_the_title()); ?>
       	</h3>
	</div>
    <ol class="commentlist">
      <?php wp_list_comments(array('callback' => 'queed_comment')); ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // are there comments to navigate through ?>
      <nav id="comments-nav" class="pager">
        <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'queed')); ?></div>
        <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'queed')); ?></div>
      </nav>

    <?php } // check for comment navigation ?>

    <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) { ?>
      <div class="alert alert-block fade in">
        <p><?php _e($queed_frontend_options['comments_closed'], 'queed'); ?></p>
      </div>
    <?php } ?>
  </section><!-- /#comments -->
<?php } ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) { ?>
  <section id="comments">
    <div class="alert alert-block fade in">
      <p><?php _e($queed_frontend_options['comments_closed'], 'queed'); ?></p>
    </div>
  </section><!-- /#comments -->
<?php } ?>

<?php 
	if (comments_open()) 
	{ 
	?>
  		<section id="respond">
            <h3>
				<?php comment_form_title(__($queed_frontend_options['comments_leave_reply'], 'queed'), __($queed_frontend_options['comments_leave_reply'].' to %s', 'queed')); ?>
           	</h3>
            <p class="cancel-comment-reply"><?php cancel_comment_reply_link(__('Click here to cancel reply', 'queed')); ?></p>
            <?php 
				if (get_option('comment_registration') && !is_user_logged_in()) 
				{ 
					?>
              		<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'queed'), wp_login_url(get_permalink())); ?></p>
            		<?php 
				} 
				else 
				{ 
					?>
              		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="comment_form">
						<?php 
							if (is_user_logged_in()) 
							{ 
								?>
								<p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'queed'), get_option('siteurl'), $user_identity); ?> 
									<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'queed'); ?>"><?php _e('Log out &raquo;', 'queed'); ?></a>
								</p>
								<?php 
							} 
							else 
							{ 
								?>
                                <div class="comment_boxes_wrapper">
                                    <div class="form_name_icon man_icon"></div>
                                    <input type="text" class="text pirenko_highlighted" name="author" id="author" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> 
                                    placeholder="<?php _e($queed_frontend_options['comments_author_text'], 'queed'); if ($req) _e($queed_frontend_options['required_text'], 'queed'); ?>" />
							  	</div>
                                <div class="comment_boxes_wrapper">
                                    <div class="form_name_icon email_icon"></div>
                                    <input type="email" class="text pirenko_highlighted" name="email" id="email" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> 
                                    placeholder="<?php _e($queed_frontend_options['comments_email_text'], 'queed'); if ($req) _e($queed_frontend_options['required_text'], 'queed'); ?>" />		
                                </div>
                                
                                <div class="comment_boxes_wrapper">
                                    <div class="form_name_icon link_icon"></div>
                                    
                                    <input type="url" class="text pirenko_highlighted" name="url" id="url" size="22" tabindex="3" 
                                    placeholder="<?php _e($queed_frontend_options['comments_url_text'], 'queed'); ?>" />
                                </div>
								<?php 
							} 
						?>
                        <textarea name="comment" id="comment" class="input-xlarge pirenko_highlighted" tabindex="4"
                        onfocus="if(this.value=='<?php _e($queed_frontend_options['comments_comment_text'], 'queed'); ?>')this.value=''" 
                        onblur="if(this.value=='')this.value='<?php _e($queed_frontend_options['comments_comment_text'], 'queed'); ?>'" ><?php _e($queed_frontend_options['comments_comment_text'], 'queed'); ?></textarea>
                        <div id="comment_form_messages" class="cf"><?php _e($queed_frontend_options['contact_wait_text'], 'queed'); ?>...</div>
                        <div class="clearfix"> </div>
                        <div id="submit_comment_div" class='theme_button'>
                        	<a href="#"><?php _e($queed_frontend_options['comments_submit'], 'queed'); ?>&nbsp;&rarr;</a>
                      	</div>
                        
                        <?php comment_id_fields(); ?>
                        <?php do_action('comment_form', $post->ID); ?>
              		</form>
            		<?php 
				} 
			?>
  		</section><!-- /#respond -->
		<?php 
	} 
?>
<script type="text/javascript">
jQuery(document).ready(function()
{
	var wordpress_directory = '<?php echo get_option('siteurl'); ?>';
	var empty_text_error = '<?php _e($queed_frontend_options['empty_text_error'], 'queed'); ?>';
	var invalid_email_error = '<?php _e($queed_frontend_options['invalid_email_error'], 'queed'); ?>';
	var comment_ok_message = '<?php _e($queed_frontend_options['comment_ok_message'], 'queed'); ?>';
	var already_submitted_comment=false;
	jQuery('#commentform textarea, #author, #email').focus(function () 
	{
		jQuery("#comment_form_messages").hide("slow");
	});
	jQuery('#submit_comment_div a').click(function(e) 
	{
		empty_error = '<p class="comment_error">' + empty_text_error + '</p>';
        email_error = '<p class="comment_error">' + invalid_email_error + '</p>';
		e.preventDefault();
		error = false;
        emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;	
		if (already_submitted_comment==false)
		{
			jQuery("#comment_form_messages .comment_error").remove();
			//DATA VALIDATION
			jQuery('#commentform textarea, #author, #email').each(function()
			{
				
				value = jQuery(this).val();
				theID = jQuery(this).attr('id');
			
				if(value == '' && error==false)
				{
					jQuery('#comment_form_messages').html('');
					jQuery('#comment_form_messages').append(empty_error);
					error = true;
				}
				if(theID == 'email' && value != '' && !emailReg.test(value) && error==false)
				{
					jQuery('#comment_form_messages').html('');
					jQuery('#comment_form_messages').append('<p class="comment_error">'+email_error+'</p>');
					error = true;
				}
				
			});
			//SEND COMMENT IF THERE ARE NO ERRORS
			if(error == false)
			{
				jQuery("#comment_form_messages").css({'display':'inline-block'});
				//POST COMMENT
				jQuery.ajax({  
				type: "POST",  
				url: wordpress_directory+"/wp-comments-post.php",  
				data: jQuery("#commentform").serialize(),  
				success: function(resp)
				{
					jQuery('#comment_form_messages').html('');
					jQuery('#comment_form_messages').append('<p class="comment_error">'+comment_ok_message+'</p>');
					jQuery("#comment_form_messages").css({'display':'inline-block'});
					already_submitted_comment=true;
				},  
				error: function(e)
				{  
					jQuery('#comment_form_messages').html('');
					jQuery('#comment_form_messages').append('<p class="comment_error">Comment error. Please try again!</p>');
					jQuery("#comment_form_messages").css({'display':'inline-block'});
				}
				});
			}
			else
			{
				jQuery("#comment_form_messages").css({'display':'inline-block'});
				
			}
		}
		else
		{
				
		}
	});
});
	
	</script>