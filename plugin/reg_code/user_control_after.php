	public function on_sendcode() {
		$email = core::gpc('email', 'P');
		$error = array();
		$error['email'] = $this->user->check_email($email);
		if(array_filter($error)) {
			$this->message(implode(',',$error), -2);
		}
		$error['email_exists'] = $this->user->check_email_exists($email);
		if(array_filter($error)) {
			$this->message(implode(',',$error), -2);
		}
		session_start();
		$code = rand(100000, 999999);
		$_SESSION['reg_email'] = $email;
		$_SESSION['code'] = $code;
		try {
			$this->send_code_mail($email, $code, $error);
			if(array_filter($error)) {
				$this->message(implode(',',$error), -2);
			}
			$this->message('验证码发送成功，请打开你的邮箱查收验证码邮件。', 1);
		} catch(Exception $e) {
			$error['emailsend'] = '验证码邮件发送失败！';
			if(array_filter($error)) {
				$this->message(implode(',',$error), -2);
			}
		}
		$this->message('Access denied', 0);
	}

	private function send_code_mail($email, $code, &$error) {
		/**
$emailarr = explode('@',$email);
		$emailinfo = $this->mmisc->get_email_site($emailarr[1]);	
		$error['email_smtp_url'] = $emailinfo['url'];
		$error['email_smtp_name'] = $emailinfo['name'];
*/
		$subject = '您正在注册成为'.$this->conf['app_name'].'的会员，您的注册验证码是： '. $code;
		$message = "
			<html>
				<head>
					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
				</head>
				<body>
					尊敬的朋友您好！<br />
					您正在注册成为{$this->conf['app_name']}的会员，下面是您的注册验证码： {$code}，<br />
					验证码有效期在20分钟以内，请尽快使用。请妥善保管，不要告诉任何人。
				</body>
			</html>";

		$error['emailsend'] = $this->mmisc->sendmail($this->conf['app_name'], $email, $subject, $message);
	}

