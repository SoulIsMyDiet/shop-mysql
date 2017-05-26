<?php

class Product{
private $_name;
private $_price;
private $_quantInBasket;
private $_priceOfProd;

public function __construct($name, $price, $quant){ 
$this->_name = $name;
$this->_price = $price;
$this->_quantInBasket = $quant;
$this->_priceOfProd = $price*$quant;
}
public function showProd($i){ //the html code for each product in table row in main shop page
return <<<PROD
<h3>$this->_name</h3>
<p>Cena: $this->_price golda</p>
<form action="process.php" method="post">
<input type="hidden" name="action" value="change" />
<input type="hidden" name="ses" class="hid" value="$this->_quantInBasket" />
<input type="text" name="val$i" value="$this->_quantInBasket" />
<input type="submit" name="basket" value="Zaktualizuj kosz" disabled />
<div class="button plus">+</div>
<div class="button minus">-</div>
</form>
PROD;
}
public function showProdInBasket($i){ //the html code for each product in table row in basket
return <<<PROD
<h3>$this->_name</h3>
<p>Cena sztuki: $this->_price golda</p>
<p>Łaczna cena: <e>$this->_priceOfProd </e> golda</p>
<form action="process.php" method="post">
<input type="hidden" name="action" value="delete" />
<input type="text" readonly="readonly" name="del$i" value="$this->_quantInBasket" />
<input type="submit" name="frombasket" value="usun z kosza" />
</form>
PROD;
}

};

