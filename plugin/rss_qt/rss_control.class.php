<?php

/*
 * Copyright (C) xiuno.com
 */

!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');

include BBS_PATH.'control/common_control.class.php';

class rss_control extends common_control {
	
	function __construct(&$conf) {
		parent::__construct($conf);
	}
	
	// 列表
	public function on_index() {
		
		// fid
		$fid = intval(core::gpc('fid'));
		$c_threadlist = array();
		$c_threadlist = $this->runtime->get('rss_cache_'.$fid);
		if(is_array($c_threadlist) && array_key_exists('cachetime', $c_threadlist)) {
			if($c_threadlist['cachetime'] + 900 > time()) $threadlist = $c_threadlist;
		}
		if(empty($threadlist)) {
		
		// 主题分类, typeid 将决定 fid，优先级高于 fid
		$typeid1 = intval(core::gpc('typeid1'));
		$typeid2 = intval(core::gpc('typeid2'));
		$typeid3 = intval(core::gpc('typeid3'));
		$typeid4 = intval(core::gpc('typeid4'));
		$typeidsum = $typeid1 + $typeid2 + $typeid3 + $typeid4;
		
		
		if($fid) {
		$forum = $this->mcache->read('forum', $fid);
		$this->check_forum_exists($forum);
		$this->check_access($forum, 'read');
		}
		
		// orderby
		$orderby = core::gpc('orderby', 'C');
		$orderby = $orderby === NULL ? $forum['orderby'] : intval($orderby);
		$this->_title[] = $forum['seo_title'] ? $forum['seo_title'] : $forum['name'];
		$this->_seo_keywords = $forum['seo_keywords'] ?  $forum['seo_keywords'] : $forum['name'];
		$this->_seo_description = $forum['brief'];
		
		
		$pagesize = $this->conf['forum_index_pagesize'];

		$start = 0;
		$limit = $pagesize;
		if($fid ==0) {
		$this->_title[] = $this->conf['app_name'];
		$threadlist = $this->thread->get_newlist($start, $limit);
		foreach($threadlist as $k=>&$thread) {
			
			// 去掉没有权限访问的版块数据
			$fid = $thread['fid'];
			if(!empty($this->conf['forumaccesson'][$fid])) {
				$access = $this->forum_access->read($fid, $this->_user['groupid']); // 框架内部有变量缓存，此处不会重复查表。
				if($access && !$access['allowread']) {
					unset($threadlist[$k]);
					continue;
				}
			}
		}
		} elseif($typeidsum > 0) {
			$threadlist = $this->thread_type_data->get_threadlist_by_fid($fid, $typeidsum, $start, $limit);
		} else {
			$threads = $forum['threads'];
			$threadlist = $this->thread->get_threadlist_by_fid($fid, $orderby, $start, $limit, $threads);
		}
		
		
		foreach($threadlist as $k=>&$thread) {
			$post = $this->post->read($thread['fid'],$thread['firstpid']);
			$thread['message'] = $post['message'];
			$thread['lastpost_rss'] = date(DATE_RSS,$thread['lastpost']);
			$thread['comments'] = $thread['posts'] -1;
		}
			$threadlist['cachetime'] = time();
			$threadlist['lastbuilddate'] = date(DATE_RSS);
			$threadlist['pubdate'] = date(DATE_RSS);
			$this->runtime->set('rss_cache_'.$fid,$threadlist);
		}
		$lastbuilddate = $threadlist['lastbuilddate'];
		$pubdate = $threadlist['pubdate'];
		unset($threadlist['cachetime'],$threadlist['lastbuilddate'],$threadlist['pubdate']);
		$this->view->assign('lastbuilddate',$lastbuilddate);
		$this->view->assign('pubdate',$pubdate);
		$this->view->assign('threadlist', $threadlist);
		$this->view->display('rss.htm');
	}
		

	//hook rss_control_after.php
}

?>