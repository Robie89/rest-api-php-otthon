<?php

class Database
{

private static $dbUser = "root";
private static $dbPass = "mysql";
private static $dbName = "api_otthon";

private static $pdo = null;

       public static function Get()
       {
       if (!self::$pdo)
	   {
		   $dsn = 'mysql:host=localhost;dbname='. self::$dbName .';charset=utf8mb4';
		   self::$pdo = new PDO($dsn, self::$dbUser, self::$dbPass);
		   self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	   }
       return self::$pdo;
       }
}