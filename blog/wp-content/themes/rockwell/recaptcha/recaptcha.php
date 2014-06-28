<?php
require_once 'recaptchalib.php';

# KEYS
$publicKey = get_option('ff_contact_recaptcha_publickey');
$privateKey = get_option('ff_contact_recaptcha_privatekey');

# print the reCaptcha element
function recaptcha_print() {
	if( get_option('ff_contact_recaptcha_on') != 'true' ) return;
	global $publicKey;
	echo recaptcha_get_html($publicKey, $error);
}

# check the reCaptcha response. 
# return TRUE / FALSE
function recaptcha_check() {
	if( get_option('ff_contact_recaptcha_on') != 'true' ) return true;
	global $privateKey;
	# was there a reCAPTCHA response?
	if ($_POST["recaptcha_response_field"]) {
	        $resp = recaptcha_check_answer ($privateKey,
	                                        $_SERVER["REMOTE_ADDR"],
	                                        $_POST["recaptcha_challenge_field"],
	                                        $_POST["recaptcha_response_field"]);
	
	        if ($resp->is_valid) {
	                return true;
	        } else {
	                return false;
	        }
	}
}