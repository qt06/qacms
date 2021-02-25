<?php
require_once(FRAMEWORK_PATH. 'lib/PHPMailer-5.2.28/PHPMailerAutoload.php');
class xn_mail {
	/*
		$smtp = array('host'=>'smtp.163.com', 'port'=>25, 'user'=>'zhangsan', 'pass'=>'123456');
		xn_mail::send($smtp, $username, $email, $subject, $message);
	*/
	public static function send($smtp, $username, $email, $subject, $message, $charset = 'GBK') {
		// 部分 SMTP 不支持UTF-8
		/*
		if(in_array($smtp, array('smtp.126.com', 'smtp.163.com'))) {
			$charset = 'GBK';
		} else {
			$charset = 'UTF-8';
		}
		$charset = 'GBK';
		*/
		$mail             = new PHPMailer();
		//$mail->PluginDir = FRAMEWORK_PATH.'lib/';
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->IsHTML(TRUE);		//$mail->ContentType= 'text/html';
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		                                   // 1 = errors and messages
		                                   // 2 = messages only
		$mail->SMTPAuth   = TRUE;                  // enable SMTP authentication
		$mail->Host       = $smtp['host']; // sets the SMTP server
		$mail->Port       = $smtp['port'];                    // set the SMTP port for the GMAIL server
		$mail->Username   = $smtp['user']; // SMTP account username
		$mail->Password   = $smtp['pass'];        // SMTP account password
		$mail->Timeout    = 5;	// 
		$mail->CharSet    = $charset;
		
		$mail->Encoding   = 'base64';
		
		//$subject = $charset == 'UTF-8' ? iconv('UTF-8', 'GBK', $subject) : $subject;
		//$message = $charset == 'UTF-8' ? iconv('UTF-8', 'GBK', $message) : $message;
		//$username = $charset == 'UTF-8' ? iconv('UTF-8', 'GBK', $username) : $username;
		//$fromemail = $this->conf['reg_email_user'].'@'.$this->conf['reg_email_host'];
		
		$mail->SetFrom($smtp['email'], $username);
		$mail->AddReplyTo($smtp['email'], $email);
		$mail->Subject    = $subject;
		$mail->AltBody    = $message; // optional, comment out and test
		$message          = str_replace("\\",'',$message);
		$mail->MsgHTML($message);
		
		$mail->AddAddress($email, $username);
		
		//$mail->AddAttachment("images/phpmailer.gif");      // attachment
		//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
		
		if(!$mail->Send()) {
			return "Mailer Error: " . $mail->ErrorInfo;
		} else {
			return '';
		}
	}
}
?>
