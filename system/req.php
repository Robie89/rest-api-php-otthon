<?php

function get($key, $default = null)
{
	if(isset($_GET[$key]) && ($_GET[$key]))
	{
		return $_GET[$key];
	}
	else
	{
		return $default;
	}
}
function getController()
{
	return get("controller");
}
function getAction()
{
	return get("action", "main");
}
function getParam()
{
	return get("param");
}
function post($key)
{
	if(isset($_POST[$key]))
	{
		$value = $_POST[$key];
		return htmlspecialchars($value);
	}
	return null;
}