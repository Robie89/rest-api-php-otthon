<?php
require_once 'database.php';

class CategoriesController
{
	public static function main()
	{
		$db = Database::Get();
		
		$params = ["visible" => get("visible", 1)];
		$sql = "SELECT category_id AS id, name, description FROM api__categories WHERE visible = :visible";
		
		$query = $db->prepare($sql);
		$query->execute($params);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		
		response($result);
		
	}
	public static function get($id)
	{
		if($id)
		{
			$db = Database::Get();
			$sql = "SELECT *, category_id AS id FROM api__categories WHERE category_id = :id";
			$query = $db->prepare($sql);
			$query->execute(["id" => $id]);
			$result = $query->fetch(PDO::FETCH_ASSOC);
			
		    response($result);
		}
        else 
		{ 
		    response("Wrong parameters", 400);	
		}
	}
	public static function create()
	{
		$values = 
		[
			"name" => post("name"),
			"description" => post("description")
		];
		if($values)
		{
		$db = Database::Get();
		$sql = "INSERT INTO api__categories VALUES (NULL, :name, :description, 1)";
		$query = $db->prepare($sql);
		$query->execute($values);
		
		response("Category created", 201);
		}
		else
		{
			response("Wrong parameters", 400);
		}
	}

}