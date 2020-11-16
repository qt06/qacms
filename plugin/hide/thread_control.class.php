<?php

/*
 * Copyright (C) xiuno.com
 */

!defined('FRAMEWORK_PATH') && exit('FRAMEWORK_PATH not defined.');

include BBS_PATH.'control/common_control.class.php';

class thread_control extends common_control {
	
	function __construct(&$conf) {
		parent::__construct($conf);
		$this->_checked['bbs'] = ' class="checked"';
	}
	
	// 列表
	public function on_index() {
		
		// hook thread_index_before.php
		
		$fid = intval(core::gpc('fid'));
		$tid = intval(core::gpc('tid'));
		$uid = $this->_user['uid'];
		$page = misc::page();
		$thread = $this->thread->read($fid, $tid);
		$this->check_thread_exists($thread);
		$fpage = intval(core::gpc($this->conf['cookie_pre'].'page', 'C'));
		
		// 版块权限检查
		$forum = $this->mcache->read('forum', $fid);
		$this->check_forum_exists($forum);
		$this->check_access($forum, 'read');
		
		$this->thread->format($thread, $forum);
		
		// SEO 优化
		$this->_title[] = $thread['subject'];
		$this->_title[] = $forum['name'];
		foreach($forum['types'] as $cateid=>$types) {
			if($cateid == 1 && $thread['typeid1']) $this->_title[] = $thread['typename1'];
			if($cateid == 2 && $thread['typeid2']) $this->_title[] = $thread['typename2'];
			if($cateid == 3 && $thread['typeid3']) $this->_title[] = $thread['typename3'];
			if($cateid == 4 && $thread['typeid4']) $this->_title[] = $thread['typename4'];
		}
		
		// hook thread_index_fetch_before.php
		
		// 只缓存了 第一页20个pid，超出则查询 db
		$totalpage = ceil($thread['posts'] / $this->conf['pagesize']);
		$page > $totalpage && $page = $totalpage;
		$postlist = $this->post->index_fetch(array('fid'=>$fid, 'tid'=>$tid, 'page'=>$page), array(), 0, $this->conf['pagesize']);
		
		$postlist = array_filter($postlist);
		
		// php order by pid，一般情况下不用排序，但是偶尔数据库返回的数据为乱序。这里排序有问题！
		//ksort($postlist);	// key 为字符串，排序不稳定。 fid-2-pid-999 fid-2-pid-1000 这种情况
		misc::arrlist_multisort($postlist, 'dateline', TRUE); 	// 这里为兼顾 dx, pw 等升级过来的数据，他们的pid不是递增的，是 mysql_insert_id() 产生的。
		//misc::arrlist_multisort($postlist, 'pid', TRUE);	// 这个为 xiuno 的理想模式
		
		// 附件，用户
		$uids = $uid ? array($uid) : array();
		$i = ($page - 1) * $this->conf['pagesize'] + 1;
		$firstpost = array();
		foreach($postlist as &$post) {
			$this->post->format($post);
			if($post['attachnum'] > 0) {
				$post['attachlist'] = $this->attach->get_list_by_fid_pid($fid, $post['pid'], 0);
			}
			$post['floor'] = $i++;
			$uids[] = $post['uid'];
			
			if($post['rates'] > 0) {
				$post['ratelist'] = $this->rate->get_list_by_fid_pid($fid, $post['pid']);
			}
			empty($firstpost) && $firstpost = $post;
		}
		
		// 此处浪费一点点性能，为了迎合搜索引擎，现代搜索引擎应该无视这两个标签的。
		$this->_seo_keywords = htmlspecialchars($thread['subject']);
		$this->_seo_description = htmlspecialchars(utf8::substr(strip_tags($firstpost['message']), 0, 64));
		
		$uids = array_unique($uids);
		$userlist = $this->user->mget($uids);
		foreach($userlist as &$user) {
			if(empty($user)) continue;
			$this->user->format($user);
			$userlist[$user['uid']] = $user;
		}
		$uid && !empty($userlist[$uid]) && $this->_user = $userlist[$uid];
		$this->view->assign('userlist', $userlist);
		
		// 版主
		$ismod = $this->is_mod($forum, $this->_user);
		
		// 判断权限
		foreach($postlist as &$post) {
			$post['message'] = str_replace('<embed ','<embed autostart="false" ', $post['message']);
			if(!$ismod && !$this->mypost->have_tid($uid, $fid, $tid)) {
				$post['message'] = preg_replace('#\[hide\].*?\[/hide\]#is', '<p>'.$this->_user['username'] . ',隐藏内容需要回复后才能查看。</p>', $post['message']);
			} else {
				$post['message'] = preg_replace('#\[hide\](.*?)\[/hide\]#is', '<p>下面是隐藏内容：</p>\\1', $post['message']);
				//$post['message'] = preg_replace('#\[/?hide\]#is', '', $post['message']);
			}
			if(isset($userlist[$post['uid']]) && $userlist[$post['uid']]['groupid'] == 7) $post['message'] = '<span class="grey">用户被禁言，帖子被屏蔽。</span>';
		}
		
		// 版主管理日志，包含评分列表
		if($thread['modnum'] > 0) {
			$modlist = $this->modlog->get_list_by_fid_tid($fid, $tid);
			foreach($modlist as &$modlog) {
				$this->modlog->format($modlog);
				$modlog['user'] = $this->user->read($modlog['uid']);
				$this->user->format($modlog['user']);	
			}
			$this->view->assign('modlist', $modlist);
		}
		
		// 分页
		$pages = misc::pages("?thread-index-fid-$fid-tid-$tid.htm", $thread['posts'], $page, $this->conf['pagesize']);
		$views = $this->thread_views->read($tid);
		$views['views']++;
		$this->thread_views->update($views);
		$thread['views'] = $views['views'];
		
		// 点击数服务器 seo notfollow
		$click_server = $this->conf['click_server']."?db=tid&w=$tid&r=$tid";
		$scrollbottom = core::gpc('scrollbottom');
		

		// userlist
		$referer = core::gpc('HTTP_REFERER', 'S');
		$referer_other = '';
		if(strpos($referer, 'forum-index') === FALSE) {
			$referer_other = check::is_url($referer) ? $referer : ''; // 自己玩自己？
		}
		$this->view->assign('referer_other', $referer_other);
		
		$this->view->assign('click_server', $click_server);
		$this->view->assign('scrollbottom', $scrollbottom);
		$this->view->assign('fid', $fid);
		$this->view->assign('tid', $tid);
		$this->view->assign('page', $page);
		$this->view->assign('fpage', $fpage);
		$this->view->assign('pages', $pages);
		$this->view->assign('thread', $thread);
		$this->view->assign('forum', $forum);
		$this->view->assign('postlist', $postlist);
		$this->view->assign('ismod', $ismod);



		// hook thread_index_after.php
		if($this->format == "json") {
unset($thread['attachnum'],$thread['imagenum'],$thread['color'],$thread['icon'],$thread['ico_desc']);
			$pl = array();
foreach($postlist as $v) {
unset($v['attachnum'],$v['imagenum'],$v['userip']);
$pl[] = $v;
}
			$arr = array(
				'fid'=>$fid,
				'tid'=>$tid,
				'page'=>$page,
				'totalpage'=>ceil($thread['posts'] / 20),
				'thread'=>$thread,
				'postlist'=>$pl
			);
			$this->json($arr);
		}

		if($forum['type'] == "article") {
				$threadlist = $this->thread->get_threadlist_by_fid($fid, 0, 0, 10, 0);
				foreach($threadlist as &$rthread) {
					$rthread['dateline_fmt'] = misc::minidate($thread['dateline']);
					$rthread['subject_fmt'] = utf8::substr($thread['subject'], 0, 24);
				}
			$this->view->assign("threadlist",$threadlist);
			$post= $postlist['post-fid-' . $fid . '-pid-' . $thread['firstpid']];
			unset($postlist['post-fid-' . $fid . '-pid-' . $thread['firstpid']]);
			$this->view->assign('post',$post);



			$this->view->display("article_show.htm");
		} elseif($forum['type'] == 'blog') {
			$post= $postlist['post-fid-' . $fid . '-pid-' . $thread['firstpid']];
			unset($postlist['post-fid-' . $fid . '-pid-' . $thread['firstpid']]);
			$this->view->assign('post',$post);
			$this->view->display("blog_post.htm");
		} else {
			$this->view->display('thread_index.htm');
		}
	}
	
	//hook thread_control_after.php
}

?>