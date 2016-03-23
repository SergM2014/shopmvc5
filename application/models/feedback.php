<?php
 class Application_Models_Feedback extends Lib_DateBase // наследует все методы класса для работы с бд
  {	  
		private $firstname;
		private $email;
		private $wishes;
		
		// проверка на корректность ввода данных
		function isValidData($array_data){

		    if(empty($array_data['firstname'])) $error['firstname']='firstname'; 
			//корректность емайл
			
			if(!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/", $array_data['emailcontact'])){ 
			  $error['email']='emailcontact';	
			} 
			if(!trim($array_data['wishescontact'])){ $error['wishes']='wishescontact';	}
			if(empty($array_data['kcaptcha']) || strtolower($array_data['kcaptcha'])!=strtolower($_SESSION['captcha_keystring'])) $error['kcaptcha']='kcaptcha';
			//если нет ощибок, то заносим информацию в поля класс
			
			if(!empty($error)) return $error;
			else{
			
				$this->firstname=trim($array_data['firstname']);
				$this->email=trim($array_data['emailcontact']);
				$this->wishes=trim($array_data['wishescontact']);
				
			}		
     
		}
		
		
	function sendMail(){
	
		$to_user  = $this->email; 
		$to_admin = EMAIL;
		$subject = 'Сообщение с формы обратной связи';
		$message = $this->wishes;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: '.EMAIL . "\r\n";
		
		if (
		mail($to_user, $subject, $message, $headers)
		&&
		mail($to_admin, $subject, $message, $headers)
		)
		return true;
		else
		return false;
	
	}
	
	
	function isValidCommentData($array_data, $id){

			 if(!isset($array_data['firstname']) or !trim($array_data['firstname'])){ 
			  $error['name']="firstname";	
			}
			
			if(!isset($array_data['emailcontact']) or !preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/", $array_data['emailcontact'])){ 
			  $error['email']="emailcontact";	
			} 
		
			 if(!isset($array_data['comment']) or !trim($array_data['comment'])){ 
			  $error['comment']="comment";	
			}
			
			if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] != $array_data['kcaptcha']){
			$error['kcaptcha']="kcaptcha";
			}
			//print_r($error);
			if(isset($error)) { return $error;}
			else{//вносим в базу
				$this->name=trim($array_data['firstname']);
				$this->email=trim($array_data['emailcontact']);
				$this->comment=trim($array_data['comment']);
				
				$this->saveComment($id);
				
			}	
     
		}
		
		function saveComment($id){
		
		    $name=substr(trim($this->name),0,100);
            $email=substr(trim($this->email),0,150);
            $comment=strip_tags(substr(trim($this->comment),0,500),'<code><i><strike><s><strong><a>');

	       	$comment=$this->close_tags($comment);
			$comment=htmlspecialchars($comment, ENT_QUOTES);
            $time=time();
		    $published=0;
		    $changed=0;
		   
			$picture = (isset($_SESSION['bild'])) ? $_SESSION['bild'] : '';
		
		
		
		    $sql="INSERT INTO comments(
            name,  email, date, comments, published, changed, picture,product_id)
            VALUES( ?, ?, ?, ?, ?, ?, ?,? )";
		  
		    $stmt=$this->conn->prepare($sql);
            $stmt->execute(array($name, $email, $time, $comment, $published, $changed, $picture, $id));
		

		}
		
		

         function close_tags($content)
        {
             $position = 0;
             $open_tags = array();
             //теги для игнорирования
             $ignored_tags = array('br', 'hr', 'img');

             while (($position = strpos($content, '<', $position)) !== FALSE)
            {
                 //забираем все теги из контента
                 if (preg_match("|^<(/?)([a-z\d]+)\b[^>]*>|i", substr($content, $position), $match))
                {
                      $tag = strtolower($match[2]);
                     //игнорируем все одиночные теги
                     if (in_array($tag, $ignored_tags) == FALSE)
                    {
                          //тег открыт
                         if (isset($match[1]) AND $match[1] == '')
                        {
                             if (isset($open_tags[$tag]))
                             $open_tags[$tag]++;
                             else
                             $open_tags[$tag] = 1;
                        }
                        //тег закрыт
                        if (isset($match[1]) AND $match[1] == '/')
                        {
                           if (isset($open_tags[$tag])) $open_tags[$tag]--;
                        }
                    }
                     $position += strlen($match[0]);
                }
                 else
                $position++;
            }
             //закрываем все теги
             foreach ($open_tags as $tag => $count_not_closed)
            {
             $content .= str_repeat("</{$tag}>", $count_not_closed);
            }
             return $content;
        }
	
} 