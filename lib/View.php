<?php
namespace View;

function render($template, $data = array())
{
	extract($data);
	ob_start();
	require 'views/' . $template;
	$content = ob_get_clean();
	
	ob_start();
	require_once 'layout/layout.phtml';
	echo ob_get_clean();
}

function message($value, $data = array())
{
	$resultArray = array("status" => $value);
	if($data) $resultArray["data"] = $data;
	return json_encode($resultArray);
}

function errorMessage()
{
	return json_encode(array("status" => 0));
}


	