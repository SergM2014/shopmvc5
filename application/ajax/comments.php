<?php

     include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
    
		
	 session_start();	
		
		$comments= AppUser::cleanInput($_POST, 'comment');
	
		     
		        $feed_back = new Application_Models_Feedback;	
				$error=$feed_back->isValidCommentData($comments, $_SESSION['id']);  

                    if(!empty($error)) {
                        $response = array();
                        foreach ($error as $key => $value) {
                            if($value) $response[$key] = $value;
                        }

                    }

					   if(empty($error)) {$response=array("success"=>"Ваш коментарий будет опубликован!");
				
		    unset($_SESSION['bild']);}
	
	echo json_encode($response);