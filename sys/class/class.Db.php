<?php
class Db{
	//Contains database object
	protected $db;
	protected function __construct($db=NULL){
		if( is_object($db) )
		{
			$this->db = $db;
		}
		else 
		{
		
			 $dbn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
			 
			try
			{
				 $dbo = new PDO($dbn, DB_USER, DB_PASS);
			}
			catch (Exception $e) 
			{
				die($e->getMessage());
			}
		}
	}
}
