<?php
namespace model\table\OrdersTable;

require_once 'models/table/Gateway.php';
use model\table\Gateway;

const DB = 'orders',
	  TABLE = 'orders';

function select($where, $lock = false)
{
	return Gateway\query('select', DB, TABLE, $where, $lock);
}

function insert($data)
{
	return Gateway\query('insert', DB, TABLE, $data);
}

function update($data, $where)
{
	return Gateway\query('update', DB, TABLE, $data, $where);
}

function selectOne($where, $lock)
{
	return current(select($where, $lock));
}