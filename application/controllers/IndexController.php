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
	AuthService\login($params["name"], $params["pass"]);
}