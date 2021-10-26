<?php

!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');

// 改文件会被 include 执行。
if($this->conf['db']['type'] != 'mongodb') {
	$this->kv->set('mobile_setting', array(
'everyday_limit'=>20,
'send_plat'=>'tencent',
'tencent_appid'=>'',
'tencent_appkey'=>'',
'tencent_sign'=>'',
'tencent_template'=>'',
'aliyun_appid'=>'',
'aliyun_appkey'=>'',
'aliyun_sign'=>'',
'aliyun_templateid'=>'',
	));
	$db = $this->user->db;	// 与 user model 同一台 db
	$db->table_drop('sms_ip');
	$db->table_create('sms_ip', array(
		array('longip', 'int(11)'), 
		array('day', 'int(11)'), 
		array('count', 'int(11)'), 
	));
	$db->index_create('sms_ip', array('longip'=>1));
	$db->table_column_add("user","mobile", "char(128) NOT NULL DEFAULT ''");
}
