<?php

/*
 * Copyright (C) zdsr.com
 */

class open_app extends base_model{
	
	function __construct(&$conf) {
		parent::__construct($conf);
		$this->table = 'open_app';
		$this->primarykey = array('aid');
		$this->maxcol = 'aid';
		
		// hook open_app_construct_end.php
	}
	
	public function get_app_by_appkey($appkey) {
		// 根据非主键取数据
		$applist = $this->index_fetch( array('appkey'=>$appkey), array(), 0, 1);
		return $applist ? array_pop($applist) : array();
	}

	public function get_applist($start = 0,$limit = 100) {
			$applist = $this->index_fetch(array(), array('created'=>-1), $start, $limit);
			return $applist;
	}
	
	// 用来显示给用户
	public function format(&$app) {
		if(empty($app)) return;
		$app['created_fmt'] = misc::humandate($app['created']);
		$app['modified_fmt'] = misc::humandate($app['modified']);
	}

	public function check_name_exists($name) {
		$app = $this->index_fetch(array('name'=>$name),array(),0,1);
		return $app ? '该应用名称已存在。' : '';
	}

	public function check_screenname_exists($screenname) {
		$app = $this->index_fetch(array('screenname'=>$screenname),array(),0,1);
		return $app ? '该显示名称已存在。' : '';
	}

	public function generate_appkey() {
		return time();
	}

	public function generate_seckey() {
		return md5(rand(100,999) . time());
	}

	public function html_safe($doc) {
		return xn_html_safe::filter($doc);
	}

	// hook open_app_model_end.php
}
?>