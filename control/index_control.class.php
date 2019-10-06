<?php

/*
 * Copyright (C) xiuno.com
 */

!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');

include BBS_PATH.'control/common_control.class.php';

class index_control extends common_control {
	
	function __construct(&$conf) {
		parent::__construct($conf);
		$this->_checked['bbs'] = ' class="checked"';
		$this->_title[] = $this->conf['seo_title'] ? $this->conf['seo_title'] : $this->conf['app_name'];
		$this->_seo_keywords = $this->conf['seo_keywords'];
		$this->_seo_description = $this->conf['seo_description'];
	}
	
	// 给插件预留个位置
	public function on_index() {
		// hook index_index_before.php
$homepage_type = core::gpc('homepage_type');
if(!empty($homepage_type)) $this->conf['homepage_type'] = $homepage_type;
		if($this->conf['homepage_type'] == 'article') {
	$this->article();
	} else {
$this->bbs();
}
	}
	
	// 论坛首页
	public function bbs() {
		$this->_checked['index'] = ' class="checked"';
		
		// hook index_bbs_before.php
		
		$pagesize = 30;
		$toplist = array(); // only top 3
		$readtids = '';
		$page = misc::page();
		$start = ($page -1 ) * $pagesize;
		$orderby = core::gpc('orderby');
		empty($orderby) && $orderby = core::gpc($this->conf['cookie_pre'] . 'orderby',"C");
		empty($orderby) && $orderby = "tid";
		if($orderby == "lastpost") array_unshift($this->_title,'最新回复');
		misc::setcookie($this->conf['cookie_pre'].'orderby', $orderby, time() + 86400 * 30, $this->conf['cookie_path'], $this->conf['cookie_domain']);
		$threadlist = $this->thread->get_newlist($start, $pagesize, $orderby);
		$pages = misc::simple_pages('?index-index-orderby-' . $orderby . '.htm', count($threadlist), $page, $pagesize);
		foreach($threadlist as $k=>&$thread) {
			$this->thread->format($thread);
			
		//get postmessage
		if($this->conf['homepage_type'] == 'blog' && $this->format != 'json') {
			$post = $this->post->read($thread['fid'],$thread['firstpid']);
			$thread['message'] = $post['message'];
		}
		//end get post message
			// 去掉没有权限访问的版块数据
			$fid = $thread['fid'];
			
			// 那就多消耗点资源吧，谁让你不听话要设置权限。
			if(!empty($this->conf['forumaccesson'][$fid])) {
				$access = $this->forum_access->read($fid, $this->_user['groupid']); // 框架内部有变量缓存，此处不会重复查表。
				if($access && !$access['allowread']) {
					unset($threadlist[$k]);
					continue;
				}
			}
			
			$readtids .= ','.$thread['tid'];
			if($thread['top'] == 3) {
				unset($threadlist[$k]);
				$toplist[] = $thread;
				continue;
			}
		}
		
		$toplist = $page == 1 ? $this->get_toplist() : array();
		$toplist = array_filter($toplist);
		foreach($toplist as $k=>&$thread) {
			$this->thread->format($thread);
		//get postmessage
		$post = $this->post->read($thread['fid'],$thread['firstpid']);
		$thread['message'] = $post['message'];
		//end get post message
                        $readtids .= ','.$thread['tid'];
                }
                
		$readtids = substr($readtids, 1); 
		$click_server = $this->conf['click_server']."?db=tid&r=$readtids";
		
		$tidarr = explode(',', $readtids);
		$tidarr = array_values(array_unique($tidarr));
		$thread_views = $this->thread_views->mget($tidarr);
		foreach($threadlist as $k =>&$thread) {
			$thread['views'] = $thread_views['thread_views-tid-'.$thread['tid']]['views'];
		}
		foreach($toplist as $k =>&$thread) {
			$thread['views'] = $thread_views['thread_views-tid-'.$thread['tid']]['views'];
		}
		// 在线会员
		$ismod = ($this->_user['groupid'] > 0 && $this->_user['groupid'] <= 4);
		$fid = 0;
		$this->view->assign('ismod', $ismod);
		$this->view->assign('fid', $fid);
		$this->view->assign('threadlist', $threadlist);
		$this->view->assign('toplist', $toplist);
		$this->view->assign('click_server', $click_server);
		$this->view->assign('pages', $pages);
		
		// hook index_bbs_after.php
		if($this->format == "json") {
			$tl = array();
if(!empty($toplist)) {
foreach($toplist as $v) {
unset($v['attachnum'],$v['imagenum'],$v['color'],$v['icon'],$v['ico_desc']);
$tl[] = $v;
}
}
foreach($threadlist as $v) {
unset($v['attachnum'],$v['imagenum'],$v['color'],$v['icon'],$v['ico_desc']);
$tl[] = $v;
}
			$arr = array(
				'fid'=>$fid,
				'page'=>$page,
				'totalpage'=>ceil($this->thread_new->index_count() / 30),
				'threadlist'=>$tl
			);
			$this->json($arr);
		}
		
		if($this->conf['homepage_type'] == 'blog') {
		$this->view->display('blog_index.htm');
		} else {
			$this->view->display('index_index.htm');
		}
	}
	
	public function article() {
		
		$this->_checked['forum_list'] = ' class="checked"';
		
		$forumarr = $this->conf['forumarr'];
		$threadlists = $this->runtime->get('threadlists');
		if(empty($threadlists)) {
			foreach($forumarr as $fid=>$name) {
				if(!empty($forumarr[$fid])) {
					$access = $this->forum_access->read($fid, $this->_user['groupid']);
					if(!empty($access) && !$access['allowread']) {
						unset($forumarr[$fid]);
						continue;
					}
				}
				$threadlist = $this->thread->get_threadlist_by_fid($fid, 0, 0, 10, 0);
				foreach($threadlist as &$thread) {
					$thread['dateline_fmt'] = misc::minidate($thread['dateline']);
					$thread['subject_fmt'] = utf8::substr($thread['subject'], 0, 24);
				}
				$threadlists[$fid] = $threadlist;
			}
			$this->runtime->set('threadlists', $threadlists, 60); // todo:一分钟的缓存时间！这里可以根据负载进行调节。
		}
		$this->view->assign('forumarr', $forumarr);
		$this->view->assign('threadlists', $threadlists);
		$this->view->display('article_index.htm');
	}
	public function blog() {

	}
public function on_forumlist() {
$arr = array();
foreach($this->conf['forumarr'] as $fid => $name) {
		$forum = $this->mcache->read('forum', $fid);
		$ismod = $this->is_mod($forum, $this->_user);
		$arradd1 = !empty($forum['typecates'][1]) && (empty($forum['typecates_mod'][1]) || $forum['typecates_mod'][1] && $ismod) ? array('0'=>$forum['typecates'][1].'▼') : array();
		$arradd2 = !empty($forum['typecates'][2]) && (empty($forum['typecates_mod'][2]) || $forum['typecates_mod'][2] && $ismod) ? array('0'=>$forum['typecates'][2].'▼') : array();
		$arradd3 = !empty($forum['typecates'][3]) && (empty($forum['typecates_mod'][3]) || $forum['typecates_mod'][3] && $ismod) ? array('0'=>$forum['typecates'][3].'▼') : array();
		$arradd4 = !empty($forum['typecates'][4]) && (empty($forum['typecates_mod'][4]) || $forum['typecates_mod'][4] && $ismod) ? array('0'=>$forum['typecates'][4].'▼') : array();
		$typearr1 = empty($forum['types'][1]) || empty($arradd1) ? array() : $arradd1 + (array)$forum['types'][1];
		$typearr2 = empty($forum['types'][2]) || empty($arradd2) ? array() : $arradd2 + (array)$forum['types'][2];
		$typearr3 = empty($forum['types'][3]) || empty($arradd3) ? array() : $arradd3 + (array)$forum['types'][3];
		$typearr4 = empty($forum['types'][4]) || empty($arradd4) ? array() : $arradd4 + (array)$forum['types'][4];
$ta = array('fid' => $fid, 'name' => $name, 'types' => array());
$ta['types']['typeid1'] = array();
foreach($typearr1 as $k => $v) {
$ta['types']['typeid1'][] = array('id'=>$k, 'name' => $v);
}
$ta['types']['typeid2'] = array();
foreach($typearr2 as $k => $v) {
$ta['types']['typeid2'][] = array('id'=>$k, 'name' => $v);
}
$ta['types']['typeid3'] = array();
foreach($typearr3 as $k => $v) {
$ta['types']['typeid3'][] = array('id'=>$k, 'name' => $v);
}
$ta['types']['typeid4'] = array();
foreach($typearr4 as $k => $v) {
$ta['types']['typeid4'][] = array('id'=>$k, 'name' => $v);
}
$arr[] = $ta;
}
$this->message($arr);
}

	private function get_toplist($forum = array()) {
		$fidtids = array();
		// 3 级置顶
		$fidtids = $this->get_fidtids($this->conf['toptids']);
		
		// 1 级置顶
		if($forum) {
			$fidtids += $this->get_fidtids($forum['toptids']);
		}
		
		$toplist = $this->thread->mget($fidtids);
		return $toplist;
	}
	
	private function get_fidtids($s) {
		$fidtids = array();
		if($s) {
			$fidtidlist = explode(' ', trim($s));
			foreach($fidtidlist as $fidtid) {
				if(empty($fidtid)) continue;
				$arr = explode('-', $fidtid);
				list($fid, $tid) = $arr;
				$fidtids["$fid-$tid"] = array($fid, $tid);
			}
		}
		return $fidtids;
	}


	//hook index_control_after.php
}
?>