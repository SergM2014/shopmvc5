<?php

  class Lib_Admincookies
  {
    protected static $instance; 
	private function __construct() {}	
	public static function getInstance() 
	{
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
    }
	
	public function  setAdminCookies() 
	 {			
	  $role = serialize($_SESSION['role']); 
	 setcookie('role',  $role, time()+3600*24*12,"/");
	
	 
	 $login=serialize($_SESSION['login']);
	 setcookie('login',$login,time()+3600*24*12,"/");
	 
	 }
	 
		
	public function  getAdminCookie()
	 {
	
	if($_COOKIE['role']){$_SESSION['role']=unserialize(stripslashes($_COOKIE['role']));}	
	if ($_COOKIE['login']){$_SESSION['login']=unserialize(stripslashes($_COOKIE['login']));}	
			
			
	 
	 }
	
	 public function destroyCookies(){
		 setcookie('role',  '', time()+1,"/");
		  setcookie('login','',time()+1,"/");
		unset($_SESSION['rememberme']);
	 }
	
 }
?>