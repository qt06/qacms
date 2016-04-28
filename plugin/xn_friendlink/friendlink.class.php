<?php

/*
 * Copyright (C) xiuno.com
 */

class friendlink extends base_model {
	
	public $typearr = array(0=>'文字链接', 1=>'图片链接');
	
	function __construct(&$conf) {
		parent::__construct($conf);
		$this->table = 'friendlink';
		$this->primarykey = array('linkid');
		$this->maxcol = 'linkid';
		
	}
	
	// ------------------> 杂项
	
	// 用来显示给用户
	public function format(&$friendlink) {
		$friendlink['typeword']  = $this->typearr[$friendlink['type']];
		$friendlink['logourl']  = $friendlink['logo'] ? $this->conf['upload_url'].$friendlink['logo'] : '';
	}
}
?>