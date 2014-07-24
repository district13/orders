<?php
namespace services\AuthService;

require_once 'models/table/UsersTable.php';

use model\table\UsersTable;

function login($name, $pass)
{
	$user = current(UsersTable\select(array("name" => $name, "pass" => md5($pass))));
	if(!$user) return false;
	$_SESSION['user_id'] = $user['id'];
	return $user;
}

function logout()
{
	
}