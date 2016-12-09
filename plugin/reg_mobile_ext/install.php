<?php

!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');

// 改文件会被 include 执行。
if($this->conf['db']['type'] != 'mongodb') {
	$db = $this->user->db;	// 与 user model 同一台 db
	$db->table_column_add("user","phone", "char(128) NOT NULL DEFAULT ''");
	$db->table_column_add("user","imei", "char(128) NOT NULL DEFAULT ''");
	$db->table_column_add("user","appversion", "char(128) NOT NULL DEFAULT ''");
	$db->table_column_add("user","androidversion", "char(128) NOT NULL DEFAULT ''");
	$db->table_column_add("user","mobiletype", "char(128) NOT NULL DEFAULT ''");
}
