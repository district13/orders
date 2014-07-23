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
	$order = Orders\get($params['order_id']);
	$executor = Executors\get($executor_id);
	$commission = Agent\getCommission();
//sleep(15);
	Orders\run($order, $executor, $commission);
//	Executors = Users\workOrder($order, $user, $commission);
// 	var_dump($isComplete);
	
}

