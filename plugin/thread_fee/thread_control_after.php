	public function on_buy() {
		$this->check_login();
		$fid = intval(core::gpc('fid'));
		$tid = intval(core::gpc('tid'));
		$uid = $this->_user['uid'];
		$username = $this->_user['username'];
		$fee = $this->thread_fee_log->index_fetch(array('tid'=>$tid, 'uid'=>$uid), array(), 0, 1);
		if(!empty($fee)) {
		$this->on_index();
		}
		$thread = $this->thread->read($fid, $tid);
		$user = $this->user->read($uid);
		if($user['golds'] < $thread['golds']) {
			$this->message('您的金币余额不足，无法购买。', 1);
		}
		$user['golds'] -= $thread['golds'];
		$this->user->update($user);
		$user2 = $this->user->read($thread['uid']);
		$user2['golds'] += $thread['golds'];
		$this->user->update($user2);
		$this->thread_fee_log->create(array('tid'=>$tid, 'uid'=>$uid, 'username'=>$username, 'created'=>time(), 'golds'=>$thread['golds']));
		$this->on_index();
	}
