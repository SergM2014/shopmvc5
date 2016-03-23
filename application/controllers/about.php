<?php
//контролер главной страницы
  class Application_Controllers_About extends Lib_BaseController 
  {
      function index() 
	  {  
      $model= new Application_Models_Admin;
	  $about=$model->getAbout();
	 
	  $this->about=htmlspecialchars_decode($about['about']);
	  }
	  
	  
  } 