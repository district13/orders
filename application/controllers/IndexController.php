<?php
namespace IndexController;

require_once 'View.php';
use View;

require_once 'services/AuthService.php';
use services\AuthService;

function index()
{
	View\render();
}

function login($params)
{
	$user = AuthService\login($params["name"], $params["pass"]);
	if(!$user) 
	{
		echo View\errorMessage();
		return;
	}
	$data = array(
			"id" => $user['id'],
			"name" => $user['name'],
			"role" => $user['role'],
			"money" => $user['money'],
	);
	
	echo View\message(true, $data);
}

function logout()
{
	AuthService\logout();
	echo View\message(true);
}