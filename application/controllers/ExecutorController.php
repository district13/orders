<?php
namespace ExecutorController;

require_once 'models/Orders.php';
use model\Orders;

require_once 'models/Agent.php';
use model\Agent;

require_once 'models/Executors.php';
use model\Executors;

function index()
{
	$orders = Orders\getAllActive();
print_r($orders);	
}

function work($params)
{
$executor_id = 1;
$params["order_id"] = 1;
	$commission = Agent\getCommission();
//sleep(15);
	Orders\run($params["order_id"], $executor_id, $commission);
//	Executors = Users\workOrder($order, $user, $commission);
// 	var_dump($isComplete);
	
}

