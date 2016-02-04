<?php

  class Lib_SmalCart
  {
    protected static $instance; 
	private function __construct() {}	
	public static function getInstance() 
	{
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
    }
	
	public function  setCartData() 
	 {			
	  $cart_content = serialize($_SESSION['cart']); 
	 setcookie('cart',  $cart_content, time()+3600*24*365,"/");
	 }
	 
	 public function  setTotalItems() 
	 {			
	  $cart_content = serialize($_SESSION['total_items']); 
	  setcookie('total_items',  $cart_content, time()+3600*24*365,"/"); 
	 }
	 
	 public function  setTotalPrice() 
	 {			
	  $cart_content = serialize($_SESSION['total_price']); 
	  setcookie('total_price',  $cart_content, time()+3600*24*365,"/"); 
	 }
	
	public function  getCokieCart()
	 {
	 if($_COOKIE){
			$_SESSION['cart']=unserialize(stripslashes($_COOKIE['cart']));	
			$_SESSION['total_items']=unserialize(stripslashes($_COOKIE['total_items']));	
			$_SESSION['total_price']=unserialize(stripslashes($_COOKIE['total_price']));
			
	 }
	 }
	 public function deleteCookies(){
		setcookie('total_items','', 1,'/');	
		setcookie('total_price','', 1,'/');		
		setcookie('cart','', 1,'/');	
		 
	 }
	 
	
 }
?>