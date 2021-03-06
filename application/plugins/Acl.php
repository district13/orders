<?php
namespace Plugins\Acl;

require_once 'models/table/UsersTable.php';
use model\table\UsersTable;
 
function preDispatch($controller, $action, $params)
{
	$securityResources = array("Executor", "Customer");
	if(array_search($controller, $securityResources) === false) return true;
	
	if(isset($_SESSION['user_id']))
	{
		$user = UsersTable\selectOne(array("id" => $_SESSION['user_id']));
		$tableRoles = array(0 => "guest", 1 => "executor", 2 => "customer");
		$role = $tableRoles[$user["role"]];
	}
	else 
		$role = 'guest';


	$rules = array(
			"guest" => array("Index"),
			"executor" => array("Executor", "Index"),
			"customer" => array("Customer", "Index")
	);
	if(array_search($controller, $rules[$role]) === false)
	{
		die('access denied');
	}
}