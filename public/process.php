<?php
include_once '../sys/init.php';

$actions = ['change' =>
['method' => 'processActual', 'header' => 'Location: index.php'],
	    'delete' => 
['method' => 'processDelete', 'header' => 'Location: basket.php']
];


if(isset($actions[$_POST['action']]))
{
        $use_array = $actions[$_POST['action']];
        $obj = new Table($dbo);
        $method = $use_array['method'];
	if (TRUE === $msg = $obj->$method())
	{
		header($use_array['header']);
                exit;
	}
	else
	{
		die($msg);
	}
}
else
{
	header('Location: index.php');
}
