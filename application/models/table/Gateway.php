<?php
namespace model\table\Gateway;

require_once 'MysqlDriver.php';

function query()
{
	$args = func_get_args();
	
	$func = 'MysqlDriver\\' . array_shift($args);
	$link = get_connect(array_shift($args));
	array_unshift($args, $link);
	return call_user_func_array($func, $args);
}

function get_connect($db)
{
	static $resources;
if($db == 'orders') return testconnect($db);
	if(isset($resources[$db])) return $resources[$db];
	$link = mysqli_connect("localhost", "root", "123");
	mysqli_select_db($link, $db);
	$resources[$db] = $link;
	return $link;
}

function testconnect($db)
{
	static $resources;

	if(isset($resources[$db])) return $resources[$db];
	$dbh = mysqli_connect("188.120.244.226", "root", "123");
	mysqli_select_db($dbh, $db);
	$resources[$db] = $dbh;
	return $dbh;
}
