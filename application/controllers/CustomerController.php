<?php
namespace CustomerController;

require_once 'models/Orders.php';
use model\Orders;

function index()
{
	echo "customer/index";
}

function addorder($params)
{
	$name = "test455454";
	$price = 334;
$user_id = 1;	
	$result = Orders\add($name, $price, $user_id);
}
