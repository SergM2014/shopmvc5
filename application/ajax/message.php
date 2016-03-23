<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';

	
	session_start();

				$message=AppUser::cleanInput($_POST);
				
	    
					$model= new Application_Models_Feedback;
					$error=$model->isValidData($message);
                    $response= array();

						if(!empty($error)){
                            foreach($error as $key => $value){
                                if($value) $response[$key]= $value;
                            }
                        }

					   if(empty($error)) {$response=array("success"=>"Ваше письмо отправлено!!!");
						
				          $model->sendMail();}
	

	
	echo json_encode($response);
	
	//
	
	
	
	
	?>