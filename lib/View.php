<?php
namespace View;

function render()
{
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


	