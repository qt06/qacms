		//防灌水
		$this->Prevent_irrigation_post($fid, $tid, ceil($thread['posts'] / $this->conf['pagesize']));
