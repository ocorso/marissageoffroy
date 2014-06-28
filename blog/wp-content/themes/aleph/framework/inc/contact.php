<?php
/**
 * Aleph - Premium Theme for WordPress
 *
 * Contact panel
 *
 * /framework/inc/contact.php
 * Version of this file : 1.7
 *
 */
?>

		<div id="contact_panel">
			<div id="contactMap"></div>
			<div id="contactBox">

				<button class="btn btn-danger switcher" data-toggle="collapse" data-target="#contact_details"><em class="icon-chevron-down"></em></button>

				<div class="collapse in" id="contact_details">

					<?php
						$phone = $data["contact_info_phone"];
						$email = $data["contact_info_email"];
						$adress = $data["contact_info_adress"];

						if($phone!="" || $email!="" || $adress!="") {
					?>
						<div class="contact_info">
							<?php
								if($phone!="") {
									echo "<div class='clearfix'>";
										echo "<em class='icon-phone icon-white'></em> ". $phone;
									echo "</div>";
								}

								if($email!="") {
									echo "<div class='clearfix'>";
										echo "<em class='icon-envelope-alt icon-white'></em> ". $email;
									echo "</div>";
								}

								if($adress!="") {
									echo "<div class='clearfix'>";
										echo "<em class='icon-home icon-white'></em> <adress>". nl2br($adress) ."</adress>";
									echo "</div>";
								}
							?>
						</div>
						<hr>
					<?php
						}
					?>

					<?php

						$admin_email=get_post_meta($post->ID, 'admin_email', true);
						if(empty($admin_email)) {
							$admin_email=$data["admin_email"];
						}

$first_name_error = '';
$email_error = '';
$message_error = '';


						if(!isset($_REQUEST['submitted'])) $_REQUEST['submitted'] = '';
						if($_REQUEST['submitted']){

								//check name
								if(trim($_REQUEST['first_name'] == "")){
									//it's empty
									$first_name_error = __('You forgot to fill in your name','alephtheme');
									$error = true;
								}else{
									//its ok
									$first_name = trim($_REQUEST['first_name']);
								}

								//check email
								$regex_mail = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
								if(trim($_REQUEST['email'] == "")){
									//it's empty
									$email_error = __('Your forgot to fill in your email address','alephtheme');
									$error = true;
								} else {
									if(!preg_match($regex_email, trim($_REQUEST['email']))){
										//it's ok
										$email = trim($_REQUEST['email']);
									}else {
										//it's wrong format
										$email_error = __('Wrong email format','alephtheme');
										$error = true;
									}
								}

								//check message
								if(trim($_REQUEST['message'] === "")){
									//it's empty
									$message_error = __('You forgot to fill in your name','alephtheme');
									$error = true;
								}else{
									//it's ok
									$message = trim($_REQUEST['message']);
								}

								$email_to = $admin_email; //change this with your email address
								$message_body = "";
								$message_body .= "First Name: $first_name \n\nEmail: $email \n\nMessage: $message";
								$headers = "From : ".get_bloginfo('name').' <'.$email_to.'>' . "\r\n" .'Reply-To : ' . $email;

								mail($email_to, $subject, $message_body, $headers);

						}

					?>

					<div class="alert alert-success contact"><?php _e('Thank you for contacting. We will answer as soon as possible.','alephtheme') ?></div>

					<form action="<?php the_permalink(); ?>" id="contact_form" method="post" class="form-vertical">
						<fieldset>
							<div class="control-group">
								<label for="first_name" class="control-label">
									<?php _e('Name *','alephtheme') ?>
								</label>
								<div class="controls">
									<input type="text" name="first_name" class="required" id="first_name" />
								</div>
							</div>

							<div class="control-group">
								<label for="email" class="control-label">
									<?php _e('Email *','alephtheme') ?>
								</label>
								<div class="controls">
									<input type="text" name="email" class="required email" id="email" />
								</div>
							</div>

							<div class="control-group message">
								<label for="message" class="control-label">
									<?php _e('Message *','alephtheme') ?>
								</label>
								<div class="controls">
									<textarea name="message" id="message" class="required"></textarea>
								</div>
							</div>


							<button type="submit" class="btn btn-primary" name="contact-submit" id="contact-submit" data-loading-text="&hellip;">Send form</button>

							<input type="hidden" name="submitted" id="submitted" value="true" />

							<input type="hidden" id="contact_action" value="<?php the_permalink(); ?>" />
						</fieldset>
					</form>
				</div>

			</div>
		</div>