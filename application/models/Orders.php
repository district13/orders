<?php
namespace models\Orders;

require_once 'models/table/OrdersTable.php';
use models\table\OrdersTable;

function getAllActive()
{
	return OrdersTable\select(array('status' => 0));	
}