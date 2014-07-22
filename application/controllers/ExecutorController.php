<?php
namespace ExecutorController;

require_once 'models/Orders.php';
use models\Orders;

function index()
{
	$orders = Orders\getAllActive();
	print_r($orders);
}