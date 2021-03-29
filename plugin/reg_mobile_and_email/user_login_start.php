				$referer = $this->get_referer();
		if(!$this->form_submit()) {
			
			// hook user_login_before.php

			if(core::gpc('ajax')) {
				$this->view->display('user_login_ajax.htm');
			} else {

				$this->view->assign('referer', $referer);
		$this->_title[] = '用户登录';
				$this->view->display('user_login.htm');
			}
		} else {
			$userdb = $error = array();
			$email = core::gpc('email', 'P');
			$password = core::gpc('password', 'P');
			$clienttime = core::gpc('clienttime', 'P') ? core::gpc('clienttime', 'P') : time();
			
			if(empty($email)) {
				$error['email'] = '请填写用户名或邮箱或手机号';
				$this->message($error['email'], 0);
			}
			
			// hook user_login_check_before.php
			$userdb = $this->user->get_user_by_email($email);
			if(empty($userdb)) {
				$userdb = $this->user->get_user_by_username($email);
				if(empty($userdb)) {
					$userdb = $this->user->get_user_by_mobile($email);
					if(empty($userdb)) {
						$error['email'] = '用户名/Email 不存在';
						log::write('EMAIL不存在:'.$email, 'login.php');
						$this->message($error['email'], 0);
					}
				}
			}
			$uid = $userdb['uid'];
			
			if(!$this->user->verify_password($password, $userdb['password'], $userdb['salt'])) {
				$error['password'] = '密码错误!';
				$log_password = '******'.substr($password, 6);
				log::write("密码错误：$email - $log_password", 'login.php');
				$this->message($error['password'], 0);
			}
			
			// hook user_login_check_after.php
			if(!array_filter($error)) {
				$error = array();
				$error['user']['uid'] =  $userdb['uid'];
				$error['user']['username'] =  $userdb['username'];
				$error['user']['auth'] =  $this->user->get_xn_auth($userdb);
				$error['user']['groupid'] =  $userdb['groupid'];
				
				// hook user_login_succeed.php
				$this->user->set_login_cookie($userdb, $clienttime + 86400 * 30);
				
				// 更新在线列表
				$this->update_online();
			}
			if(core::gpc('ajax', 'R')) {
				$this->message($error);
			}
			$this->location($referer);
		}
exit;
