<?php
    
	class AppUser{
	
	public static function cleanInput($arr, $esc=false){
	 
    if(is_array($arr)){	 
     foreach($arr as $key=>$value){
        
	 	if($key!= $esc){
				$value=trim($value);
				$avalue=stripslashes($value);				
				$arr[$key]=htmlspecialchars($value, ENT_QUOTES);
                 }
		}
		}else{
				$arr=trim($arr);
				$arr=stripslashes($arr);				
				$arr=htmlspecialchars($arr, ENT_QUOTES);
                 }
       return $arr;
    }
	
	public static function getBreadcrumb(){
	  if(isset($_GET['category_id']))
	  {
	  $breadcrumb='<li><a href="/catalog">Каталог</a></li>';
	  $breadcrumb.='<li class="active">Категория</li>';
	  }
	  elseif(isset($_GET['manufacturer_id']))
	  {
	  $breadcrumb='<li><a href="/catalog">Каталог</a></li>';
	  $breadcrumb.='<li class="active">Производитель</li>';
	  }
	  else{$breadcrumb= '<li class="active">Каталог</li>';}
	  return $breadcrumb;
	}
	
	public static function getAricleforerunner(){
		$url=$_SERVER['HTTP_REFERER'];
		$arr=explode('?', $url);
		if($arr[1]) {$url=$arr[1];} else {$breadcrumb.=' <li class="active">Просмотр товара</li>';
		return $breadcrumb;
		}
		$one=substr($url, 0,5);
		if($one=='manuf') {
		$breadcrumb='<li><a href="/catalog?'.$url.'">Производитель</a></li>';
		$breadcrumb.=' <li class="active">Просмотр товара</li>';
		}
		else {
		$breadcrumb='<li><a href="/catalog?'.$url.'">Категория</a></li>';
		$breadcrumb.=' <li class="active">Просмотр товара</li>';
		}
		return $breadcrumb;
        }
   }
   
   
   class Url{
   //очищает адрес от последнего p
    public static function freefromP(){
		$url=$_SERVER['REQUEST_URI'];
		//$url=trim('/',$_SERVER['REQUEST_URI']);
		//print_r($url);
		$arr=explode("&",$url);
		
		$count=count($arr);
		foreach($arr as $key=>$value){
		$one=substr($value,0,1);
		if($one=='p'){
		array_splice($arr,$count-1);
		break;
		}
		}
		$url=implode('&',$arr);
		
	return $url;
	}
	
	    public static function makeclear($url){
		$find=strpos($url, '?');
		if($find!==FALSE) {$adjective='&';} else {$adjective='?';}
		//print_r($adjective);
	return $adjective;
	}
	
	public static function fullclearUrl(){
	    $url=self::freefromP();
		$arr=explode("&",$url);
	
		foreach($arr as $key=>$value){
		$one=substr($value,0,5);
		if($one=='order'){
		array_splice($arr,$count-1);
		break;
		}
		}
		$url=implode('&',$arr);
		
		
		$arr=explode("?",$url);
		foreach($arr as $key=>$value){
		$one=substr($value,0,5);
		if($one=='order'){
		array_splice($arr,$count-1);
		break;
		}
		}
		$count=count($arr);
		$url=implode('?',$arr);
		
		
		if($count<2) {$url.='?';} else {$url.='&';}
	return $url;
	}
   }
   
   class Language{
   
   	public static function rus_date() {
    // Перевод
     $translate = array(
     "am" => "дп",
     "pm" => "пп",
     "AM" => "ДП",
     "PM" => "ПП",
     "Monday" => "Понедельник",
     "Mon" => "Пн",
     "Tuesday" => "Вторник",
     "Tue" => "Вт",
     "Wednesday" => "Среда",
     "Wed" => "Ср",
     "Thursday" => "Четверг",
     "Thu" => "Чт",
     "Friday" => "Пятница",
     "Fri" => "Пт",
     "Saturday" => "Суббота",
     "Sat" => "Сб",
     "Sunday" => "Воскресенье",
     "Sun" => "Вс",
     "January" => "Января",
     "Jan" => "Янв",
     "February" => "Февраля",
     "Feb" => "Фев",
     "March" => "Марта",
     "Mar" => "Мар",
     "April" => "Апреля",
     "Apr" => "Апр",
     "May" => "Мая",
     "May" => "Мая",
     "June" => "Июня",
     "Jun" => "Июн",
     "July" => "Июля",
     "Jul" => "Июл",
     "August" => "Августа",
     "Aug" => "Авг",
     "September" => "Сентября",
     "Sep" => "Сен",
     "October" => "Октября",
     "Oct" => "Окт",
     "November" => "Ноября",
     "Nov" => "Ноя",
     "December" => "Декабря",
     "Dec" => "Дек",
     "st" => "ое",
     "nd" => "ое",
     "rd" => "е",
     "th" => "ое"
    );
   // если передали дату, то переводим ее
   if (func_num_args() > 1) {
       $timestamp = func_get_arg(1);
       return strtr(date(func_get_arg(0), $timestamp), $translate);
      } else {
     // иначе текущую дату
       return strtr(date(func_get_arg(0)), $translate);
      }
    }
 /*rus_date("j F Y H:i ", данніе в формате date);
получим	
20 Декабря 2012 20:13*/
   
   }
	
	
    