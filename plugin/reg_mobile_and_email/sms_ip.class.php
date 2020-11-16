<?php

/*
 * Copyright (C) xiuno.com
 */

class sms_ip extends base_model {
	
	public $typearr = array(0=>'文字链接', 1=>'图片链接');
	
	function __construct(&$conf) {
		parent::__construct($conf);
		$this->table = 'sms_ip';
		$this->primarykey = array('longip');
		//$this->maxcol = 'longip';
		
	}
	
	public function beyond_limit() {
		$setting = $this->kv->get('mobile_setting');
		$limit = $setting['everyday_limit'];
		$longip = $_SERVER['longip'];
		$ret = $this->read($longip);
		if(empty($ret)) {
			$this->create(array('longip'=>$longip, 'day'=>date('Ymd'), 'count'=>1));
			return false;
		}
		if($ret['day'] == date('Ymd') && $ret['count'] >= $limit) {
			return true;
		}
		if($ret['day'] == date('Ymd')) {
			$ret['count']++;
			$this->update($ret);
			return false;
		}
		if($ret['day'] != date('Ymd')) {
			$ret['day'] = date('Ymd');
			$ret['count'] = 1;
			$this->update($ret);
			return false;
		}
		return false;
	}

}
