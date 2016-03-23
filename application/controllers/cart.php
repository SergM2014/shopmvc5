<?php
//контролер главной страницы
  class Application_Controllers_Cart  extends Lib_BaseController 
  {
      function index() 
	{
		 if(isset($_POST['id'])){
		$id=$_POST['id'];
		$this->addToCart($id);
		}
		
		$this->totalItems($_SESSION['cart']);//подсчитать количество штук с занесением в сесию
		$this->totalPrice($_SESSION['cart']);//подсчитать общую цену
		
	?>
		<img src="img/korzina.jpg" >
		<a href="#" id="show_busket" data-toggle="modal" data-target=".bs-example-modal-lg" >Корзина</a>&nbsp;&nbsp;&nbsp;Количество товара:<span><?php echo (!$_SESSION['total_items']) ? 0: $_SESSION['total_items']  ?></span
		>&nbsp;&nbsp;&nbsp;На сумму:<span><?php echo (!$_SESSION['total_price']) ?  0 :  $_SESSION['total_price']  ?>грн</span>
	<?php	exit;


	}
 
	 function addToCart($id){
		if(isset($_SESSION['cart'][$id])) {
		$_SESSION['cart'][$id]++;
			
		}
		else{
		$_SESSION['cart'][$id]=1;	
		}
		
		Lib_SmalCart::getInstance()->setCartData();
		
	 }



	function totalItems($cart){
		$num_items=0;
		foreach($cart as $id=>$qty){
		$num_items+=$qty;	
		}
		$_SESSION['total_items']= $num_items;
		Lib_SmalCart::getInstance()->setTotalItems();	
	}
 


	function totalPrice($cart){
		$mod= new Application_Models_Cart;
		
		$price=0.00;
		if(is_array($cart)){
		foreach($cart as $id=>$qty)	{
		$item_price= $mod->getPrice($id);
		$price +=$item_price*$qty;	
		}
		}
		$_SESSION['total_price']= $price;
		Lib_SmalCart::getInstance()->setTotalPrice();	
		return false;
	}
 
 
 
 
  } 