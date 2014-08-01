<?php
namespace model\table\OrdersTable;

require_once 'models/table/Gateway.php';
use model\table\Gateway;

const SERVER_ID = '2',
	  TABLE = 'orders';

function select($where)
{
	return Gateway\query('select', SERVER_ID, TABLE, $where);
}

function insert($data)
{
	return Gateway\query('insert', SERVER_ID, TABLE, $data);
}

function update($data, $where)
{
	return Gateway\query('update', SERVER_ID, TABLE, $data, $where);
}

function selectOne($where)
{
	return current(select($where));
}