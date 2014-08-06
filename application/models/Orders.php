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

require_once 'models/table/TransactionTable.php';
use model\table\TransactionTable;
use model\table\XaCoordinator\rollback;

const START = 1,
	  PREPARE = 2,
	  COMMIT = 3,
	  START_ROLLBACK = 4,
	  END_ROLLBACK = 5;

function getAllActive()
{
	return OrdersTable\select(array('status' => 0, 'transaction_id' => 0));	
}

function add($name, $price, $user_id)
{
	return OrdersTable\insert(array('name' => $name, 'price' => $price, 'customer_id' => $user_id));
}

function get($order_id)
{
	return OrdersTable\selectOne(array('id' => $order_id));
}

function run($order_id, $executor_id, $commission)
{
	//read
	$memcached = _getMemcached(); 
	$lockOrder = $memcached->add('order_lock:' . $order_id, 1);
	$lockExecutor = $memcached->add('executor_lock:' . $executor_id, 1);
	if(!$lockOrder || !$lockExecutor) 
	{
		if($lockOrder) 	$memcached->delete('order_lock:' . $order_id);
		if($lockExecutor) $memcached->delete('executor_lock:' . $executor_id);
		return fail();
	}

	$whereOrders = array('id' => $order_id, 'status' => 0, 'executor_id' => 0, 'transaction_id' => 0);
	$order = OrdersTable\selectOne($whereOrders);
	$whereExecutor = array('id' => $executor_id, 'transaction_id' => 0);
	$executor = UsersTable\selectOne($whereExecutor);
	if(!$order || !$executor)
	{
		_unlockTransaction($order_id, $executor_id);
		return fail();
	}
	
	$money = $executor['money'] + round($order['price'] * $commission);
	
	
	
	//0
	$transaction_id = TransactionTable\insert(array(
				'executor_id' => $executor_id,
				'order_id' => $order_id,
				'executor_data' => serialize(array('money' => $executor['money'])),
				'order_data' => serialize(array('status' => $order['status'], 
												'executor_id' => $order['executor_id'], 
				)),
				'status' => START,
	));
	if(!$transaction_id) return fail();
	
	
	
	//1 phase
	$updateOrders = OrdersTable\update(
			array('status' => 1, 
				  'executor_id' => $executor_id, 
				  'transaction_id' => $transaction_id, 
			), 
			array_merge($whereOrders)
	);
	$updateExecutor = UsersTable\update(
			array('money' => $money,
				  'transaction_id' => $transaction_id,
			),
			array_merge($whereExecutor)
	);
	
	if(!$updateExecutor || !$updateOrders) return rollback($transaction_id);
	
	$isPrepare = TransactionTable\update(array("status" => PREPARE), array("id" => $transaction_id));
	
	$updateOrders = OrdersTable\update(
			array("transaction_id" => 0), 
			array("id" => $order["id"])
	);
	$updateExecutor = UsersTable\update(
			array("transaction_id" => 0), 
			array("id" => $executor["id"])
	);
	if(!$updateOrders || !$updateExecutor || !$isPrepare) return rollback($transaction_id);
	
	
	//2 phase
	TransactionTable\update(array("status" => COMMIT), array("id" => $transaction_id));

	_unlockTransaction($order_id, $executor_id);
	return array("process" => true, "money" => $money);
}

function rollback($transaction_id)
{
	TransactionTable\update(array("status" => START_ROLLBACK), array("id" => $transaction_id));
	$transactionData = TransactionTable\selectOne(array("id" => $transaction_id));

	$orderData = array_merge(unserialize($transactionData["order_data"]), array("transaction_id" => 0));
	$r1 = OrdersTable\update($orderData, array("id" => $transactionData["order_id"]));

	$executorData = array_merge(unserialize($transactionData["executor_data"]), array("transaction_id" => 0));
	$r2 = UsersTable\update($executorData, array("id" => $transactionData["executor_id"]));
	
	if($r1 && $r2)
	{
		TransactionTable\update(array("status" => END_ROLLBACK), array("id" => $transaction_id));
	}

	_unlockTransaction($transactionData["order_id"], $transactionData["executor_id"]);
	return fail();
}

function _unlockTransaction($order_id, $executor_id)
{
	$memcached = _getMemcached();
	$memcached->delete('order_lock:' . $order_id);
	$memcached->delete('executor_lock:' . $executor_id);
}

function _getMemcached()
{
	static $instance;
	if(!$instance) 
	{
		$instance = new \Memcached();
		$instance->addServer('localhost', 11211);
	}
	return $instance;
}

function fail()
{
	return array("process" => false);
}


















