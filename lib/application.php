<?php

 class Lib_Application  //класс маршрутизатор, подбирает нужный контролер для обработки данных
 {
	 private function getRoute(){
	 
	 $url=trim($_SERVER['REQUEST_URI'],'/');
	$arr=explode('/',$url);

		if(!is_array($arr)) { $url[0]=$arr;}else {$url=$arr;}
	
		if(isset($url[0]) && $url[0]=="admin")
			{ if(!isset($url[1]))$url[1]="index";
	  
				if(!isset($url[2])) $url[2]='index';
	  
				if(!isset($_SESSION['login']) ){$url[1]='index'; $url[2]='index';}
			}
		else{
				if(!isset($url[0]) or $url[0]==FALSE )$url[0]='index';
	 
				if(!isset($url[1]) )$url[1]='index';
	        }
	//блок который просматривает адрес и отбрасывает от него $_GET переменные
	            foreach ($url as $key=> $value){
				$find=strpos($value, '?');
				if($find==true){
				$arr=explode('?',$url[$key]);
				$url[$key]=$arr[0];
				}
				}

	//исключение для корзины которая всегда на аяксе
				if($url[0]=='busket' ) $_POST['ajax']=true;
	
	return $url;
	 }

  

    private function getController()//получить контролер
	{       
       $route=$this->getRoute();
	   
		$controller=array();
	   if($route[0]=='admin'){
		   $path_contr = 'admin/controllers/';
		 //защита против неавторизированого входа
		    if(!isset($_SESSION['login']) && !isset($_SESSION['role'])) {$route[1]='index'; $route[2]='index';}
		 
		   $controller[0]= $path_contr.$route[1].'.php';
		   
	   }else{
		   $path_contr = 'application/controllers/';
		 
		   $controller[0]= $path_contr.$route[0]. '.php';
	   } 
      
	   if(is_array($route)){ $controller[1]=array_pop($route);}

       return $controller;
    }
	
	 
	public function getView()//получить представление для контролера
	{
       $route=$this->getRoute();
	 
	   if($route[0]=='admin'){
	   
		   $path_view = $_SERVER['DOCUMENT_ROOT'].'/admin/views/' ;

		   $view = $path_view.$route[1].'/'.$route[2].'.php';
		
	  
	   }else{
		   $path_view = 'application/views/' ;
		   
		   $view = $path_view.$route[0]. '.php';
	   }

       return $view;
    }
	 
	public function Run()// запуск процесса обработки данных
	{ 
	   session_start(); 
	   
     if(!isset($_SESSION['cart'])){
		$_SESSION['cart']=array();
		$_SESSION['total_items']=0;
		$_SESSION['total_price']=0.00;}
	  
		
	   $controller=$this->getController();//получаем контролер
	 
	   $cl=explode('.', $controller[0]);
	   
	   $cl=$cl[0]; //отбрасываем расширение, получаем только путь до контролера
		
	   $name_contr=str_replace("/", "_", $cl);//заменяем в пути слеши на подчеркивания, таким образом получая название класса

	   $contr=new $name_contr;//создаем экземпляр класса контролера
	   
	   $method= $controller[1];
	  
       call_user_func(array($contr, $method));
      
	   $member=$contr->member;//получаем переменные контролера

	   return $member;
	
	}
 }
 
 
?>