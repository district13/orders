<?php
namespace Http;

function get_request()
{
	list($path) = explode('?', $_SERVER['REQUEST_URI']);
	$path = trim($path, '/');
	$segments = array_filter(explode('/', $path));
	return array(
			"segments" => $segments,
			"params" => array_merge($_POST, $_GET, $_COOKIE),
	);
}