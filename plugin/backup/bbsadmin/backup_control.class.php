<?php

/*
 * Copyright (C) qt.hk
 */

!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');
include BBS_PATH.'admin/control/admin_control.class.php';

class backup_control extends admin_control {
	
	function __construct(&$conf) {
		parent::__construct($conf);
		$this->check_admin_group();
	}


	public function on_index() {
		$bkfiles = glob($this->conf['upload_path'].'bak_*.php');
		$ss = '';
		foreach($bkfiles as $file) {
			$ss .= '<li><a href="?backup-restore-file-' . basename($file, '.php') . '.htm">恢复到 '. basename($file, '.php') . '</a></li>';
		}
		echo '
<!DOCTYPE html>
<html>
<head>
<title>备份和恢复</title>
</head>
<body>
<h1>备份恢复</h1>
<p>备份仅支持1000条以内的数据，也就是注册用户1000人以内，发帖数小于1000</p>
<p>超出后的数据无法备份，所以请谨慎使用。</p>
<p>如需要支持更多数据的转换，请联系定制</p>
<p>联系 qq 115928478</p>

<ul>
<li><a href="?backup-back.htm">开始备份</a></li>
'. $ss . '
</ul>
</body>
</html>
';
	}
	public function on_back() {
		$tables = array('group','user','user_access','forum','forum_access','thread_type_cate','thread_type','thread_type_count','thread_type_data','thread','thread_digest','thread_new','thread_views','post','attach','attach_download','mypost','online','pmnew','pmcount','pm','follow','modlog','banip','rate','stat','kv','runtime');
		$bk = array();
		foreach($tables as $table) {
			$bk[$table] = $this->$table->index_fetch(array(), array(), 0, 1000);
		}
			if(count($bk) > 1) {		file_put_contents($this->conf['upload_path'].'bak_'.date('Y_m_d_H_i_s').'.php', "<?php\nreturn ".var_export($bk, true). ";");
			$this->message('备份成功。备份文件保存在upload 目录下。', 0);
		} else {
			$this->message('备份失败。', 1);
		}
	}
	public function on_restore() {
		$file = core::gpc('file');
		$path = $this->conf['upload_path'] . $file . '.php';
		if(!file_exists($path)) {
			$this->message('备份文件不存在。', 1);
		}
		$bk = include $path;
		foreach($bk as $k => $v) {
			foreach($v as $item) {
				$this->$k->create($item);
			}
		}
		$this->message('恢复完成，请到后台清空缓存。', 0);
	}

	//hook ct_control_after.php
}
?>