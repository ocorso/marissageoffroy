<?php 
	//THIS SCRIPTS SENDS THE EMAIL OF THE CONTACT PAGE FORM
	if(!empty($_POST)) 
	{
		$name = $_POST['c_name'];
		$mail = $_POST['c_email'];
		$admin_mail = $_POST['rec_email'];
		$msg = $_POST['c_message'];
		$subject = $_POST['full_subject'];
			
		$message="You've received a new message. <br><br>";
		$message.="Name: ".$name."<br>";
		$message.="Mail: ".$mail."<br>";
		$message.="Message: ".$msg."<br>";
		
		$headers='MIME-Version: 1.0' . "\r\n";
		$headers.='Content-type: text/html; charset=utf-8' . "\r\n";
		$headers.="From: ". $_POST['c_name'] . "<". $_POST['c_email'] .">" . "\r\n";
		$headers.='Reply-To: ' . $_POST['c_email'] . "\r\n";
		$headers.='CC: ' . $_POST['c_email'] ."\r\n";
		$headers.='X-Mailer: PHP/' . phpversion();
		$mail_result = mail($admin_mail, $subject, $message,$headers);
		if($mail_result) 
		{
			echo "sent";
		}
		else
		{
			echo "Email failure. Please try again.";
		}
		die();
	}  
?>

