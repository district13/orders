<?php
namespace SqlAdapter;

function select($connect, $table, $where = array())
{		
	$sql = array();
	foreach ($where as $column => $value)
	{
		$sql[] = $column . ' = ' . quote($value);
	}
	$sqlWhere = $sql ? 'where ' . implode(' and ', $sql) : '';
	$sql = "select * from $table $sqlWhere";
	
	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_assoc($query))
	{
		$data[] = $row;
	}
	return $data;
}

function quote($str)
{
	return "'". str_replace(
			array( '\\', "\0", "\n", "\r", "'", '"', "\x1a" ),
			array( '\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z' ),
			$str ) . "'";
}

