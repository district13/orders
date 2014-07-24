<?php
namespace IndexController;

require_once 'View.php';
use View;
function index()
{
	View\render('index/index.phtml');
}
	