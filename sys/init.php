<?php
$status = session_status();
if($status == PHP_SESSION_NONE)//check if it is needed to start session
{
	session_start();
}


include_once '../sys/dbcred.php';

//defining configuration constants
foreach( $A as $name => $val)
{
	define($name, $val);
}
$dbs = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
$dbo = new PDO($dbs, DB_USER, DB_PASS);

function __autoload($class){ //it will include all classes we need
	$filename = "../sys/class/class.".$class.".php";
	if(file_exists($filename))
	{
		include_once $filename; 
	}
}
