<?php

      define('PATH_SITE', $_SERVER['DOCUMENT_ROOT']); 		//серверсодержит путь к корневой директории сервера
	  define('NAMESITE','shopmvc5');
	  define('URL','http://shopmvc5/');
	  define('PERPAGE',6);
      define('PERPAGEADMIN',15);


	  define('HOST', 'localhost'); 		//сервер
	  define('USER', 'root'); 			//пользователь
	  define('PASSWORD', '1'); 			//пароль
	  define('NAME_BD', 'shopmvc5');
	  define('DEBUG_MODE', false);        //режим отладки
	  define('EMAIL','weisse@ukr.net');
	  define('DEFAULT_LANGUAGE','ru');//язык по умолчанию
	  define('ALLOWED_LANGUAGES','ru, en');//возможные языки
	  define('UPLOAD_FILE', 'uploads/comments/');//директория загрузкы изображений
	  define('UPLOAD', 'uploads/');//директория загрузкы изображений
	  define('UPLOAD_FILE_CAROUSEL', 'uploads/carousel/');//директория загрузкы изображений
	  define('UPLOAD_FILE_COMMENTS', 'uploads/comments/');
	  define('VALID_FORMATS',"jpg, png, gif, jpeg");//возможные форматы загружаемых изображений
      define('CAROUSEL_WIDTH', 200);
	  define('CAROUSEL_HEIGHT', 118);
	  define('COMMENTS_WIDTH', 70);
	  define('COMMENTS_HEIGHT', 80);
  
     date_default_timezone_set('Europe/Kiev');
  

	function __autoload ($class_name) //автоматическая загрузка кслассов
		 {
			$path=str_replace("_", "/", strtolower($class_name));//разбивает имя класса получая из него путь

			if (file_exists(PATH_SITE."/".$path.".php")) {
		   
			 require_once (PATH_SITE."/".$path.".php");//подключает php файл по полученному пути	
			
			} else // if page doesnot exists movo to 404
            {
                header('Location: /404');
                exit;
			}
		 }

 
 
    if (!DEBUG_MODE){
	
     ini_set("display_errors","1");

	 ini_set('error_reporting', E_ALL & ~E_NOTICE);
	}
	
	include_once PATH_SITE.'/lib/functions.php';
   
 ?>