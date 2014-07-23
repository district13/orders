<?php
namespace model\table\UsersTable;

require_once 'models/table/Gateway.php';
use model\table\Gateway;

const DB = 'users',
	  TABLE = 'users';

function select($where, $lock)
{
	return Gateway\query('select', DB, TABLE, $where, $lock);
}

function selectOne($where)
{
	return current(Gateway\query('select', DB, TABLE, $where));
}

function update($data, $where)
{
    return Gateway\query('update', DB, TABLE, $data, $where);
}