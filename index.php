<?php

/*
 * Copyright (C) xiuno.com
 * Copyright (C) qt06.com
 */

// 调试模式: 0:关闭; 1: 线上调试模式; 2: 本地开发详细调试模式;
define('DEBUG', 0);

// 有些环境关闭了错误显示
DEBUG && function_exists('ini_set') && @ini_set('display_errors', 'On');

// 站点根目录，在单元测试时候，此文件可能被包含
define('BBS_PATH', str_replace('\\', '/', dirname(__FILE__)).'/');
$domain = $_SERVER['HTTP_HOST'];
//去掉端口号
stripos($domain,':') && $domain = substr($domain,0,stripos($domain,':'));

// 加载应用的配置文件，唯一的全局变量 $conf
if(!@($conf = include BBS_PATH.'conf/'.$domain.'.conf.php')) {
if(!@($conf = include BBS_PATH.'conf/conf.php')) {
	header('Location:install/');
	exit;
}
}
if(empty($conf['installed'])) {
	header('Location:install/');
	exit;
}
include 'qacms_version.php';
define('QACMS_VERSION', '2.2.1');
if(QV != QACMS_VERSION) {
	exit('版本错误。');
}
 $conf['version'] = QV;
 
// 框架的物理路径
define('FRAMEWORK_PATH', BBS_PATH.'xiunophp/');

// 临时目录
define('FRAMEWORK_TMP_PATH', $conf['tmp_path']);

// 日志目录
define('FRAMEWORK_LOG_PATH', $conf['log_path']);

// 包含核心框架文件，转交给框架进行处理。
include FRAMEWORK_PATH.'core.php';
core::init($conf);
core::ob_start();
core::run($conf);
