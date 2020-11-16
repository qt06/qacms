	public function check_mobile(&$mobile) {
		$mobile = trim($mobile);
		if(empty($mobile)) {
			return '手机号不能为空。';
		} elseif(!preg_match('#\d+#is', $mobile)) {
			return '手机号格式错误。:'.utf8::strlen($mobile);
		} elseif(strlen($mobile) != 11) {
			return '手机号位数错误。:'.utf8::strlen($mobile);
		}
		
		// hook usre_model_check_mobile_end.php
		return '';
	}
	
	public function check_mobile_exists($mobile) {
		if($this->get_user_by_mobile($mobile)) {
			return '该手机号已经被使用';
		}
		return '';
	}
	public function get_user_by_mobile($mobile) {
		$userlist = $this->index_fetch(array('mobile'=>$mobile), array(), 0, 1);
		return $userlist ? array_pop($userlist) : array();
	}
