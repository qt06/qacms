if(!$ismod && $thread['closed'] > 0) {
	$this->message('该主题已锁定，无法回复了。', 0);
}
