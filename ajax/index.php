<?
	session_start();
	
	$ajax_mode = true;
	
	include "../classes/class_mysql.php";
	include "../admin/functions.php";
	
	$db = new CMysql();	

	// include module
	$module = preg_replace('/([^a-z_])/','',$_GET[module]);
	if ($module=='') $module = '';		
	
	include "{$module}.php";
	
	
?>