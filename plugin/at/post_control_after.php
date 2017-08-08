private function atta($username, $fid, $tid, $subject, &$message) {
	preg_match_all('/@(\S+?)[\s，。；：、,:]+/i', $message, $uns);
	$uns = array_values(array_unique($uns[1]));
	$cnt = count($uns);
	if($cnt > 0) {
		for($i = 0; $i < $cnt; $i++) {
			$u = $this->user->get_user_by_username($uns[$i]);
			if(!$u || empty($u['uid'])) {
				continue;
			}
			$message = str_replace($uns[$i], '<a href="?you-index-uid-' . $u['uid'] . '.htm" target="_blank"><em>' . $u['username'] . '</em></a>', $message);
			$pmmessage = '【' . $username . '】在【<a href="?thread-index-fid-' . $fid . '-tid-' . $tid . '.htm" target="_blank">' . $subject . '</a>】里提到了你， <a href="?thread-index-fid-' . $fid . '-tid-' .$tid . '.htm" target="_blank">点击查看</a>';
			$this->pm->system_send($u['uid'], $u['username'], $pmmessage);
		}
	}
}