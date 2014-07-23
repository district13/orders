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

function run($order, $executor, $commission)
{
	$executor["money"] += $order["price"] * $commission;
	
	$tables = array(OrdersTable\TABLE, UsersTable\TABLE);
	$func = 'model\Orders\runProcess';
	$args = array($executor, $order);
	return XaCoordinator\run($tables, $func, $args);
}

function runProcess($executor, $order)
{
	$whereOrders = array("id" => $order['id'], "status" => 0);
	OrdersTable\select($whereOrders, true);
	$rowsUpdatedOrders = OrdersTable\update(array("status" => 1), array("id" => $order['id'], "status" => 0));
	
	UsersTable\select(array("id" => $executor['id']), true);
	$rowsUpdatedUsers =  Executors\update(array("money" => $executor["money"]), $executor['id']);
	return $rowsUpdatedUsers && $rowsUpdatedOrders;
}
