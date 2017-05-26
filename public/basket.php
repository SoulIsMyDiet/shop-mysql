<?php

include_once __DIR__.'/../sys/init.php';
$js_file = 'add.js';
$page_title = 'Oto Twoje piwka';

include_once 'common/header.php';
$tab = new Table($dbo);
echo $tab->createBasket();

include_once 'common/footer.php';
