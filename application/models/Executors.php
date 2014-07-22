<?php
namespace model\Executors;

require_once 'models/table/UsersTable.php';
use model\table\UsersTable;

const ROLE = 1;

function get($executor_id)
{
	return UsersTable\selectOne(array('id' => $executor_id, 'role' => ROLE));
}

function update($data, $user_id)
{
	return UsersTable\update($data, array("id" => $user_id));
}