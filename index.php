<?php
	require_once  $_SERVER['DOCUMENT_ROOT']."/config.php"; 


	$router=new Lib_Application; 

	$member=$router->Run();

	if(isset($member)){ extract($member, EXTR_OVERWRITE);}

	require_once  $_SERVER['DOCUMENT_ROOT']."/function.php";
//смотрим есть аякс илинет
	if(isset($_POST['ajax']))
	{ require_once $_SERVER['DOCUMENT_ROOT']."/template/ajax.php";}
	else { require_once  $_SERVER['DOCUMENT_ROOT']."/template/index.php";}

?>