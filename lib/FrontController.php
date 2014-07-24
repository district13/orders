<?php
namespace FrontController;
	
require_once 'Http.php';
use Http;
		
require_once 'Config.php';
use Config;

function run()
{
	$request = \Http\get_request();
	$response = dispatch($request);
	echo $response;
}
	
function dispatch($request)
{
	$controller = ucfirst(isset($request['segments'][0]) ? $request['segments'][0] : "index");
	$action = isset($request['segments'][1]) ? $request['segments'][1] : "index" ;

	$config = Config\get();
	if(isset($config["plugins"]))
	{
		foreach ($config["plugins"] as $plugin)
		{
			require_once 'plugins/' . $plugin . '.php';
			$func = 'Plugins\\'. $plugin .'\\preDispatch';
			call_user_func_array($func, array(
			"controller" => $controller,
			"action" => $action,
			"params" => $request['params'],
			));
		}
	}
	
	$controller_file = '../application/controllers/' . $controller . 'Controller.php';
	if(file_exists($controller_file))
	{
		require_once $controller_file;
	}
		
	$callback = $controller  . 'Controller\\' . $action;
	if (function_exists($callback))
	{
		return call_user_func($callback, $request['params']);
	}
}
