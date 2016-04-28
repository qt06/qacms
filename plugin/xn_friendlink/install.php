<?php

!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');

// 改文件会被 include 执行。
if($this->conf['db']['type'] != 'mongodb') {
	$db = $this->user->db;	// 与 user model 同一台 db
	$db->table_drop('friendlink');
	$db->table_create('friendlink', array(
		array('linkid', 'int(11)'), 
		array('type', 'int(11)'), 
		array('rank', 'int(11)'), 
		array('sitename', 'char(32)'), 
		array('url', 'char(64)'), 
		array('logo', 'char(64)'), 
	));
	$db->index_create('friendlink', array('linkid'=>1));
	$db->index_create('friendlink', array('type'=>1, 'rank'=>1));
}

$dir1 = $this->conf['upload_path'].'friendlink/';
!is_dir($dir1) && mkdir($dir1, 0777);

?>