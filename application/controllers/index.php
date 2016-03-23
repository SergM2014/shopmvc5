<?php
//контролер главной страницы
  class Application_Controllers_Index  extends Lib_BaseController 
  {
      function index() 
	  {  
      $model= new Application_Models_Index;
	  $mod1=$model->getSlider();
	  $mod2=$model->getCarousel();
	  $mod3=$model->isCarousel();
	  
	  
	   
	  $this->mod1=$mod1;
	  $this->mod2=$mod2;
	  $this->mod3=$mod3;
	  
	  Lib_SmalCart::getInstance()->getCokieCart();
	  }
	  
	  
  } 