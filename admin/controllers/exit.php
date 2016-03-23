<?php
//контролер главной страницы
  class Admin_Controllers_Exit  extends Lib_BaseController 
  {
      function index() 
	  { 
	  //print_r($_SESSION); 
unset($_SESSION['role']);

unset($_SESSION['login']);	
//echo Url;
header("Location:".URL);
exit;
      }
  } 