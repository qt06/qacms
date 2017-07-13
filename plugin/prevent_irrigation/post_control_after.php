
	private function prevent_irrigation_thread() {
		if($this->_user['groupid'] > 5) {
			// 5 分钟内最大发帖量 5
			$maxposts = 5; 
			if($this->_user['groupid'] == 11) $maxposts = 2;
			$uid = $this->_user['uid'];
			$mypostlist = $this->mypost->get_list_by_uid($uid, 1, $maxposts);
			if(count($mypostlist) >= $maxposts) {
				$last = array_pop($mypostlist);
				$lastpost = $this->post->read($last['fid'], $last['pid']);
				if($_SERVER['time'] - $lastpost['dateline'] < 300) {
					$this->message('您的发帖速度太快了，服务器大叔有点承受不了，请你休息一会，5分钟后在回来继续好吗？', 0);
				}
			}

			// 最新贴里如果连续超过5篇，认为在灌水。
			$newposts = 0;
			$threadlist = $this->thread->get_newlist(0, $maxposts);
			foreach($threadlist as $_thread) {
				if($_thread['uid'] == $uid) {
					$newposts++;
				}
			}
			if($newposts == $maxposts) {
				$this->message('您的发帖速度太快了，服务器大叔有点承受不了，请你休息一会，5分钟后在回来继续好吗？', 0);
			}
		}
	}

	private function Prevent_irrigation_post($fid, $tid, $page) {
// 5 分钟内最大发帖量
if($this->_user['groupid'] > 5) {
	$maxposts = 20;
	if($this->_user['groupid'] == 11) $maxposts = 5;
$uid = $this->_user['uid'];
	$mypostlist = $this->mypost->get_list_by_uid($uid, 1, $maxposts);
	if(count($mypostlist) >= $maxposts) {
		$last = array_pop($mypostlist);
		$lastpost = $this->post->read($last['fid'], $last['pid']);
		if($_SERVER['time'] - $lastpost['dateline'] < 300) {
				$this->message('您的发帖速度太快了，服务器大叔有点承受不了，请你休息一会，5分钟后在回来继续好吗？', 0);
		}
	}
		// 同一篇主题回帖的限制
	$continuous = 0;
$ps = 10;
if($this->_user['groupid'] == 11) $ps = 2;
	$postlist = $this->post->index_fetch(array('fid'=>$fid, 'tid'=>$tid, 'page'=>$page), array(), 0, 20);
	foreach($postlist as $v) {
		if($_SERVER['time'] - $v['dateline'] < 120) $maxposts--;
	}
	if($maxposts <= $ps) {
				$this->message('您的发帖速度太快了，服务器大叔有点承受不了，请你休息一会，5分钟后在回来继续好吗？', 0);
	}
	for($i=0; $i<5; $i++) {
		$_post = array_pop($postlist);
		if($_post['uid'] == $uid) $continuous++;
	}
	if($continuous == 5) {
				$this->message('您的发帖速度太快了，服务器大叔有点承受不了，请你休息一会，5分钟后在回来继续好吗？', 0);
	}
}
	}
