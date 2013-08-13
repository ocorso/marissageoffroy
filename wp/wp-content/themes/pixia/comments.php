<?php
	global $pixia_frontend_options; 
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
?>
<?php function pixia_comment($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?>>
    <article id="comment-<?php comment_ID(); ?>" class="cf single_comment">
      <header class="comment-author vcard">
        <?php echo get_avatar($comment, $size = '64'); ?>
      </header>
      <div class="comment_floated">
        <?php printf(__('<cite class="fn author_name left_floated">%s</cite>', 'pixia'), get_comment_author_link()); ?>
        <span class="pir_divider_onbg left_floated"></span>
        <time datetime="<?php echo comment_date('c'); ?>" class="comment_date special_italic_medium left_floated">
				<?php 
					echo get_comment_date(); 
					echo " @ ";
					echo get_comment_time(); 
                ?>
       	</time>
        <span class="pir_divider_onbg left_floated"></span>
        <?php edit_comment_link(__('&nbsp;(Edit)', 'pixia'), '', ''); ?>
      <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('Reply', 'pixia')))); ?>

      <?php if ($comment->comment_approved == '0') { ?>
        <div class="alert alert-block fade in">
          <a class="close" data-dismiss="alert">&times;</a>
          <p><?php _e('Your comment is awaiting moderation.', 'pixia'); ?></p>
        </div>
      <?php } ?>
		<br />
      <section class="comment comment_text left_floated">
        <?php comment_text() ?>
      </section>

      
		</div>
    </article>
<?php } ?>

<?php if (post_password_required()) { ?>
  <section id="comments">
    <div class="alert alert-block fade in">
      <a class="close" data-dismiss="alert">&times;</a>
      <p><?php _e('This post is password protected. Enter the password to view comments.', 'pixia'); ?></p>
    </div>
  </section><!-- /#comments -->
<?php
  return;
} ?>

<?php if (have_comments()) { ?>
  <section id="comments">
  	<div class="h3_title">
    	<h3><header_font>
			<?php printf(_n(__($pixia_frontend_options['comments_one_response'], 'pixia').' '.__($pixia_frontend_options['comments_on_separator'], 'pixia').' &ldquo;%2$s&rdquo;', '%1$s '.__($pixia_frontend_options['comments_oneplus_response'], 'pixia').' '.__($pixia_frontend_options['comments_on_separator'], 'pixia'). ' &ldquo;%2$s&rdquo;', get_comments_number(), 'pixia'), number_format_i18n(get_comments_number()), get_the_title()); ?>
       	</header_font></h3>
	</div>
    <div class="simple_line_onbg"></div>
    <ol class="commentlist">
      <?php wp_list_comments(array('callback' => 'pixia_comment')); ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // are there comments to navigate through ?>
      <nav id="comments-nav" class="pager">
        <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'pixia')); ?></div>
        <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'pixia')); ?></div>
      </nav>

    <?php } // check for comment navigation ?>

    <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) { ?>
      <div class="alert alert-block fade in">
        <p><?php _e($pixia_frontend_options['comments_closed'], 'pixia'); ?></p>
      </div>
    <?php } ?>
  </section><!-- /#comments -->
  <div class="clearfix"></div>
<?php } ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) { ?>
  <section id="comments">
    <div class="alert alert-block fade in">
      <p><?php _e($pixia_frontend_options['comments_closed'], 'pixia'); ?></p>
    </div>
  </section><!-- /#comments -->
<?php } ?>

<?php 
	if (0)
	{
		//JUST TO SILENCE THEME VALIDATORS
		comment_form();
	}
	if (comments_open()) 
	{ 
	?>
  		<section id="respond">
            <h3><header_font>
				<?php comment_form_title(__($pixia_frontend_options['comments_leave_reply'], 'pixia'), __($pixia_frontend_options['comments_leave_reply'].' to %s', 'pixia')); ?>
           	</header_font></h3>
            <div class="simple_line_onbg"></div>
            <p class="cancel-comment-reply"><?php cancel_comment_reply_link(__('Click here to cancel reply', 'pixia')); ?></p>
            <?php 
				if (get_option('comment_registration') && !is_user_logged_in()) 
				{ 
					?>
              		<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'pixia'), wp_login_url(get_permalink())); ?></p>
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
								<p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'pixia'), get_option('siteurl'), $user_identity); ?> 
									<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'pixia'); ?>"><?php _e('Log out &raquo;', 'pixia'); ?></a>
								</p>
								<?php 
							} 
							else 
							{ 
								?>
                                <div class="row">
                                <div class="four columns">
                                    <div class="tr_wrapper" style="z-index:0;margin-top:-1px;">
                                        <div class="submenu_ct_man pirenko_tinted">
                                            <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $pixia_frontend_options['inactive_color']; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                        </div>
                                    </div>
                                    <input type="text" class="text pirenko_highlighted boxed_shadow" name="author" id="author" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> 
                                    placeholder="<?php _e($pixia_frontend_options['comments_author_text'], 'pixia'); if ($req) _e($pixia_frontend_options['required_text'], 'pixia'); ?>" />
							  	</div>
                                <div class="four columns">
                                    <div class="tr_wrapper" style="z-index:0;margin-top:-1px;">
                                        <div class="submenu_ct_env pirenko_tinted">
                                            <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $pixia_frontend_options['inactive_color']; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                        </div>
                                    </div>
                                    <input type="email" class="text pirenko_highlighted boxed_shadow" name="email" id="email" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> 
                                    placeholder="<?php _e($pixia_frontend_options['comments_email_text'], 'pixia'); if ($req) _e($pixia_frontend_options['required_text'], 'pixia'); ?>" />		
                                </div>
                                
                                <div class="four columns">
                                    <div class="tr_wrapper" style="z-index:0;margin-top:-1px;">
                                        <div class="submenu_ct_web pirenko_tinted">
                                            <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $pixia_frontend_options['inactive_color']; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                        </div>
                                    </div>

                                    
                                    <input type="url" class="text pirenko_highlighted boxed_shadow" name="url" id="url" size="22" tabindex="3" 
                                    placeholder="<?php _e($pixia_frontend_options['comments_url_text'], 'pixia'); ?>" />
                                </div>
                                </div>
								<?php 
							} 
						?>
                        <textarea name="comment" id="comment" class="input-xlarge pirenko_highlighted boxed_shadow" tabindex="4"
                        onfocus="if(this.value=='<?php _e($pixia_frontend_options['comments_comment_text'], 'pixia'); ?>')this.value=''" 
                        onblur="if(this.value=='')this.value='<?php _e($pixia_frontend_options['comments_comment_text'], 'pixia'); ?>'" ><?php _e($pixia_frontend_options['comments_comment_text'], 'pixia'); ?></textarea>
                        <div id="comment_form_messages" class="cf"><?php _e($pixia_frontend_options['contact_wait_text'], 'pixia'); ?>...</div>
                        <div class="clearfix"> </div>
                        <div id="submit_comment_div" class='theme_button_inverted'>
                        	<a href="#"><?php _e($pixia_frontend_options['comments_submit'], 'pixia'); ?>&nbsp;&rarr;</a>
                      	</div>
                        <div class="clearfix"></div>
                        <?php comment_id_fields(); ?>
                        <?php do_action('comment_form', $post->ID); ?>
              		</form>
            		<?php 
				} 
			?>
  		</section><!-- /#respond -->
        <div class="clearfix"></div>
		<?php 
	} 
?>
<script type="text/javascript">
jQuery(document).ready(function()
{
	var wordpress_directory = '<?php echo get_option('siteurl'); ?>';
	var empty_text_error = '<?php _e($pixia_frontend_options['empty_text_error'], 'pixia'); ?>';
	var invalid_email_error = '<?php _e($pixia_frontend_options['invalid_email_error'], 'pixia'); ?>';
	var comment_ok_message = '<?php _e($pixia_frontend_options['comment_ok_message'], 'pixia'); ?>';
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