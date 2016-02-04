<?php

  class Application_Controllers_updateCart  extends Lib_BaseController 
  {
      function index() 
	    { 
		if(isset($_POST['to_up'])){

			$arr=explode('&', $_POST['to_up']);
				foreach($arr as $one){
				$one = explode('=',$one);
				$arr1[$one[0]]=$one[1];
				}

		}

			if(!$arr1){header('Location:'. URL.'busket');}

;
				foreach($_SESSION['cart'] as $id=>$qty){
				
				if($_POST[$id] =='0' || $arr1[$id]==''){
				unset ($_SESSION['cart'][$id]);	
				}else{
				$_SESSION['cart'][$id] = $arr1[$id];

				}	
				}
				
			$controller=new Application_Controllers_Cart;
			$controller->totalItems($_SESSION['cart']);
			$controller->totalPrice($_SESSION['cart']);
			
			Lib_SmalCart::getInstance()-> setCartData();
			header('Location:'. URL.'busket');  
	    }
  } 