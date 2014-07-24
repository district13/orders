<?
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
	
	define('LIB_PATH', '../lib/'); 
	define('APP_PATH', '../application/');
	set_include_path(implode(PATH_SEPARATOR,
		array(LIB_PATH, APP_PATH, get_include_path()))
	);
	
	require_once 'FrontController.php';
	\FrontController\run();