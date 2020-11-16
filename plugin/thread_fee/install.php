<?php

!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');

// 改文件会被 include 执行。
if($this->conf['db']['type'] != 'mongodb') {
	$db = $this->user->db;	// 与 user model 同一台 db
	$db->table_column_add("thread","golds", "int(10) NOT NULL DEFAULT '0'");
	$db->table_drop('thread_fee_log');
	$db->table_create('thread_fee_log', array (
		array('lid', 'int(10)'),
		array('tid', 'int(10)'),
		array('uid', 'int(10)'),
		array('username', 'varchar(16)'),
		array('created', 'int(10)'),
		array('golds', 'int(10)'),
	));
				$db->index_create('thread_fee_log', array('lid'=>1));
							$db->index_create('thread_fee_log', array('tid'=>1, 'uid'=>1));
							$db->index_create('thread_fee_log', array('uid'=>1));
}
