} else {
$postlist = array();
$post = $this->post->read($fid, $thread['firstpid']);
$this->post->format($post);
$post['floor'] = 1;
$postlist[] = $post;
$userlist = array($post['uid'] => array('uid'=>$post['uid'], 'username' => $post['username']));
$this->view->assign('userlist', $userlist);
		$this->view->assign('thread', $thread);
		$this->view->assign('forum', $forum);
		$this->view->assign('postlist', $postlist);
		$ismod = $this->is_mod($forum, $this->_user);
		$this->view->assign('ismod', $ismod);
		$this->view->assign('scrollbottom', $scrollbottom);
}
