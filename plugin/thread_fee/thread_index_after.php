		$need_buy = false;
		if($thread['golds'] > 0 && $thread['uid'] != $this->_user['uid']) {
			$fee = $this->thread_fee_log->index_fetch(array('tid'=>$tid, 'uid'=>$uid), array(), 0, 1);
			if(empty($fee)) {
				$need_buy = true;
			}
		}
		$this->view->assign('need_buy', $need_buy);
