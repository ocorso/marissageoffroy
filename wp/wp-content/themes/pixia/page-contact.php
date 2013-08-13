<?php
/*
Template Name: Contact Page
*/
?>
<?php 
	get_header(); 
	$hide_ttl="no";
	$data = get_post_meta( $post->ID, '_custom_meta_reg-page_template', true );
	if (!empty($data))
	{
		if (isset($data['pixia_show_title']) && $data['pixia_show_title']=="yes")
		{
			$hide_ttl="yes";
		}
	}
	$clearer_inactive_color=alter_brightness($pixia_frontend_options['inactive_color'],40);
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
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
				$email_to =$pixia_frontend_options['email_address']; 
				$message_body = "Name: $c_name \n\nEmail: $c_email \n\nComments: $c_message";
				$headers = "From: ".get_bloginfo('title')."\r\n" .'Reply-To: ' . $c_email;
				mail($email_to, $c_subject, $message_body, $headers);
				$email_sent = true;
			}
		}
	}
?>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_40">
    <?php pirenko_main_before(); ?>
  	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_40" role="main" style="max-width:<?php echo $pixia_frontend_options['custom_width'] ?>px;">
      	<div class="colored_bg boxed_shadow">
        	<?php 
				if ($hide_ttl=="no")
				{
					?>
					<div class="page-header">
						<h3>
							<header_font><?php the_title(); ?></header_font>
						</h3>
					</div>
                    <?php 
						if ($pixia_frontend_options['google-maps']!="")
                    	{
							echo '<div id="google-maps" class=" boxed_shadow cf">';
							echo $pixia_frontend_options['google-maps'];
							echo '</div><!-- google_maps -->';
						}
				}
				else
				{
					?>
					<div style="height:20px"></div>
                    <?php 
						if ($pixia_frontend_options['google-maps']!="")
                    	{
							echo '<div id="google-maps" class=" boxed_shadow cf">';
							echo $pixia_frontend_options['google-maps'];
							echo '</div><!-- google_maps -->';
						}
				}
			?>
      		
            <div id="contact_description" class="columns seven padded_text">
                <h4>
                        <?php echo do_shortcode($pixia_frontend_options['contact-info_title_body']); ?>
                    </h4>    
                    <div class="inner_line_sidebar_block"></div>
                <div class="on_colored prk_justified">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
              	</div>
            </div>
            <div class="columns five padded_text">
            <div class="">
            <div id="contact_address" class="cf">
             	<h4>
					<?php echo do_shortcode($pixia_frontend_options['contact-info_title']); ?>
               	</h4>
                
				<div class="inner_line_sidebar_block"></div>
                    <?php
                        if ($pixia_frontend_options['contact-address']!="")
                        {
                            ?>
                            <div class="contact_address_block cf">
                                <div class="tr_wrapper" style="z-index:0;margin-top:5px;">
                                    <div class="submenu_home pirenko_tinted">
                                        <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                    </div>
                                </div>
                                <h5 class="contact_address_right">
                                    <?php echo do_shortcode($pixia_frontend_options['contact-address']); ?>
                                </h5>
                            </div>
                            <?php
                        }
                        if ($pixia_frontend_options['contact-info_tel']!="")
                        {
                            ?>
                            <div class="contact_address_block cf">
                                <div class="tr_wrapper" style="z-index:0;margin-top:-5px;">
                                    <div class="submenu_telephone pirenko_tinted">
                                        <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                    </div>
                                </div>
                                <h5 class="contact_address_right_single">
                                    <?php echo do_shortcode($pixia_frontend_options['contact-info_tel']); ?>
                                </h5>
                            </div>
                            <?php
                        }
                        if ($pixia_frontend_options['contact-info_fax']!="")
                        {
                            ?>
                            <div class="contact_address_block cf">
                                <div class="tr_wrapper" style="z-index:0">
                                    <div class="submenu_fax pirenko_tinted">
                                        <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                    </div>
                                </div>
                                <h5 class="contact_address_right_single">
                                    <?php echo do_shortcode($pixia_frontend_options['contact-info_fax']); ?>
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
    
                        if ($pixia_frontend_options['contact-info_email']!="")
                        {
                            ?>
                            <div class="contact_address_block cf">
                                <div class="tr_wrapper" style="z-index:0">
                                    <div class="submenu_envelope pirenko_tinted">
                                        <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $clearer_inactive_color ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                    </div>
                                </div> 
                                <h5 class="contact_address_right_single">
                                    <?php echo hide_email($pixia_frontend_options['contact-info_email'], $pixia_frontend_options['contact-info_email']);?>
                                </h5>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="contact_address_block_last cf special_italic">
                    	<em>
                                <?php echo do_shortcode($pixia_frontend_options['contact-address_info_msg']); ?>
                     	</em>
                    </div>
                </div>
                
        	</div>
            </div>
                <div class="clearfix"></div>
                <div id="contact_form" class="columns twelve padded_text">
                <h4>
                        <?php echo do_shortcode($pixia_frontend_options['contact-info_title_form']); ?>
                    </h4>    
                    <div class="inner_line_sidebar_block"></div>
                    <form action="" id="contact-form" method="post">
                    <div class="row">
                    	<div class="six columns">
                            <div class="tr_wrapper" style="z-index:0;margin-top:-5px;">
                                <div class="submenu_ct_man pirenko_tinted">
                                    <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $pixia_frontend_options['inactive_color']; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                </div>
                            </div>
                            <input type="text" class="pk_contact_highlighted" name="c_name" id="c_name" 
                            placeholder="<?php _e($pixia_frontend_options['contact_name_text'], 'pixia');_e($pixia_frontend_options['required_text'], 'pixia'); ?>" />
                        <?php if($name_error != '') 
                        { 
                            ?>
                            <p class="error"><?php echo $name_error;?></p>
                            <?php 
                        } 
                        ?>
                        </div> 
                        <div class="clearfix"></div>      
                        <div class="six columns">
                            <div class="tr_wrapper" style="z-index:0;margin-top:-5px;">
                                <div class="submenu_ct_env pirenko_tinted">
                                    <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $pixia_frontend_options['inactive_color']; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                </div>
                            </div>
                            <input type="text" class="pk_contact_highlighted" name="c_email" id="c_email" size="28" 							placeholder="<?php _e($pixia_frontend_options['contact_email_text'], 'pixia');_e($pixia_frontend_options['required_text'], 'pixia'); ?>" />
                        <?php if($email_error != '')
                        { 
                            ?>
                            <p class="error"><?php echo $email_error;?></p>
                            <?php 
                        } 
                        ?>
                         </div>
                         <div class="clearfix"></div>
                        <div class="six columns">
                            <div class="tr_wrapper" style="z-index:0;margin-top:-5px;">
                                <div class="submenu_ct_sbj pirenko_tinted">
                                    <img class="filter-tint" data-pb-tint-opacity="1" data-pb-tint-colour="<?php echo $pixia_frontend_options['inactive_color']; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/various_icons.png" />
                                </div>
                            </div>
                            <input type="text" class="pk_contact_highlighted" name="c_subject" id="c_subject" size="28"
                            placeholder="<?php _e($pixia_frontend_options['contact_subject_text'], 'pixia'); ?>" />
                         </div>
                  	</div>
                        <div>
                            <textarea class="pk_contact_highlighted" name="c_message" id="c_message" rows="6"
                            onfocus="if(this.value=='<?php _e($pixia_frontend_options['contact_message_text'], 'pixia'); ?>')this.value=''" 
                        onblur="if(this.value=='')this.value='<?php _e($pixia_frontend_options['contact_message_text'], 'pixia'); ?>'"><?php _e($pixia_frontend_options['contact_message_text'], 'pixia'); ?></textarea>
                        </div>
                        <?php if($message_error != '') 
                        { 
                            ?>
                            <p class="error"><?php echo $message_error;?></p>
                            <?php 
                        } 
                        if (!isset($pixia_frontend_options['contact_submit']))
                            $pixia_frontend_options['contact_submit']='Send Message';
                        ?>
                        <input type="hidden" id="full_subject" name="full_subject" value="" />
                        <input type="hidden" name="rec_email" value="<?php echo $pixia_frontend_options['email_address']; ?>" />
                        <div id="contact_ok"><?php echo _e($pixia_frontend_options['contact_wait_text'], 'pixia'); ?>...</div>
                        <div id="submit_message_div" class="theme_button">
                            <a href="#"><?php _e($pixia_frontend_options['contact_submit'], 'pixia'); ?>&nbsp;&rarr;</a>
                        </div>
                        <input type="hidden" name="c_submitted" id="c_submitted" value="true" />
                        <div class="clearfix"></div>
                    </form>
       			</div><!-- contact form wrap -->
                <div class="clearfix"></div>
            </div>
      </div><!-- /#main -->
    <?php pirenko_main_after(); ?>
    </div><!-- /#content -->
    <script type="text/javascript">
	jQuery(document).ready(function()
	{
		var template_directory = '<?php echo get_template_directory_uri(); ?>';
		var template_name = '<?php bloginfo('name'); ?>';
		var empty_text_error = '<?php _e($pixia_frontend_options['contact_error_text'], 'pixia'); ?>';
		var invalid_email_error = '<?php _e($pixia_frontend_options['contact_error_email_text'], 'pixia'); ?>';
		var contact_ok='<p><?php _e($pixia_frontend_options['contact_ok_text'], 'pixia'); ?></p>';
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