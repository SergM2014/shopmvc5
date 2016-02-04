<?php

    require_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    


    $router=new Lib_Application; 

    $member=$router->Run();

    if(isset($member)){ extract($member, EXTR_OVERWRITE);}

	   

    require_once "./template/index.php";
?>
