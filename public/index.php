<?php
include_once '../sys/init.php';
$js_file = 'index.js';
$page_title = "Kup se pare piwek";
$tab = new Table($dbo);

for($j =0; $j <$tab->howMany; $j++)
{
if(!isset($_SESSION["val$j"])) $_SESSION["val$j"]=0;
}

include_once 'common/header.php';

echo $tab->createTable();
include_once 'common/footer.php';
