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
	$result = Orders\add($params['name'], $params['price'], $_SESSION['user_id']);
	echo json_encode(array("status" => $result));
}
