<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';


		$search=AppUser::cleanInput($_POST);
	
	  if(isset($_POST['id'])){
		  $id=$_POST['id'];
		 
		$model= new Application_Models_Product;
		
		$mod=$model->getProduct($id);
		
		
	$view=new Application_Views_Search;
	$view->showWindow($mod);
exit;	   
	  }
	  else{
$model=new Application_Models_Search;
$model->getSearch($search['search']);
      }