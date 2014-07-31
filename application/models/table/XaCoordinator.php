<?php 
namespace model\table\XaCoordinator;

require_once 'models/table/Gateway.php';
use \model\table\Gateway;

function run($tables, $func, $args)
{
	$connections = array();
	foreach ($tables as $table)
	{
		$connect= Gateway\get_connect($table);
		mysqli_query($connect, "SET AUTOCOMMIT=0");
		$connections[] = $connect;
	}

	$xid = getXid();
	query($connections, "XA START", $xid);
	$data = call_user_func_array($func, $args);
	query($connections, "XA END", $xid);
	
	if(!$data["process"]) return rollback($connections, $xid);
	
	foreach ($connections as $connect)
	{
		$prepare = mysqli_query($connect, "XA PREPARE '$xid'");
		if(!$prepare) return rollback($connections, $xid);
	}
	query($connections, "XA COMMIT", $xid);
	return $data;
	
}

function rollback($connections, $xid)
{
	query($connections, "XA ROLLBACK", $xid);
	return array("process" => false);
}


function getXid()
{
	$xid = uniqid();
	return $xid;
}

function query($connections, $command, $xid)
{
	foreach($connections as $connect)
	{
		mysqli_query($connect, "$command '$xid'");
	}
}