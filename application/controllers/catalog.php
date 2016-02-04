<?php

  class Application_Controllers_Catalog extends Lib_BaseController
  {
     function index()
	 {
		
	$model= new Application_Models_Catalog;
	
	$mod1=$model->getContent();
	$mod2= $model->getpageNumber();
    $cat_tree=Lib_Category::getInstance()->getCat_Tree_Catalog();
    $manufacturer_tree=Lib_Manufacturer::getInstance()->getManufacturerTree_Catalog();
	$url=Url::freefromP();
	$clearurl=Url::fullclearUrl();
	$adjective=Url::makeclear($url);
	
	
	if(isset($mod1))$this->mod1=$mod1;
	if(isset($mod2))$this->mod2=$mod2;
	$this->cat_tree=$cat_tree;
	$this->manufacturer_tree=$manufacturer_tree;
	$this->url=$url;
	
	$this->clearurl=$clearurl;
	$this->adjective=$adjective;
  }
  }