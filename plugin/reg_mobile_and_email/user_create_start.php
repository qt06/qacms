$this->conf['reg_email_on'] = 0;
		if(!$this->form_submit()) {
	$kv = $this->kv->get('mobile_setting');			
	$reg_type = $kv['reg_type'];
		$this->view->assign('reg_type', $reg_type);
				// hook user_create_before.php
			if(core::gpc('ajax')) {
				$this->view->display('user_create_ajax.htm');
			} else {
				$this->view->assign('referer', $referer);
		$this->_title[] = '用户注册';
				$this->view->display('user_create.htm');
			}
		} else {
			
		session_start();
			// 接受数据
			$userdb = $error = array();
			$verify_type = core::gpc('verify_type', 'P') ? core::gpc('verify_type', 'P') : 'email';
			$email = core::gpc('email', 'P');
			$username = core::gpc('username', 'P');
			$password= core::gpc('password', 'P');
			$password2 = core::gpc('password2', 'P');
			$clienttime = core::gpc('clienttime', 'P');
			$code = core::gpc('code', 'P');
			$s_code = isset($_SESSION['code']) ? $_SESSION['code'] : '';
			$s_email = isset($_SESSION['reg_email']) ? $_SESSION['reg_email'] : '';
			$s_mobile = isset($_SESSION['reg_mobile']) ? $_SESSION['reg_mobile'] : '';
			
			// check 数据格式
if($verify_type == 'email') {
			$error['email'] = $this->user->check_email($email);
			if(array_filter($error)) {
				$this->message($error['email'], 0);
			}
			$error['email_exists'] = $this->user->check_email_exists($email);
			
			// 如果email存在
			if($error['email_exists']) {
				// 如果该Email一天内没激活，则删除掉，防止被坏蛋“占坑”。
				$uid = $this->user->get_uid_by_email($email);
				$_user = $this->user->read($uid);
				if($_user['groupid'] == 6 && $_SERVER['time'] - $_user['regdate'] > 86400) {
					$this->user->delete($uid);
					$error['email_exists'] = '';
				}
			}
			if($email != $s_email) {
				$this->message('邮箱地址错误', 0);
			}
} else if($verify_type == 'mobile') {
			if($email != $s_mobile) {
				$this->message('手机号错误', 0);
			}
			$error['mobile'] = $this->user->check_mobile($email);
			$error['mobile_exists'] = $this->user->check_mobile_exists($email);
			if(array_filter($error)) {
				$this->message(implode(',', $error), 0);
			}
}
			$error['username'] = $this->user->check_username($username);
			$error['username_exists'] = $this->user->check_username_exists($username);
			$error['password'] = $this->user->check_password($password);
			$error['password2'] = $this->user->check_password2($password, $password2);
			
			if($code != $s_code) {
				$this->message('验证码错误。', 0);
			}
			if(array_filter($error)) {
				$this->message(implode(' | ',$error), 0);
			}
			$groupid = $this->conf['reg_email_on'] ? 6 : 11;
			$salt = $this->user->randString(9);
			$user = array(
				'username'=>$username,
				'password'=>$this->user->md5_md5($password, $salt),
				'groupid'=>$groupid,
				'salt'=>$salt,
			);
if($verify_type == 'email') {
$user['email'] = $email;
} else if($verify_type == 'mobile') {
$user['mobile'] = $email;
}

			
			// hook user_create_after.php
			
			// 判断结果
			if(!array_filter($error)) {
				$error = array();
				$uid = $this->user->xcreate($user);
				if($uid) {
					
					// 此处由 $error 携带部分用户信息返回。
					$userdb = $this->user->read($uid);
					$error['user'] = array();
					$error['user']['username'] = $userdb['username'];
					$error['user']['auth'] = $this->user->get_xn_auth($userdb);
					$error['user']['groupid'] = $userdb['groupid'];
					$error['user']['uid'] = $uid; // 此处遗漏，感谢杨永全细心指正。
					
					$this->user->set_login_cookie($userdb, $clienttime + 86400 * 30);
					$this->runtime->xset('users', '+1');
					$this->runtime->xset('todayusers', '+1');
					$this->runtime->xset('newuid', $uid);
					$this->runtime->xset('newusername', $userdb['username']);
					// $this->runtime->xsave();
					
					// hook user_create_succeed.php
					
				}
			}
			if(core::gpc('ajax', 'R')) {
				$this->message($error);
			}
			$this->location($referer);
		}
exit;
