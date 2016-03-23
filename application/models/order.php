<?php

 class Application_Models_Order extends Lib_DateBase
  {	  
	function insertBusket($order){
	
	    $error=array();
	
		if(empty($order['firstname'])) $error['firstname']='firstname'; 
		if(empty($order['phone'])) $error['phone']='phone';
		if(empty($order['kcaptcha']) || strtolower($order['kcaptcha'])!=strtolower($_SESSION['captcha_keystring'])) $error['kcaptcha']='kcaptcha';
		if(!empty($error)) return $error;

		
		
		foreach($order as $key=>$value){
		  if(empty($value)) $order[$key]='';
		}
		
		
		
		$firstname=$order['firstname'];
		$secondname=$order['secondname'];
		$lastname=$order['lastname'];

		$email=filter_var($order['email'], FILTER_VALIDATE_EMAIL);
		if(empty($email)) $email='';
		$adress=$order['adress'];
		$phone=$order['phone'];
		$pogelanij=$order['wishes'];
		$id_products=$this->getfullId();

		
		$date=date(DATE_RFC822);
		
		//echo ' firstname->'.$firstname ,'  secondname->'.$secondname, '  lastname->'.$lastname, '  email->'.$email,
		//'  adress->'. $adress, '  phone->'.$phone,'  pogelanija->'.$pogelanij, '  products_report->'.$id_products,'   date->'.$date ;


		$sql="INSERT INTO orders(
		firstname,  secondname, lastname, email, address, phone, pogelanij, 
		id_products, date)
		VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ? )";
		$stmt=$this->conn->prepare($sql);
		$stmt->execute(array($firstname ,$secondname, $lastname, $email, $adress, $phone ,$pogelanij, $id_products, $date));


		 if($stmt==false){
			echo'Запрос к базе данных не прошел';
			return false; 
		 }
			
		$_SESSION['total_items']=0;
		$_SESSION['total_price']='0.00';
		unset ($_SESSION['cart']);

		return false;
		}



		function getfullId(){
				$aus='';
			foreach($_SESSION['cart'] as $id=>$qty){
			$aus.='   id ='.$id.' количество ='.$qty;		
			}//end of foreach

			return $aus;
		}
	
  }