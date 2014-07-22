<?php
	
	namespace FrontController;
	
	require_once 'Http.php';
	use Http;
		
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
