if($this->_user['groupid'] > 0 && $this->_user['groupid'] <6) {
	$closed = intval(core::gpc('close_thread','P'));
	$thread['closed'] = $closed;
}
