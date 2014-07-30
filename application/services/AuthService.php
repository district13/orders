<?php
namespace services\AuthService;

require_once 'models/table/UsersTable.php';

use model\table\UsersTable;

function login($name, $pass)
{
	$user = current(UsersTable\select(array("name" => $name, "pass" => md5($pass))));
	if(!$user) return false;
	$_SESSION = array("user_id" => $user['id'], "name" => $user['name'], "role" => $user['role']);
	return $user;
}

function logout()
{
	
}