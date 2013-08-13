<?php
 /*
Template Name: Page-contact-sidebar-right
*/ ?>
<?php get_header();
$status = "";
$recaptcha_check = recaptcha_check();
$recaptcha_message = null;
if(isset($_POST['cf_contact']) && $recaptcha_check )
{
  $email_adress_where_send = $lcp_cf_yourmail;
  if(!class_exists('PHPMailer') ) require_once ABSPATH . WPINC . '/class-phpmailer.php';
//  include "scripts/class.phpmailer.php";
  $mail = new PHPMailer();
    $mail->IsMail();
    $mail->IsHTML(true);
    $mail->CharSet  = "utf-8";
    $mail->From     = $_POST['cf_email'];
    $mail->FromName = $_POST['cf_author'];
    $mail->WordWrap = 50;
    $mail->Subject  =  get_option('ff_contact_subject');
    $mail->Body     =  'url:'.$_POST['cf_url'].' <br><br> '.$_POST['cf_contact']; //
    $mail->AddAddress( get_option('ff_contact_youremail') );
    $mail->AddReplyTo($_POST['cf_email']);
  if(!$mail->Send()) {  // send e-mail
    $status =  get_option('ff_contact_bad');
  }
  else
  {
     $status =  get_option('ff_contact_ok');
  }
}
else if(isset($_POST['cf_contact']) && !$recaptcha_check ) {
	$recaptcha_message = get_option('ff_contact_recaptcha_message');
}
?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Container                                             // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
	<div id="content_container">
		<div id="content_wrapper">
<div class="content" id="page-right-sidebar">

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Post                                                  // -->
<!-- /////////////////////////////////////////////////////////////////////// -->
				<div id="post_area">
                    <div id="post_wrapper">
<?php if (  $wp_query->have_posts()) : while (have_posts()) : the_post();  ?>

<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Entry                                                 // -->
<!-- /////////////////////////////////////////////////////////////////////// -->


                        <div class="entry"  id="post-<?php the_ID();?>">
                            <?php if(get_post_meta( $post->ID, 'hide_title', true) != true ){?><h1 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><?php } ?>
                            <div class="post_content">
                                <?php
                                if(!empty($post->post_excerpt)) {
                                    the_excerpt();
                                }
                                else
                                {
                                    the_content(get_option('ff_translate_readmore'));
                                }
                                ?>
                                

                            </div><!-- END div.post_content -->
                            

              <div class="clear"></div>
          </div><!-- END div.entry -->
<?php endwhile; endif;?>

                    </div><!-- END div#post_wrapper -->
                    <?php if($status !="") echo $status;
                    else
                    { ?>
					<div id="contact_form_wrapper">
                        <div id="respond">
                            <div id="contact_form">
                                <div class="contact_form_left">
                                    <h2><?php echo get_option('ff_contact_desc'); ?></h2>
                                </div><!-- END div.contact_form_left -->
                                <div class="contact_form_right">
                                    <form action="" method="post" id="contactform">

                                        <p><input type="text" name="cf_author" id="cf_author" value="" tabindex="1" aria-required='true' />
                                        <label for="author"><small><?php echo get_option('ff_contact_name'); ?></small></label></p>

                                        <p><input type="text" name="cf_email" id="cf_email" value="" tabindex="2" aria-required='true' />
                                        <label for="email"><small><?php echo get_option('ff_contact_email'); ?></small></label></p>

                                        <p><input type="text" name="cf_url" id="cf_url" value="" tabindex="3" />
                                        <label for="url"><small><?php echo get_option('ff_contact_website'); ?></small></label></p>


                                        <!--<p><small><strong>XHTML:</strong> You can use these tags: <code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;strike&gt; &lt;strong&gt; </code></small></p>-->

                                        <p><textarea name="cf_contact" id="cf_contact" tabindex="4"></textarea></p>
                                        
                                        <?php echo $recaptcha_message; recaptcha_print(); ?>
                                        

                                        <input name="submit" type="submit"  class="submit_contact"  id="submit" tabindex="5" value="<?php echo get_option('ff_contact_send'); ?>" />
                                    </form>

                                </div><!-- END div.contact_form_right -->

                                <div class="clear"></div>
                            </div><!-- END div#contact_form -->
    					</div><!-- END div#respond -->
				    </div><!-- END div#contact_form_wrapper -->
                    <?php } ?>
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Comments                                              // -->
<!-- /////////////////////////////////////////////////////////////////////// -->

				</div><!-- END div#post_area -->
<!-- /////////////////////////////////////////////////////////////////////// -->
<!-- //             Sidebar                                               // -->
<!-- /////////////////////////////////////////////////////////////////////// -->

<?php require_once(get_template_dir()."/templates/sidebar/sidebar-1.php") ?>
                <div class="clear"></div>
			</div><!-- END div#content -->
		</div><!-- END div#content_wrapper -->
	</div><!-- END div#content_container -->
<?php get_footer(); ?>