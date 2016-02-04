<?php
     include $_SERVER['DOCUMENT_ROOT'].'/config.php';
	 session_start();

     
	   $formats=explode(',', VALID_FORMATS);
	   if($_GET['folder']==true) {
	   $folder=$_GET['folder'].'/';
	   $fordelete=$_GET['folder'];
	  
	  switch ($_GET['folder'])
	  {
	  case 'comments': $width= COMMENTS_WIDTH; $height= COMMENTS_HEIGHT;  break;
	  case 'carousel': $width= CAROUSEL_WIDTH; $height= CAROUSEL_HEIGHT;  break;
	  }
	  
	  
	   }
	   
	   $valid_formats=array();
	      foreach($formats as $one){
	      $valid_formats[]=trim($one,' ');
	      }
        
            if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") // пришел запрос
            {
                $name = $_FILES['FileInput']['name'] ; // имя файла
                $size = $_FILES['FileInput']['size'] ; // размер файла
				
				$name=strtolower($name);
                if(strlen($name))
                {
                    list($txt, $ext) = explode(".", $name) ; // разбиваем на имя и формат
                    if(in_array($ext,$valid_formats))    // смотрим формат такой как мы разрешили?!
                    {
                        if($size < (1024 * 1024 * 1024*2)) // Ограничиваем размер файла в 1MB*2
							{      
							   $actual_image_name = time() . ".jpeg"  ;
							   $tmp = $_FILES['FileInput']['tmp_name'];
							   
								   switch($_FILES['FileInput']['type'])
								    {						// узнаем тип картинки 
									  case "image/gif": $im = imagecreatefromgif($tmp); break; 
									  case "image/jpeg": $im = imagecreatefromjpeg($tmp); break; 
									  case "image/png": $im = imagecreatefrompng($tmp); break; 
									  case "image/pjpeg": $im = imagecreatefromjpeg($tmp); break; 
								    }
														   
								  list($w,$h) = getimagesize($tmp); // берем высоту и ширину 
								     
								if($w<$width && $h<$height || $_GET['folder']== "slider")
								{
								   
								   if(move_uploaded_file($tmp, PATH_SITE.'/'.UPLOAD . $folder. $actual_image_name))
								  {
                                        						  
								  ?>
								  <img src="/../../img/tick.jpg" />
								 
							    <!-- сесия для удаления изображений -->
								 <?php $_SESSION[$fordelete]=UPLOAD.$folder.$actual_image_name;   
								 }
							     else echo "Ошибка. =(";
								}   
								  else 
								{  
								  
								  if($w>$h){
								    $koe=$w/$width; // вычисляем коэффициент CAROUSEL_WIDTH это ширина которая должна быть 
								    $new_h=ceil($h/$koe); // с помощью коэффициента вычисляем высоту 
								    $im1 = imagecreatetruecolor($width, $new_h); // создаем картинку 
								    imagecopyresampled($im1,$im,0,0,0,0,$width,$new_h,imagesx($im),imagesy($im)); 
									}
									else
									{$koe=$h/CAROUSEL_HEIGHT; // вычисляем коэффициент CAROUSEL_WIDTH это ширина которая должна быть 
								    $new_w=ceil($w/$koe); // с помощью коэффициента вычисляем высоту 
								    $im1 = imagecreatetruecolor($new_w, $height); // создаем картинку 
								    imagecopyresampled($im1,$im,0,0,0,0,$new_w,$height,imagesx($im),imagesy($im)); 
									}
									
								    imageconvolution($im1, array( // улучшаем четкость 
								    array(-1,-1,-1), 
								    array(-1,16,-1), 
								    array(-1,-1,-1) ), 
								    8, 0); 
								  
								    imagejpeg($im1,  PATH_SITE.'/'.UPLOAD.$folder. $actual_image_name,75); // переводим в jpg 
									 imagedestroy($im); 
									 imagedestroy($im1); 

								 
								 if(file_exists(PATH_SITE.'/'.UPLOAD .$folder.$actual_image_name))
								  {
								       
								  ?>
								  <img src="/../../img/tick.jpg" />
								 
							      <!-- сесия для удаления изображений -->
                                  <?php	$_SESSION[$fordelete]=UPLOAD.$folder.$actual_image_name;							 
								 }
							     else echo "Ошибка. =1(";
							    }
							    
                            }
                        else echo "Максимальный размер файла не должен превышать 1*2 MB"; 
                    }
                    else echo "Допустимые форматы: jpg|jpeg|png|gif)"; 
                }
                else die("Пожалуйста выберите изображение!") ;
            }
			exit;


?>