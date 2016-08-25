if($thread['status'] == 0 || ($thread['status'] == 1 && $this->_user['groupid'] > 0 && $this->_user['groupid'] < 6) || ($thread['status'] == 2 && $this->_user['uid'] == $thread['uid'])) {
