<?php
require_once "database.php";

class ProductsController
{
	public static function main($categoryId = null)
	{
		$db = Database::Get();
		$params = ["done" => get("done", "yes")];
		
		$sql = "SELECT *, product_id AS id FROM api__products WHERE done = :done";
		
	if($categoryId)
	{
		$sql .= " AND category = :category";
		$params ["category"] = $categoryId;
	}
		$query = $db->prepare($sql);
		$query -> execute($params);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        response($result);		
	}
	public static function notdone($categoryId = null)
	{
		$db = Database::Get();
		$params = ["done" => get("done", "no")];
		
		$sql = "SELECT *, product_id AS id FROM api__products WHERE done = :done";
		
	if($categoryId)
	{
		$sql .= " AND category = :category";
		$params ["category"] = $categoryId;
	}
		$query = $db->prepare($sql);
		$query -> execute($params);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        response($result);		
	}
	public static function create()
	{
		
		$values = 
		[
		"name" => post("name"),
		"category" => post("category"),
		"caracteristics" => post("caracteristics"),
		"price" => post("price"),
		"done" => post("done")
		];
		
		if($values)
		{
		$db = Database::Get();
		$sql = "INSERT INTO api__products VALUES (NULL, :name, :category, :caracteristics, :price, :done)";
		$query = $db->prepare($sql);
		$query->execute($values);
		
		response("Product created", 201);
		var_dump($sql);
		}
		else
		{
			response("Wrong parameters", 400);
		}
	}
	
	
}