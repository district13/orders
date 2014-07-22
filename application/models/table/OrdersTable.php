<?php
namespace models\table\OrdersTable;

require_once 'models/table/Gateway.php';
use model\table\Gateway;

const DB = 'orders',
	  TABLE = 'orders';

function select($where)
{
	return Gateway\query('select', DB, TABLE, $where);
}