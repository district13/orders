<?php
namespace CustomerController;

require_once 'models/Orders.php';
use model\Orders;

require_once 'View.php';
use View;


function addorderform()
{
	View\render();
}

function addorder($params)
{
	if(!$params['name'] || !$params['price'])
	{
		echo View\errorMessage();
		return;
	}
	$result = Orders\add($params['name'], (int)$params['price'], $_SESSION['user_id']);
	echo View\message($result);
}
