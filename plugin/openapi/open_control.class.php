<?php

/*
 * Copyright (C) zdsr.com
 */

!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');

include BBS_PATH.'control/common_control.class.php';

class open_control extends common_control {
	
	function __construct(&$conf) {
		parent::__construct($conf);
		$this->_title[] = ($this->conf['seo_title'] ? $this->conf['seo_title'] : $this->conf['app_name']) . '开放平台';
		//$this->_seo_keywords = $this->conf['seo_keywords'];
		//$this->_seo_description = $this->conf['seo_description'];
	}

	public function on_index() {
		$applist = $this->open_app->get_applist();
		foreach($applist as &$app) {
			$this->open_app->format($app);
		}
$this->format == "json" && $this->json($applist);
		$this->view->assign("applist",$applist);
		$this->view->display("open_index.htm");
	}

	public function on_view() {
		$aid = core::gpc("aid");
		$app = $this->open_app->read($aid);
		$this->format == "json" && $this->json($app);
		$this->view->assign("app",$app);
		$this->view->display("open_view.htm");
	}

	public function on_create() {
		$this->check_login();
		if($this->form_submit()) {
				$error = array();
			$name = core::gpc("name","P");
			$screenname = core::gpc("screenname","P");
			$error['name'] = $this->open_app->check_name_exists($name);
				$error['screenname'] = $this->open_app->check_screenname_exists($screenname);
				if(array_filter($error)) $this->message($error);
			$description = core::gpc("description","P");
			$type = core::gpc("type","P");
			$created = time();
			$modified = time();
			$appkey = $this->open_app->generate_appkey();
			$seckey = $this->open_app->generate_seckey();
			$arr = array(
				'uid'=>$this->_user['uid'],
				'username'=>$this->_user['username'],
				'created'=>$created,
				'modified'=>$modified,
				'name'=>$name,
				'screenname'=>$screenname,
				'type'=>$type,
				'description'=>$description,
				'appkey'=>$appkey,
				'seckey'=>$seckey,
				'verify'=>0
			);
			$aid = $this->open_app->create($arr);
			$this->message("应用创建完成。",1,"?open-index.htm");
		}
		array_unshift($this->_title,'创建新应用');
		$this->view->display("open_create.htm");
	}
	//end class
}
?>