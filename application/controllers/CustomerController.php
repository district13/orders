<?php
namespace CustomerController;

require_once 'models/Orders.php';
use model\Orders;

require_once 'View.php';
use View;


function addorderform()
{
	$orders = Orders\getAllActive();
	View\render('customer/addorderform.phtml');
}

function addorder($params)
{
	$name = "test455454";
	$price = 334;
$user_id = 1;	
	$result = Orders\add($name, $price, $user_id);
}
