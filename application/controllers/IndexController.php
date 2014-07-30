<?php
namespace IndexController;

require_once 'View.php';
use View;

require_once 'services/AuthService.php';
use services\AuthService;

function index()
{
	View\render('index/index.phtml');
}

function loginform()
{
	View\render('index/loginform.phtml');
}

function login($params)
{
	$user = AuthService\login($params["name"], $params["pass"]);
	echo json_encode(array(
			"id" => $user['id'],
			"name" => $user['name'],
			"role" => $user['role'],
	));
}

function logout()
{
	AuthService\logout();
	echo json_encode(array("status" => 1));
}