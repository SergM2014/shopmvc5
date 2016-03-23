<?php

  class Application_Controllers_Busket  extends Lib_BaseController 
  {
	   function index() {
		if(isset($_POST['order'])){
				
				$order=AppUser::cleanInput($_POST);
				$this->order=$order;
	    
					$model= new Application_Models_Order;
					$error=$model->insertBusket($order);
						
							if(!empty($error)){$this->error=$error;   }	
							else{
							Lib_SmalCart::getInstance()->deleteCookies(); 
							
							}
					     if(empty($error)) $this->success=1; 
						
					   }
			   
    } 
  }
//надо очистить корзину