<?php
require_once 'database.php';

class OrdersController
{
	public static function totalpieces()
	{	
		
	$db = Database::Get();	
	$sql = "SELECT SUM(pieces) AS TotalPiecesOrdered FROM api__orders";
	$query = $db->prepare($sql);
	$query->execute(array("1"));
	$result = $query->fetch(PDO::FETCH_ASSOC);
			
	response($result);

	
		
	}
	public static function totalprice()
	{
		$db = Database::Get();
		$sql = "SELECT SUM(prices) AS TotalPrice FROM api__orders";
		$query = $db->prepare($sql);
		$query->execute(array("1"));
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		response($result);
	}
}