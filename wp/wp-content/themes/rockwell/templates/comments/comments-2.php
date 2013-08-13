<div id="post_comments-2">
<h3 class="comments_number" id="comments">
	<?php comments_number(get_option_text('ff_com2_no'),get_option_text('ff_com2_1'), get_option_text('ff_com2_more')); ?>
</h3>
<?php if ( have_comments() ) : ?>
                     <div id="post_comments">
						<ul id="singlecomments" class="commentlist">
        	               <?php wp_list_comments(array('style' => 'ul', 'callback' => 'rockwell_comments')); ?>
                        </ul>
                    </div><!-- END div#post_commets -->
<?php endif; ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Comments - Reply Form                                         // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
					<div id="comment_form_wrapper">
<div id="respond">
                        <div id="comment_form">                      
                            <div class="comment_form_left">
                                <h3><?php echo get_option('ff_com2_postreply'); ?></h3>
                            </div><!-- END div.comment_form_left -->
                            <div class="comment_form_right">
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
                                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                                    <?php if ( $user_ID ) : ?>

                                    <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
                                    <span class="admin_checker" title="admin" style="display:none;"></span>
                                    <?php else : ?>
                                    <p><input type="text" name="author" id="author" value="" tabindex="1" aria-required='true' />
                                    <label for="author"><small>Name*</small></label></p>

                                    <p><input type="text" name="email" id="email" value="" tabindex="2" aria-required='true' />
                                    <label for="email"><small>Email*</small></label></p>

                                    <p><input type="text" name="url" id="url" value="" tabindex="3" />
                                    <label for="url"><small>Website</small></label></p>
                                    <?php endif; ?>
        
                                    <!--<p><small><strong>XHTML:</strong> You can use these tags: <code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;strike&gt; &lt;strong&gt; </code></small></p>-->
    
                                    <p><textarea name="comment" id="comment" tabindex="4"></textarea></p>
    
                                    <input name="submit" type="submit"  class="submit_comment"  id="submit" tabindex="5" value="<?php echo get_option('ff_com2_send'); ?>" />
                                    <input type='hidden' name='comment_post_ID' value='<?php echo $post->ID; ?>' id='comment_post_ID' />
                                    <input type='hidden' name='comment_parent' id='comment_parent' value='0' />
		                            <div class="cancel-comment-reply">
		                            	<small><?php cancel_comment_reply_link(); ?></small>
		                            </div>
                                    <?php do_action('comment_form', $post->ID); ?>
                                </form>
<?php endif; ?>
                            </div><!-- END div.comment_form_right -->

                            <div class="clear"></div>
                        </div><!-- END div#comment_form -->
					</div><!-- END div#comment_form_wrapper -->
				</div><!-- END div#post_area -->
</div><!--- END div#post_comments-2 -->