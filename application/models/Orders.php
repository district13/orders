<?php
namespace model\Orders;

require_once 'models/table/OrdersTable.php';
use model\table\OrdersTable;

require_once 'models/Executors.php';
use model\Executors;

require_once 'models/table/UsersTable.php';
use model\table\UsersTable;

require_once 'models/table/XaCoordinator.php';
use model\table\XaCoordinator;

function getAllActive()
{
	return OrdersTable\select(array('status' => 0));	
}

function add($name, $price, $user_id)
{
	return OrdersTable\insert(array("name" => $name, "price" => $price, "customer_id" => $user_id));
}

function get($order_id)
{
	return OrdersTable\selectOne(array('id' => $order_id));
}

function run($order_id, $executor_id, $commission)
{
	$tables = array(OrdersTable\TABLE, UsersTable\TABLE);
	$func = 'model\Orders\runProcess';
	$args = array($order_id, $executor_id, $commission);
	return XaCoordinator\run($tables, $func, $args);
}

function runProcess($order_id, $executor_id, $commission)
{
	$whereOrders = array("id" => $order_id, "status" => 0);
	$order = OrdersTable\selectOne($whereOrders, true);
	$rowsUpdatedOrders = OrdersTable\update(
			array("status" => 1),
			$whereOrders
	);

	$executor = UsersTable\selectOne(array("id" => $executor_id), true);
	$executor["money"] += $order["price"] * $commission;
	$rowsUpdatedUsers =  Executors\update(
			array("money" => $executor["money"]), 
			$executor['id']
	);
	
	return $rowsUpdatedUsers && $rowsUpdatedOrders;
}
