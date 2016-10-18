<?php
!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');
$db_table = array(
	'open_app'=>array (
		array('aid', 'int(10)'),
		array('uid', 'int(10)'),
		array('username', 'varchar(16)'),
		array('created', 'int(10)'),
		array('modified', 'int(10)'),
		array('name', 'varchar(16)'),
		array('screenname', 'varchar(16)'),
		array('type', 'varchar(16)'),
		array('description', 'varchar(200)'),
		array('appkey', 'varchar(200)'),
		array('seckey', 'varchar(200)'),
		array('verify', 'tinyint(1)')
	),
	'open_user'=>array (
		array('uid', 'int(10)'),
		array('username', 'varchar(16)'),
		array('subject', 'varchar(100)'),
		array('content', 'longtext')
	)
);

$db_index = array(
	'open_app'=>array(
array('aid'=>1),
array('uid'=>1),
array('name'=>1),
array('screenname'=>1),
array('type'=>1),
array('appkey'=>1),
array('seckey'=>1)
),
	'open_user'=>array(array('uid'=>1))
);

			$db = $this->user->db;
			foreach($db_table as $table=>$cols) {
				$db->table_drop($table);
				$db->table_create($table, $cols);
			}
			
			//
			foreach($db_index as $table=>$indexes) {
				foreach($indexes as $index) {
					$db->index_create($table, $index);
				}
			}
