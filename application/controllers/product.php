<?php
//контролер обрабатывает данные каталога
  class Application_Controllers_Product extends Lib_BaseController
  {
     function index()
	 {
		
	$model= new Application_Models_Product;
    $id=intval($_GET['article']);
	$_SESSION['id']=$id;
	$mod1=$model->getProduct($id);
	
	$this->mod1=$mod1;
	
	
  }
  }