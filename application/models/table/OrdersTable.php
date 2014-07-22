<?php
namespace model\table\OrdersTable;

require_once 'models/table/Gateway.php';
use model\table\Gateway;

const DB = 'orders',
	  TABLE = 'orders';

function select($where)
{
	return Gateway\query('select', DB, TABLE, $where);
}

function insert($data)
{
	return Gateway\query('insert', DB, TABLE, $data);
}

function update($data, $where)
{
	return Gateway\query('update', DB, TABLE, $data, $where);
}

function selectOne($where)
{
	return current(Gateway\query('select', DB, TABLE, $where));
}