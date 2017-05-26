<?php
class Table extends Db{
public $howMany;//this is the number of the products to sale
public function __construct($dbo=NULL, $howmany=5){
                parent::__construct($dbo);
		$this->howMany = $howmany;
}

public function createTable(){ //this method builds an table with the product available in it
$object = $this->_createObjects(); //look below #1private method
$rows = '';
for($i = 0; $i < $this->howMany; $i++) //dependly on "how many" products wehave to sell we gonna make as much table rows to put the products inside
{
$row = "<tr>\n<td>".$object[$i]->showProd($i)."\n</td>\n</tr>"; //making an html code...
$rows.=$row; //...and joining it together
}
$title = "<h2>Zrób zakupy</h2>\n";
$html = "<table>".$rows."</table>";
$link = "<a href='basket.php'>Wejdź w koszyk</a>\n";
return $title.$link.$html; //returning html code to the main page of the shop
}

public function createBasket(){ //this method builds an table with products we already bought in the shop
$object = $this->_reduceObjects();//look below #2private method
$rows = '';
foreach($object as $key => $obj) //we do a loop for each kind of product we bought
{
$row = "<tr>\n\t<td>".$obj->showProdInBasket($key)."\n\t</td>\n</tr>";//next rows similarly as in method above
$rows.=$row;
}
$title = "<h2>Twój kosz</h2>\n"; 
$link = "<a href='index.php'>Wróć do zakupów</a>\n";
$html = "<table>\n".$rows."\n</table>";
return $title.$link.$html;
}

public function processActual(){//this method saves our shopping to session table
if ($_POST['action']!='change') //if for some reason someone wil get to the process file without using the form
        {
                return "Nieprawidłowe użycie";
        }

for($i=0; $i<$this->howMany; $i++) //dependly on "how many" products we have inshop we gonna check that many prod to check which product someone just bought
{
if (isset($_POST["val$i"])){ //the product which was soled have the right "$_POST" set ...
$val = $_POST["val$i"];
$val = preg_replace('/[^0-9]/','', $val);
$_SESSION["val$i"] = $val; //and then we change the apropriate session value
}
}
return TRUE;
}

public function processDelete(){ //this similar method as this above save our decision about deleting the product from basket
if ($_POST['action']!='delete')//next rows are similar as in the method above
        {
                return "Nieprawidłwe użycie";
        }

for($i=0; $i<$this->howMany; $i++)
{
if (isset($_POST["del$i"]))
$_SESSION["val$i"] = 0;//the differnese here is that we change session value to 0 because 0 means nothing and it gonna disapear from basket
}
return TRUE;
}

private function _createObjects(){//before we gonna build our main page we gonna need the products so we gonna create them here
$beers = $this->_DbTable();// see below 3#private method
$obj = [];
for($i = 0; $i < $this->howMany; $i++) //depend... 
{
$beer = $beers[$i]; //for each loop we gonna pull one array from the array of arrays builded in _DbTable method
$obj[$i] = new Product($beer['Name'], $beer['Price'], $_SESSION["val$i"]);//for eche loop we gonna make one product with data from array we pulled line above
}
return $obj; // we are returning the array of objects
}

private function _reduceObjects(){ //probably in the basket there will be less kind of product than in shop so we gonna reduce this amount with these method
$bigarray = $this->_createObjects();
$pointer = $_SESSION;
function reduce($pointer, $bigarray){ //function we use in array_mapping below
if($pointer > 0) return $bigarray;
}
$smallarray = array_map("reduce", $pointer, $bigarray); // we compare each session value with products in shop, and if customer bought the product it will mean that value of session is more than 0. so we gonna return only this prod with more then 0 in session value

$smallarray = array_filter($smallarray, function($obj){ // ...but we need to cut the table that it will have as much cells as products we bought
return ($obj != NULL); 
});
return $smallarray; //so we return this smaller array
}
private function _DbTable (){ //this method build an array of arrays from database with product data
$sql = "SELECT * FROM beer_table";
//$sql = "select * from beer_table order by random()";
try
{
$stmt = $this->db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);   
$stmt->closeCursor();
return $results;
}
catch(Exception $e)
{
die($e->Message());
}
}
};
