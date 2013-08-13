<?php
add_action( 'widgets_init', 'freshcontact_load_widgets' );
function freshcontact_load_widgets()
{
    register_widget( 'FreshContact_Widget' );
   register_widget( 'widget_fresh_recent_posts' );

}
#-----------------------------------------------------------------
# Recent Post Widget
#-----------------------------------------------------------------

// Recent Post Class
//................................................................
class widget_fresh_recent_posts extends WP_Widget {

    function widget_fresh_recent_posts() {
		global $themeTitle;
		$options = array('classname' => 'widget_fresh_recent_posts', 'description' => __( "Theme styled recent posts with optional preview image.") );
		$controls = array('width' => 250, 'height' => 200);
		$this->WP_Widget('recentposts', __('Rockwell - Recent Post'), $options, $controls);
    }

    function widget($args, $instance) {
		global $wpdb, $shortname;
        extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);

		// Sub-Title
		if ( !empty($instance['subtitle']) ) {
			$subtitle = '<span>'. stripslashes($instance['subtitle']) .'</span>';
		}

		// number of posts to show
		if ( !$number = (int) $instance['number'] ) {
			$number = 3;	// default
		}else if ( $number < 1 ) {
			$number = 1;	// minimum
		}else if ( $number > 15 ) {
			$number = 15;	// maximum
		}

		// length of content description
		if ( !$excerpt = (int) $instance['excerpt'] ) {
			$excerpt = 12;	// default
		}else if ( $excerpt < 0 ) {
			$excerpt = 0;	// minimum
		}else if ( $excerpt > 55 ) {
			$excerpt = 55;	// maximum
		}

		$disable_thumb = false;// $instance['disable_thumb'] ? '1' : '0';
        $categories = $instance['categories'];
		// setup post query
         $args = array(
            'numberposts'     => $number,
            'offset'          => 0,

            'category'         => $categories );
		

		$posts = get_posts($args);

		echo $before_widget;
		echo $before_title . $title . $subtitle . $after_title;

		if($posts){ ?>
		<ul class="fresh_recent_posts">
			<?php
			foreach($posts as $post){
				setup_postdata($post);
				$post_title = stripslashes($post->post_title);
				$permalink = get_permalink($post->ID);
				$post_image = get_resized_image(get_post_image($post->ID), 40,40);
				$post_time =  get_the_time(get_option('ff_translate_date'),$post->ID);
			//	$post_image = showImage(64, 64, $post_title, 'small', $post);
				?>
			<li>
				<?php if ( get_post_image($post->ID) != '' ) { ?>
					<a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>" class="fresh_recent_posts_image_wrapper"><img src="<?php echo $post_image; ?>" class="fresh_recent_posts_image"  alt=""/></a>
				<?php } ?>
				<a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>" class="fresh_recent_posts_title"><?php echo $post_title; ?></a>
                <?php if($instance['show_date']) { ?> <span class="fresh_recent_posts_date"><?php echo $post_time;?></span> <?php } ?>
                <div class="clear"></div>
            </li>
				<?php
			} // end foreach ?>
		</ul>
		<div class="clear"></div>
			<?php
		} // end IF ($posts)

		echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['categories'] =   $new_instance['categories'];
		$instance['number'] = (int) $new_instance['number'];
		$instance['excerpt'] = (int) $new_instance['excerpt'];
		$instance['disable_thumb'] = !empty($new_instance['disable_thumb']) ? 1 : 0;
        $instance['show_date'] = !empty($new_instance['show_date']) ? 1 : 0;
        return $instance;
    }

    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$subtitle = isset($instance['subtitle']) ? esc_attr($instance['subtitle']) : '';
		$disable_thumb = isset( $instance['disable_thumb'] ) ? (bool) $instance['disable_thumb'] : false;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] ) {
			$number = 3;	// set default
		}
		if ( !isset($instance['categories']) || !$categories = $instance['categories'] ) {
			$categories = '';	// set default
		}
		
		if ( !isset($instance['excerpt']) || !$excerpt = (int) $instance['excerpt'] ) {
			$excerpt = 12;	// set default
		}
		if ( !isset($instance['show_date']) || $instance['show_date'] ==1 ) {
			$show_date = 'checked="checked"';	// set default
		}
		

        ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Include Categories (e.g. 10,15,25) or exclude (e.g. -10,-15,-25)</label>
			<input class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" type="text" value="<?php echo $categories; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">Number of recent posts to show:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('show_date'); ?>">Show post date:</label>
			<input type="checkbox" id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" type="text" <?php echo $show_date; ?> />
		</p>

        <?php
    }

}
////////////////////////////////////////////////////////////////////////////////
// FRESHCONTACT WIDGET
////////////////////////////////////////////////////////////////////////////////


class FreshContact_Widget extends WP_Widget {
  function FreshContact_Widget()
  {
    /* Widget settings. */
		$widget_ops = array( 'classname' => 'freshcontact', 'description' => __('Custom contact form and social widget by freshface', 'examplesss') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 850, 'id_base' => 'freshcontact-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'freshcontact-widget', __('FreshContact', 'example'), $widget_ops, $control_ops );
  }
  function widget( $args, $instance )
  {

		$recaptcha_check = recaptcha_check();
		$recaptcha_message = null;

		extract( $args );
    	$title = apply_filters('widget_title', $instance['title'] );
  		$email = $instance['email'];
  		$subject = $instance['subject'];
  		$description = $instance['description'];
  		$sendtxt = $instance['sendtxt'];

 // 		$show_sex = isset( $instance['show_sex'] ) ? $instance['show_sex'] : false;

 echo $before_widget;

    ?>
    <?php echo $before_title.$title.$after_title.$description;

    if($_POST['fc_send_email'] == 1 && $recaptcha_check)
      {
      
    //   	echo 'kokot';
      //  	require_once "class.phpmailer.php";
        //	echo 'kokot';
       /* $email_adress_where_send = $lcp_cf_yourmail;
        $mail = new PHPMailer();
          $mail->IsMail();
          $mail->IsHTML(true);
          $mail->CharSet  = "utf-8";
          $mail->From     = $_POST['fc_email'];
          $mail->FromName = $_POST['fc_name'];
          $mail->WordWrap = 50;
          $mail->Subject  =  $_POST['fc_user_subject'];

          $mail->Body     =  $_POST['fc_text']; //
          $mail->AddAddress( $_POST['fc_user_email'] );
          $mail->AddReplyTo($_POST['fc_email']);
          $to      = 'nobody@example.com';
$subject = 'the subject';
$message = 'hello';

           */
          $headers = 'From: '.$_POST['fc_email'] . "\r\n" .
              'Reply-To: '.$_POST['fc_email'] . "\r\n" .
              'X-Mailer: PHP/' . phpversion();
          $email_subject = 'Name:'.$_POST['fc_name']."\r\n".'Email:'.$_POST['fc_email']."\r\n".$_POST['fc_text'];
          $mail_result = mail($_POST['fc_user_email'], $_POST['fc_user_subject'],$email_subject , $headers);

          if(!$mail_result) {  // send e-mail
            $status =   get_option('ff_contact_bad');
          }
          else
          {
             $status =  get_option('ff_contact_ok');
          }
          echo $status;
      }

      else if($instance['show_contact'] == 'true')
      {
      
            if( $_POST['fc_send_email'] == 1 && !$recaptcha_check ) {
			$recaptcha_message = get_option('ff_contact_recaptcha_message');
			}
    ?>


    			<form action="" id="widget_contact" method="post">
    				<p><input type="text" name="fc_name" id="fc_name" /><label for="fc_name">Name*</label></p>
    				<p><input type="text" name="fc_email" id="fc_email" /><label for="fc_name">E-Mail*</label></p>
    				<p><textarea cols="10" id="fc_text" name="fc_text" rows="10"></textarea></p>
    			  <p style="display:none;"><input type="hidden" name="fc_send_email" value= "1" /></p>
    				<p style="display:none;"><input type="hidden" name="fc_user_email" value="<?php echo $email; ?>" /></p>
    				<p style="display:none;"><input type="hidden" name="fc_user_subject" value="<?php echo $subject; ?>" /></p>
    			
    				<?php echo $recaptcha_message; recaptcha_print(); ?>
    				
    				<p><input type="submit" value="<?php echo $sendtxt; ?>" tabindex="5" id="fc_submit" class="btn_b" name="fc_submit" /></p>
    			</form>


    <?php
     /*
       http://www.facebook.com/sharer.php?u=www.pokus.com&t=pokus
     */
    }

   if($instance['show_social'] == 'true')
   {
    echo '<div id="widget_social">';
    if($instance['twitter'] !='') echo '<a href="'.$instance['twitter'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/twitter.png" alt="twitter" /></a>';
    if($instance['facebook'] !='') echo '<a href="'.$instance['facebook'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/facebook.png" alt="facebook" /></a>';
    if($instance['linkedin'] !='') echo '<a href="'.$instance['linkedin'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/linkedin.png" alt="linkedin" /></a>';
    if($instance['stumbleupon'] !='') echo '<a href="'.$instance['stumbleupon'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/stumbleupon.png" alt="stumbleupon" /></a>';
    if($instance['tumbler'] !='') echo '<a href="'.$instance['tumbler'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/tumblr.png" alt="tumbler" /></a>';
    if($instance['flickr'] !='') echo '<a href="'.$instance['flickr'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/flickr.png" alt="flickr" /></a>';
    if($instance['delicious'] !='') echo '<a href="'.$instance['delicious'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/delicious.png" alt="delicious" /></a>';
    if($instance['rss'] !='') echo '<a href="'.$instance['rss'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/rss.png" alt="rss" /></a>';
    if($instance['emailurl'] !='') echo '<a href="'.$instance['emailurl'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/email.png" alt="emailurl" /></a>';
    if($instance['youtube'] !='') echo '<a href="'.$instance['youtube'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/youtube.png" alt="youtube" /></a>';
    if($instance['vimeo'] !='') echo '<a href="'.$instance['vimeo'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/vimeo.png" alt="vimeo" /></a>';
    if($instance['msn'] !='') echo '<a href="'.$instance['msn'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/msn.png" alt="msn" /></a>';
    if($instance['skype'] !='') echo '<a href="'.$instance['skype'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/skype.png" alt="skype" /></a>';
    if($instance['mobileme'] !='') echo '<a href="'.$instance['mobileme'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/mobileme.png" alt="mobileme" /></a>';

    echo '<div class="clear"></div></div>';
    }
   echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] =  $new_instance['title'];
		$instance['email'] =  $new_instance['email'];

		/* No need to strip tags for sex and show_sex. */
		$instance['subject'] = $new_instance['subject'];
    $instance['description'] = $new_instance['description'];
     $instance['sendtxt'] = $new_instance['sendtxt'];
    		$instance['twitter'] = $new_instance['twitter'];
    $instance['facebook'] = $new_instance['facebook'];
    		$instance['linkedin'] = $new_instance['linkedin'];
    $instance['stumbleupon'] = $new_instance['stumbleupon'];
    		$instance['tumbler'] = $new_instance['tumbler'];
    $instance['flickr'] = $new_instance['flickr'];
    		$instance['delicious'] = $new_instance['delicious'];
    		    $instance['rss'] = $new_instance['rss'];
    		$instance['emailurl'] = $new_instance['emailurl'];

    		$instance['youtube'] = $new_instance['youtube'];
    $instance['vimeo'] = $new_instance['vimeo'];
    		$instance['msn'] = $new_instance['msn'];
    		    $instance['skype'] = $new_instance['skype'];
    		$instance['mobileme'] = $new_instance['mobileme'];
        		    $instance['show_contact'] = $new_instance['show_contact'];
    		$instance['show_social'] = $new_instance['show_social'];
		return $instance;
	}

	function form( $instance )
  {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'FreshContact',
                       'show_contact' => 'true',
                       'show_social' => 'true',
                       'email' => '',
                       'subject' => '',
                       'description' => '',
                       'sendtxt' => 'Send E-Mail',

                       'twitter' => '',
                       'facebook' => '',
                       'linkedin' => '',
                       'stumbleupon' => '',
                       'tumbler' => '',
                       'flickr' => '',
                       'delicious' => '',
                       'rss' => '',
                       'emailurl' => '',
                       'youtube' => '',
                       'vimeo' => '',
                       'msn' => '',
                       'skype' => '',
                       'mobileme' => '');

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

    <p>
			<label for="<?php echo $this->get_field_id( 'show_contact' ); ?>"><?php _e('Show Contact:', 'hybrid'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_contact' ); ?>" <?php if( $instance['show_contact'] == "true") echo 'checked'; ?> name="<?php echo $this->get_field_name( 'show_contact' ); ?>" value="true" style="width:100%;" />
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'show_social' ); ?>"><?php _e('Show Social:', 'hybrid'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_social' ); ?>" <?php if( $instance['show_social'] == "true") echo 'checked'; ?> name="<?php echo $this->get_field_name( 'show_social' ); ?>" value="true" style="width:100%;" />
		</p>

    <p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e('Text description:', 'example'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" style="width:100%;" ><?php echo $instance['description']; ?></textarea>
		</p>
		<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Your email:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" />
		</p>

		<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'subject' ); ?>"><?php _e('Email subject:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'subject' ); ?>" name="<?php echo $this->get_field_name( 'subject' ); ?>" value="<?php echo $instance['subject']; ?>" style="width:100%;" />
		</p>

						<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'sendtxt' ); ?>"><?php _e('Send button text:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'sendtxt' ); ?>" name="<?php echo $this->get_field_name( 'sendtxt' ); ?>" value="<?php echo $instance['sendtxt']; ?>" style="width:100%;" />
		</p>
				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter URL:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" style="width:100%;" />
		</p>

				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" style="width:100%;" />
		</p>

				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('LinkedIn URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" style="width:100%;" />
		</p>

						<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'stumbleupon' ); ?>"><?php _e('StumbleUpon URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'stumbleupon' ); ?>" name="<?php echo $this->get_field_name( 'stumbleupon' ); ?>" value="<?php echo $instance['stumbleupon']; ?>" style="width:100%;" />
		</p>

				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tumbler' ); ?>"><?php _e('Tumblr URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'tumbler' ); ?>" name="<?php echo $this->get_field_name( 'tumbler' ); ?>" value="<?php echo $instance['tumbler']; ?>" style="width:100%;" />
		</p>

				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('Flickr URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" style="width:100%;" />
		</p>


				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'delicious' ); ?>"><?php _e('Delicious URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'delicious' ); ?>" name="<?php echo $this->get_field_name( 'delicious' ); ?>" value="<?php echo $instance['delicious']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('RSS URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'emailurl' ); ?>"><?php _e('Email URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'emailurl' ); ?>" name="<?php echo $this->get_field_name( 'emailurl' ); ?>" value="<?php echo $instance['emailurl']; ?>" style="width:100%;" />
		</p>

    		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('Youtube URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" style="width:100%;" />
		</p>

    		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('Vimeo URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" style="width:100%;" />
		</p>

				<p>
			<label for="<?php echo $this->get_field_id( 'msn' ); ?>"><?php _e('MSN URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'msn' ); ?>" name="<?php echo $this->get_field_name( 'msn' ); ?>" value="<?php echo $instance['msn']; ?>" style="width:100%;" />
		</p>

						<p>
			<label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e('Skype URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" value="<?php echo $instance['skype']; ?>" style="width:100%;" />
		</p>

						<p>
			<label for="<?php echo $this->get_field_id( 'mobileme' ); ?>"><?php _e('MobileMe URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'mobileme' ); ?>" name="<?php echo $this->get_field_name( 'mobileme' ); ?>" value="<?php echo $instance['mobileme']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
?>