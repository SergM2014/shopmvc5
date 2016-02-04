<?php
//==================подключаем шаблон сайта===========//	

require_once "header.php";

// Вывод контента
	  
 $view=$router->getView();
 include ($view); 
// Вывод подвала
require_once "footer.php";
?>