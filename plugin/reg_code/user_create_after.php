		session_start();
			$code = core::gpc('code', 'P');
			$s_code = isset($_SESSION['code']) ? $_SESSION['code'] : '';
			$s_email = isset($_SESSION['reg_email']) ? $_SESSION['reg_email'] : '';
			if(empty($username) || empty($password) || empty($password2) || empty($code)) {
				$this->message('信息输入不完整。', 0);
			}
			if($code != $s_code) {
				$this->message('验证码错误。', 0);
			}
			if($email != $s_email) {
				$this->message('邮箱地址错误', 0);
			}
