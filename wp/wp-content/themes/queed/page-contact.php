<?php
/*
Template Name: Contact Page
*/
?>
<?php 
	get_header(); 
	//INITIALIZE VARIABLES
    $name_error = '';
    $email_error = '';
    $subject_error = '';
    $message_error = '';
    //GET CUSTOM THEME OPTIONS
	if (isset($_REQUEST['c_submitted']))
	{
		if($_REQUEST['c_submitted'])
		{
			$c_name = trim($_REQUEST['c_name']);
			$c_email = trim($_REQUEST['c_email']);
			$c_subject = trim($_REQUEST['c_subject']);
			$c_message = trim($_REQUEST['c_message']);
			//SEND EMAIL IF THERE ARE NO ERRORS
			if($error != true) 
			{
				$email_to =$queed_frontend_options['email_address']; 
				$message_body = "Name: $c_name \n\nEmail: $c_email \n\nComments: $c_message";
				$headers = "From: ".get_bloginfo('title')."\r\n" .'Reply-To: ' . $c_email;
				mail($email_to, $c_subject, $message_body, $headers);
				$email_sent = true;
			}
		}
	}
?>
<div class="page-header">
                    <h1><?php the_title(); ?></h1>
                  </div>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    
    <?php queed_main_before(); ?>
      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
        <?php /* Start loop */ ?>
			<?php while (have_posts()) : the_post(); ?>
                  <div id="google-maps" class="white_bg boxed_shadow cf">
            			<?php echo $queed_frontend_options['google-maps']; ?>
         		</div><!-- google_maps -->
                <?php the_content(); ?>
                <div>
                    <form action="" id="contact-form" method="post">
                        <div class="contact_inputs_wrapper">
                            <div class="form_name_icon man_icon"></div>
                            <input type="text" class="pirenko_highlighted" name="c_name" id="c_name" size="28" 
                            placeholder="<?php _e($queed_frontend_options['contact_name_text'], 'queed');_e($queed_frontend_options['required_text'], 'queed'); ?>" />
                        <?php if($name_error != '') 
                        { 
                            ?>
                            <p class="error"><?php echo $name_error;?></p>
                            <?php 
                        } 
                        ?>
                        </div>
                        <div class="contact_inputs_wrapper">
                            <div class="form_name_icon email_icon"></div>
                            <input type="text" class="pirenko_highlighted" name="c_email" id="c_email" size="28" 							placeholder="<?php _e($queed_frontend_options['contact_email_text'], 'queed');_e($queed_frontend_options['required_text'], 'queed'); ?>" />
                        <?php if($email_error != '')
                        { 
                            ?>
                            <p class="error"><?php echo $email_error;?></p>
                            <?php 
                        } 
                        ?>
                        </div>
                        <div class="contact_inputs_wrapper">
                            <div class="form_name_icon info_icon"></div>
                            <input type="text" class="pirenko_highlighted" name="c_subject" id="c_subject" size="28"
                            placeholder="<?php _e($queed_frontend_options['contact_subject_text'], 'queed'); ?>" />
                        </div>
                        <div>
                            <textarea class="pirenko_highlighted" name="c_message" id="c_message" rows="6"
                            onfocus="if(this.value=='<?php _e($queed_frontend_options['contact_message_text'], 'queed'); ?>')this.value=''" 
                        onblur="if(this.value=='')this.value='<?php _e($queed_frontend_options['contact_message_text'], 'queed'); ?>'"><?php _e($queed_frontend_options['contact_message_text'], 'queed'); ?></textarea>
                        </div>
                        <?php if($message_error != '') 
                        { 
                            ?>
                            <p class="error"><?php echo $message_error;?></p>
                            <?php 
                        } 
                        if (!isset($queed_frontend_options['contact_submit']))
                            $queed_frontend_options['contact_submit']='Send Message';
                        ?>
                        <input type="hidden" id="full_subject" name="full_subject" value="" />
                        <input type="hidden" name="rec_email" value="<?php echo $queed_frontend_options['email_address']; ?>" />
                        <div id="contact_ok"><?php echo _e($queed_frontend_options['contact_wait_text'], 'queed'); ?>...</div>
                        <div id="submit_message_div" class="theme_button">
                            <a href="#"><?php _e($queed_frontend_options['contact_submit'], 'queed'); ?>&nbsp;&nbsp;&nbsp;&rarr;</a>
                        </div>
                        <input type="hidden" name="c_submitted" id="c_submitted" value="true" />
                        
                    </form>
       			</div><!-- contact form wrap -->
                  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
            <?php endwhile; /* End loop */ ?>
      </div><!-- /#main -->
    <?php queed_main_after(); ?>
    <div id="sidebar_divider_contact" class="cf">
        <div class="dotted_line"></div>
        <div class="dotted_line"></div>
        <div class="dotted_line"></div>
	</div>
      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
      	<div class="contact_well">
            <div id="contact_address" class="white_bg cf">
             	<h4>
					<?php echo do_shortcode($queed_frontend_options['contact-info_title']); ?>
               	</h4>
                <div class="simple_line_sidebar" <div=""></div>
				<div class="inner_line_sidebar_block"></div>
                    <?php
                        if ($queed_frontend_options['contact-address']!="")
                        {
                            ?>
                            <div class="contact_address_block cf">
                                <?php echo home_icon_shortcode(); ?> 
                                <h5 class="contact_address_right">
                                    <?php echo do_shortcode($queed_frontend_options['contact-address']); ?>
                                </h5>
                            </div>
                            <?php
                        }
                        if ($queed_frontend_options['contact-info_tel']!="")
                        {
                            ?>
                            <div class="contact_address_block cf">
                                <?php echo phone_icon_shortcode(); ?> 
                                <h5 class="contact_address_right_single">
                                    <?php echo do_shortcode($queed_frontend_options['contact-info_tel']); ?>
                                </h5>
                            </div>
                            <?php
                        }
                        if ($queed_frontend_options['contact-info_fax']!="")
                        {
                            ?>
                            <div class="contact_address_block cf">
                                <?php echo fax_icon_shortcode(); ?> 
                                <h5 class="contact_address_right_single">
                                    <?php echo do_shortcode($queed_frontend_options['contact-info_fax']); ?>
                                </h5>
                            </div>
                            <?php
                        }
                        //FUNCTION TO PROTECT EMAIL SPAM
                        function hide_email($email, $display)
                        { 
                            $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
                            $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999);
                            for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])];
                            $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
                            $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
                            $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">' . $display . '</a>"';
                            $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; 
                            $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';
                            return '<span id="'.$id.'">[javascript protected email address]</span>'.$script;
                        }
    
                        if ($queed_frontend_options['contact-info_email']!="")
                        {
                            ?>
                            <div class="contact_address_block cf">
                                <?php echo email_icon_shortcode(); ?> 
                                <h5 class="contact_address_right_single">
                                    <?php echo hide_email($queed_frontend_options['contact-info_email'], $queed_frontend_options['contact-info_email']);?>
                                </h5>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="contact_address_block cf special_italic">
                    	<em>
                            
                                <?php echo do_shortcode($queed_frontend_options['contact-address_info_msg']); ?>
                           
                     	</em>
                    </div>
                </div>
                
        	</div><!-- well --> 
        	<?php get_sidebar(); ?>
      </aside><!-- /#sidebar -->
    </div><!-- /#content -->
    <?php 
		$str1=__($queed_frontend_options['contact_error_text'], 'queed');
		$str2=__($queed_frontend_options['contact_error_email_text'], 'queed');
		$str3=__($queed_frontend_options['contact_ok_text'], 'queed');
		?>
    <script type="text/javascript">
	jQuery(document).ready(function()
	{
		var template_directory = '<?php bloginfo('template_directory'); ?>';
		var template_name = '<?php bloginfo('name'); ?>';
		var empty_text_error = '<?php echo str_replace('"',"'",$str1); ?>';
		var invalid_email_error = "<?php echo str_replace('"',"'",$str2); ?>";
		var contact_ok='<p><?php echo str_replace('"',"'",$str3); ?></p>';
		jQuery('#submit_message_div a').click(function(e) 
		{
			e.preventDefault();
			//REMOVE PREVIOUS ERRORS IF THEY EXIST
          	jQuery("#contact-form .contact_error").remove();
        
			//ADD THE TEMPLATE NAME TO THE SUBJECT
			helper=jQuery('#c_subject').attr('value');
			jQuery('#full_subject').attr('value',template_name+' - '+helper);
					
          	var value, theID, error, emailReg;
          	error = false;
            emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;				
        
           	//DATA VALIDATION
           	jQuery('#c_name, #c_email, #c_message').each(function()
            {
            	value = jQuery(this).val();
                theID = jQuery(this).attr('id');
                if(value == '')
                {
                 	jQuery(this).parent().append('<p class="contact_error">'+empty_text_error+'</p>');
                  	error = true;
               	}
              	if(theID == 'c_email' && value != '' && !emailReg.test(value))
               	{
               		jQuery(this).parent().append('<p class="contact_error">'+invalid_email_error+'</p>');
                 	error = true;
              	}
          	});
					
			//SEND EMAIL IF THERE ARE NO ERRORS
            if(error == false)
          	{
				//HIDE THE SEND BUTTON
				jQuery("#submit_message_div").fadeTo("slow",0,function() 
				{
					//ON COMPLETE MAKE THE BUTTON INVISIBLE
      				jQuery("#submit_message_div").addClass("hidden_div");	
					jQuery("#contact_ok").fadeIn("slow");
					//SEND EMAIL
					jQuery.ajax({  
						type: "POST",  
						url: template_directory+"/inc/pirenko_contact_form.php",  
						data: jQuery("#contact-form").serialize(),  
						success: function(resp)
						{  
							if(resp == 'sent') 
							{
								jQuery("#contact_ok").html(contact_ok);
							}
							else 
							{
								jQuery("#contact_ok").html(resp);
							}
								
						},  
						error: function(e)
						{  
							alert('Error: ' + e);  
						}  
					});
   				});
			}
		});
	});
</script>
<?php get_footer(); ?>