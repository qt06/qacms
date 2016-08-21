	// 锁定
	public function on_close() {
		$this->check_login();
		if($this->_user['groupid'] > 0 && $this->_user['groupid'] < 6) {
			$fid = intval(core::gpc('fid'));
			$tid = intval(core::gpc('tid'));
			$thread = $this->thread->read($fid,$tid);
			$this->check_thread_exists($thread);
			$thread['closed'] = 1;
			$this->thread->update($thread);
			$this->message('成功。', 1);
		} else {
			$this->message("无权操作。",0);
		}
	}
	
	// 解除锁定
	public function on_open() {
		$this->check_login();
		if($this->_user['groupid'] > 0 && $this->_user['groupid'] < 6) {
			$fid = intval(core::gpc('fid'));
			$tid = intval(core::gpc('tid'));
			$thread = $this->thread->read($fid,$tid);
			$this->check_thread_exists($thread);
			$thread['closed'] = 0;
			$this->thread->update($thread);
			$this->message('成功。', 1);
		} else {
			$this->message("无权操作。",0);
		}
	}