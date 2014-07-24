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

	