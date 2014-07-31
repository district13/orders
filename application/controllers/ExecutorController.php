<?php
namespace ExecutorController;
require_once 'View.php';
use View;

require_once 'services/AuthService.php';
use services\AuthService;

require_once 'models/Orders.php';
use model\Orders;

require_once 'models/Agent.php';
use model\Agent;

require_once 'models/Executors.php';
use model\Executors;

function orders()
{
	$orders = Orders\getAllActive();
	foreach ($orders as $order)
	{
		$ordersArray[] = array(
				"id" => $order['id'],
				"name" => $order['name'],
				"price" => $order['price'],
		);
	}
	echo json_encode($ordersArray);
}

function index()
{
	View\render('executor/index.phtml');
}

function work($params)
{
	if(!$params['order_id'])
	{
		echo View\errorMessage();
		return;
	}
	$commission = Agent\getCommission();
	$result = Orders\run($params['order_id'], $_SESSION['user_id'], $commission);
	echo View\message($result);
}

