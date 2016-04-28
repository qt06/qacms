<?php

!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');

if(!DEBUG) {

	$db = $this->user->db;
	$db->table_drop('friendlink');
	
	$dir1 = $this->conf['upload_path'].'friendlink/';
	!is_dir($dir1) && misc::rmdir($dir1);

}
?>