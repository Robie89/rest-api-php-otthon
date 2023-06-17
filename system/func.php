<?php

function errorInfo($on = true)
{
	if($on)
	{
		ini_set("display_errors", "On");
		error_reporting(E_ALL);
	}
	else
	{
		ini_set("display_errors", "Off");
		error_reporting(0);
	}
}
function setupHeaders()
{
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=utf-8");
}
function response($data, $code = 200)
{
	http_response_code($code);
	echo json_encode($data, JSON_UNESCAPED_UNICODE);
	exit;
}
function serve($controller, $action, $param)
{
	$file = "api/". $controller ."-controller.php";
	if(is_file($file))
	{
		require_once $file;
		$className = ucfirst($controller)."Controller";
		if(class_exists($className))
		{
			if(method_exists($className, $action))
			{
				try
				{
					$className::$action($param);
				} 
				catch (Exception $ex) 
				{
                    $msg = $ex->getMessage();
					response("Technical error: ". $msg, 500);
				}
			}
			else
			{
				response("Wrong parameters", 400);
			}
		}
	}
	else
	{
		response("Resource not found", 404);
	}
}