<?php
namespace MysqlDriver;

use model\table\UsersTable\update;
function select($connect, $table, $where = array())
{		
	$sqlWhere = getWhere($where);
	$sql = "select * from $table $sqlWhere";
	
	$query = mysqli_query($connect, $sql);
	$data = array();
	while($row = mysqli_fetch_assoc($query))
	{
		$data[] = $row;
	}
	return $data;
}

function insert($connect, $table, $data)
{
	$columns = implode(',', array_keys($data));
	$values = quote(array_values($data));
	$sql = "insert into $table ($columns) values ($values)";
echo $sql;	
	return mysqli_query($connect, $sql);
}

function update($connect, $table, $data, $where)
{
	$sql_where = getWhere($where);
	
	$set = array();
	foreach ($data as $column => $value)
	{
		$set[] = $column . ' = ' . quote($value);
	}
	$set = implode(', ', $set);
	$sql = "update $table set $set $sql_where";
	mysqli_query($connect, $sql);
}

function getWhere($where = array())
{
	$sql = array();
	foreach ($where as $column => $value)
	{
		$sql[] = $column . ' = ' . quote($value);
	}
	return $sql ? 'where ' . implode(' and ', $sql) : '';
}

function quote($value)
{
	$value = str_replace(
				array( '\\', '\0', '\n', '\r', '\'', '"', '\x1a' ),
				array( '\\\\', '\\0', '\\n', '\\r', '\\' . '\'', '\\"', '\\Z' ),
				$value 
			);
	if (is_array($value))
	{
		$value = implode('\', \'', $value);
	}
	return '\'' . $value . '\'';
	
}

