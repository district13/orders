<?php
namespace model\table\Gateway;

require_once 'MysqlDriver.php';

require_once 'Config.php';
use Config;

function query()
{
	$args = func_get_args();
	
	$func = 'MysqlDriver\\' . array_shift($args);
	$link = get_connect(array_shift($args));
	array_unshift($args, $link);
	return call_user_func_array($func, $args);
}

function get_connect($server_id)
{
	static $resources;
	if(isset($resources[$server_id])) return $resources[$server_id];
	$config = Config\get();
	$dbConfig = $config["db"][$server_id];
	$link = mysqli_connect($dbConfig["host"], $dbConfig["user"], $dbConfig["pass"]);
	mysqli_select_db($link, $dbConfig["name"]);
	$resources[$server_id] = $link;
	return $link;
}
