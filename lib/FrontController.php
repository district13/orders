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
	
	_require_controller_file($controller);
	$callback = $controller  . 'Controller\\' . $action;
	if (function_exists($callback))
	{
		return call_user_func($callback, $request['params']);
	}
	else 
	{
		$callback =  $config['defaultController'] . 'Controller\\' . $config['defaultAction'];
		_require_controller_file($config['defaultController']);
		return call_user_func($callback, $request['params']);
	}
}

function _require_controller_file($name)
{
	$controller_file = '../application/controllers/' . $name . 'Controller.php';
	if(file_exists($controller_file))
	{
		require_once $controller_file;
	}
}

