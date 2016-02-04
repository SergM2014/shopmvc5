<?php
//контролер главной страницы
  class Application_Controllers_Search  extends Lib_BaseController 
  {
      function index() 
	  { 
	  if(isset($_POST['id'])){
		  $id=$_POST['id'];
		 
		$model= new Application_Models_Product;
		
		$mod=$model->getProduct($id);
		$mod2=$model->getProductImages($id);
		$view=new Application_Views_Search;
		$view->showWindow($mod, $mod2);
	exit;	   
	  }
		  else{
	$model=new Application_Models_Search;
	$model->getSearch();
		  }
		} 
  }