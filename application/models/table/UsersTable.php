<?php
namespace model\table\UsersTable;

require_once 'models/table/Gateway.php';
use model\table\Gateway;

const SERVER_ID = '1',
	  TABLE = 'users';

function select($where, $lock = false)
{
	return Gateway\query('select', SERVER_ID, TABLE, $where, $lock);
}

function selectOne($where, $lock = false)
{
	return current(select($where, $lock));
}

function update($data, $where)
{
    return Gateway\query('update', SERVER_ID, TABLE, $data, $where);
}