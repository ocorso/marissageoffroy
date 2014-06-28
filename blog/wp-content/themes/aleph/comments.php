<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * /comments.php
 * Version of this file : 1.0
 *
 */
?>

<?php

// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
  	<div class="alert alert-info"><?php _e("This post is password protected. Enter the password to view comments.","alephtheme"); ?></div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<?php if ( comments_open() ) : ?>

	<section id="respond" class="respond-form">

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		  	<div class="comments-info">
  				<?php _e("You must be","alephtheme"); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e("logged in","alephtheme"); ?></a> <?php _e("to post a comment","alephtheme"); ?>.
		  	</div>

		<?php else : ?>
		
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="form-vertical" id="commentform">			

    			<?php if ( is_user_logged_in() ) : ?>
					
					<div class="row-fluid clearfix">
						<div class="span1">&nbsp;</div>
						<div class="span2 avatar">						
							<?php
			    			
			        			if ( is_user_logged_in() ) {
			    					global $current_user;
			
			        				get_currentuserinfo();
			        				
									echo get_avatar( $current_user->ID, '28');
									echo '<p class="gloss ttip" title="Logged in as '.$current_user->user_nicename.'"></p>';
			        			
								} else {
									echo get_avatar('', '28');
									echo '<p class="gloss"></p>';
								}
								
							?>	    									
						</div>
						<?php
							global $current_user;
							get_currentuserinfo();
						?>
						<input type="hidden" value="true" id="loggedin" />	
						
						<input type="hidden" value="<?php echo $current_user->display_name; ?>" id="author" />					
						<input type="hidden" value="<?php echo $current_user->user_email; ?>" id="email" />					
						<input type="hidden" value="<?php echo $current_user->user_url; ?>" id="url" />
						<input type="hidden" value="<?php echo $post->ID; ?>" id="id" />	
						<input type="hidden" value="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" id="comment_action" />
	
						<div class="control-group span8">
							<div class="controls">
								<div class="input-append">
									<input name="comment" type="text" id="comment" placeholder="<?php _e("Your Comment Here&hellip;","alephtheme"); ?>" >
									<button class="btn btn-primary" name="comment-submit" type="submit" id="comment-submit" data-loading-text="&hellip;"><i class="icon-pencil icon-white"></i></button>
								</div>
							</div>
						</div>
						<div class="span1 clearfix">&nbsp;</div>
					</div>
						  		
		  			<?php comment_id_fields(); ?>
			
					<div class="info_log"></div>
					<div class="hidden_error"></div>
						    		
    			<?php else : ?>
    				<input type="hidden" value="false" id="loggedin" />	
    				<div class="row-fluid clearfix">
						<div class="span1">&nbsp;</div>
						<div class="span2 avatar">						
							<?php
			    			
			        			if ( is_user_logged_in() ) {
			    					global $current_user;
			
			        				get_currentuserinfo();
			        				
									echo get_avatar( $current_user->ID, '28');
									echo '<p class="gloss ttip" title="Logged in as '.$current_user->user_nicename.'"></p>';
			        			
								} else {
									echo get_avatar('', '28');
									echo '<p class="gloss"></p>';
								}
								
							?>	    									
						</div>					
	    				<div class="control-group span8">
	    					<div class="controls">
	    						<div class="input-append">
	    							<input type="text" name="comment" id="comment" placeholder="<?php _e("Your Comment Here&hellip;","alephtheme"); ?>" >
	    							<input type="hidden" value="<?php echo $post->ID; ?>" id="id" />
	    							<input type="hidden" value="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" id="comment_action" />	
	    							
	    							<button id="comment-submit-temp" class="btn btn-warning"><i class="icon-pencil icon-white"></i></button>
	    							
	    							<button class="btn btn-primary" name="comment-submit" type="submit" id="comment-submit" data-loading-text="&hellip;"><i class="icon-pencil icon-white"></i></button>
									<?php comment_id_fields(); ?>
	    							
	    						</div>
	    					</div>
	    				</div>
	    				<div class="span1 clearfix">&nbsp;</div>
	    			</div>
	    			<div id="comment-fields">
		    			<div class="row-fluid clearfix">	    				
		    				<div class="span1">&nbsp;</div>
		    				<div class="span2">&nbsp;</div>
		    				<div class="control-group span8">
		    					<div class="controls">
		    						<label for="author"><?php _e("Name","alephtheme"); ?> <?php if ($req) echo "(required)"; ?></label>
		    						<div class="input-prepend">
		    							<span class="add-on"><i class="icon-user"></i></span>
		    							<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php _e("Your Name","alephtheme"); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>  />
		    						</div>
		    					</div>
		    				</div>
		    				<div class="span1 clearfix">&nbsp;</div>	    			
		    			</div>
		    			<div class="row-fluid clearfix">	    				
		    				<div class="span1">&nbsp;</div>
		    				<div class="span2">&nbsp;</div>
		    				<div class="control-group span8">
		    					<div class="controls">
		    						<label for="email"><?php _e("Mail","alephtheme"); ?> <?php if ($req) echo "(required)"; ?></label>
		    						<div class="input-prepend">
		    							<span class="add-on"><i class="icon-envelope"></i></span>
		    							<input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e("Your Email","alephtheme"); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>  />
		    							<span class="help-inline">(<?php _e("will not be published","alephtheme"); ?>)</span>
		    						</div>
		    					</div>
		    				</div>
		    				<div class="span1 clearfix">&nbsp;</div>	    			
		    			</div>
		    			<div class="row-fluid clearfix">	    				
		    				<div class="span1">&nbsp;</div>
		    				<div class="span2">&nbsp;</div>
		    				<div class="control-group span8">
		    					<div class="controls">
		    						<label for="url"><?php _e("Website","alephtheme"); ?></label>
		    						<div class="input-prepend">
		    						<span class="add-on"><i class="icon-home"></i></span>
		    							<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e("Your Website","alephtheme"); ?>" tabindex="3" />
		    						</div>
		    					</div>
		    				</div>
		    				<div class="span1 clearfix">&nbsp;</div>	    			
		    			</div>
		    		</div>
												
					<div class="info_log"></div>
					<div class="hidden_error"></div>					    		
    			
    			<?php endif; ?>					
	    		
				<?php 
					//comment_form();
					do_action('comment_form()', $post->ID); 
				
				?>
						
			</form>

		<?php endif; // If registration required and not logged in ?>

	</section>

<?php else : ?>
	<?php if(have_comments()) : ?>
		<div class="comments-info">
			<?php _e("Comments are closed","alephtheme"); ?>.
		</div>
	<?php endif; ?>
<?php endif; // if you delete this the sky will fall on your head ?>

<?php if ( have_comments() ) : ?>

	<div id="comments">
		<div id="comment-loop">
		
			<ol class="commentlist clearfix">
				<div class="loading"></div>
				<div class=""></div>
				<?php wp_list_comments('type=comment&callback=aleph_comments'); ?>
			</ol>
			
			<?php $max_comments = get_option('comments_per_page'); ?>
			<?php $commentscount = get_comments_number('0','1','%'); ?>
			<?php if($commentscount>$max_comments) { ?>		
				<nav id="comment-nav">
					<ul class="clearfix pager">
				  		<li class="previous"><div class="hidden-medium"><?php previous_comments_link( __("<i class='icon-chevron-left'></i>","alephtheme") ) ?></div> <div class="visible-special"><?php previous_comments_link( __("Older comments","alephtheme") ) ?></div></li>
				  		<li class="next"><div class="visible-special"><?php next_comments_link( __("Newer comments","alephtheme") ) ?></div> <div class="hidden-medium"><?php next_comments_link( __("<i class='icon-chevron-right'></i>","alephtheme") ) ?></div></li>
					</ul>
				</nav>
			<?php } ?>	
		</div>
	</div>
  
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
    	<div id="comments">
			<div class=""></div>
			<div id="comment-loop">		
				<ol class="commentlist clearfix"></ol>
			</div>
		</div>
		
	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<div class="comments-info">
			<?php _e("Comments are closed","alephtheme"); ?>.
		</div>

	<?php endif; ?>

<?php endif; ?>