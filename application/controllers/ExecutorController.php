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

function index()
{
	$orders = Orders\getAllActive();
	View\render('executor/index.phtml');
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

