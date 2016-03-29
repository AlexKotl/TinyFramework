<?
	session_start();
	
	include "classes/class_mysql.php";
	include "admin/functions.php";
	
	$db = new CMysql();
	$tpl = array();
		
	// include module
	$module = preg_replace('/([^a-z])/','',$_GET[module]);
	
	include "{$module}.php";
	
	if ($sys_message!='') $tpl[content] = "<div class='sys_message'>{$sys_message}</div>".$tpl[content];
		
	include 'tpl/main.tpl';
?>