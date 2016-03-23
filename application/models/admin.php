<?php

class Application_Models_Admin extends Lib_DateBase
{


    function getAdmin()
	{
	$enter=AppUser::cleanInput($_POST);
     $sql="SELECT id, login, password, role FROM users";
     $stmt =$this->conn->query($sql);
     while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
     if($row['login']==$enter['login'] && $row['password']==md5($enter['password']) && $row['role']==$enter['role'])
	    {
         $_SESSION['role']=$enter['role'];
         $_SESSION['login']=$enter['login'];

         return true;
        }
	  }
	 return false;	
    }
    
		function insertUser(){

			$login= $_POST['name'];
			 $password=md5($_POST['password']);
			 $role=$_POST['role'];
			
			$sql="INSERT INTO users (
			 login, password, role)
			 VALUES( ?,?,?)";
			 $stmt=$this->conn->prepare($sql);
			 $stmt->bindValue(1, $login, PDO::PARAM_STR);
		     $stmt->bindValue(2, $password, PDO::PARAM_STR);
			  $stmt->bindValue(3, $role, PDO::PARAM_STR);
			 $stmt->execute(); 
			
			 return true;		
		}

		function getUsers(){
		$sql="SELECT * FROM users";	
		$stmt=$this->conn->query($sql);
		$res=$stmt->fetchAll(PDO::FETCH_ASSOC);
		//print_r($res);
		return $res;
		}

		function getOneUser(){
		$sql="SELECT * FROM users WHERE id=?";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $_POST['id'], PDO::PARAM_INT);
		$stmt->execute();
		$res= $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		}

		function updateUser(){
           if($_POST['password']!=false){
             $password=md5($_POST['password']);		   
			$sql="UPDATE users SET login=?, password=?, role=? WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $_POST['login'], PDO::PARAM_STR);
			$stmt->bindValue(2, $password, PDO::PARAM_STR);
			$stmt->bindValue(3, $_POST['role'], PDO::PARAM_STR);
			$stmt->bindValue(4, $_POST['id'], PDO::PARAM_INT);
			$stmt->execute();		
	        }
			else{
			$sql="UPDATE users SET login=?, role=? WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $_POST['login'], PDO::PARAM_STR);
			$stmt->bindValue(2, $_POST['role'], PDO::PARAM_STR);
			$stmt->bindValue(3, $_POST['id'], PDO::PARAM_INT);
			$stmt->execute();			
			}
			
		return true;	
		}

		function deleteUser(){
		
			$sql="DELETE FROM users WHERE id=?";
			
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $_POST['id'], PDO::PARAM_INT);
			$stmt->execute();

		return true;
		}

		
		
		function getSlider(){
		$sql="SELECT * FROM slider";	
		$stmt=$this->conn->query($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}




		function addnewslider(){
			if(isset($_SESSION['slider']) && !empty($_POST['url'])){
			$slider=explode('/', $_SESSION['slider']);
			$slider=array_pop($slider);
		
			 $url=AppUser::cleanInput($_POST['url']);
			 $sql="INSERT INTO slider (image,url)  VALUES( ?,?)";
			 $stmt=$this->conn->prepare($sql);
			 $stmt->bindValue(1, $slider, PDO::PARAM_STR);
		     $stmt->bindValue(2, $url, PDO::PARAM_STR);
			 $stmt->execute(); 
			 return true; }
			else return false;			 
		}

		function deleteSlider(){
			$id_delete=$_POST['id'];
			$sql="DELETE FROM slider WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			 $stmt->bindValue(1, $id_delete, PDO::PARAM_INT);
			$stmt->execute();
			return true;
			}

		function updateSlider($slider){

			$new_url= AppUser::cleanInput($_POST['url']);

			$sql="UPDATE slider SET image=?, url=? WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $slider, PDO::PARAM_STR);
			$stmt->bindValue(2, $new_url, PDO::PARAM_STR);
			$stmt->bindValue(3, $_POST['id'], PDO::PARAM_INT);
			$stmt->execute();		
			
			return true;
			}
	
			
		function getSliderItem(){
		
			$sql="SELECT * FROM slider WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $_GET['id'], PDO::PARAM_INT);
			$stmt->execute();
			$res= $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $res;
			}



		function getCarousel(){
			$sql="SELECT * FROM carousel";	
			$stmt=$this->conn->query($sql);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}

		function addCarousel(){
			if(isset($_SESSION['carousel']) && !empty($_POST['url'])){
			$carousel=explode('/', $_SESSION['carousel']);
			$carousel=array_pop($carousel);
		
			 $url=AppUser::cleanInput($_POST['url']);
			 $sql="INSERT INTO carousel (image,url)  VALUES( ?,?)";
			 $stmt=$this->conn->prepare($sql);
			 $stmt->bindValue(1, $carousel, PDO::PARAM_STR);
		     $stmt->bindValue(2, $url, PDO::PARAM_STR);
			 $stmt->execute(); 
			 return true; }
			else return false;			 
		}

		function deleteCarousel(){
			$id_delete=$_POST['id'];
			$sql="DELETE FROM carousel WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			 $stmt->bindValue(1, $id_delete, PDO::PARAM_INT);
			$stmt->execute();
			return true;
			}

		function getCarouselItem(){
		
			$sql="SELECT * FROM carousel WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $_GET['id'], PDO::PARAM_INT);
			$stmt->execute();
			$res= $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $res;
			}

		function updateCarousel($carousel){

			$new_url= AppUser::cleanInput($_POST['url']);

			$upid= $_POST['upid'];	
			$sql="UPDATE carousel SET image=?, url=? WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $carousel, PDO::PARAM_STR);
			$stmt->bindValue(2, $new_url, PDO::PARAM_STR);
			$stmt->bindValue(3, $_POST['id'], PDO::PARAM_INT);
			$stmt->execute();		
			
			return true;
			}
			

		function trueCarousel(){
			$sql="UPDATE background SET carousel= true";	
			$stmt=$this->conn->prepare($sql);	
			$stmt->execute();		
		}
		function falseCarousel(){
			$sql="UPDATE background SET carousel= false";	
			$stmt=$this->conn->prepare($sql);	
			$stmt->execute();		
		}


		function getAbout(){
			$sql="SELECT about FROM background";	
			$stmt=$this->conn->query($sql);
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}

		function updateAbout(){
		
			$about= AppUser::cleanInput($_POST['text']);
			//$about=$_POST['text'];
			$sql="UPDATE background SET about=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $about, PDO::PARAM_STR);
		    $stmt->execute();		
	
		return true;	
		}

		function deleteVisits(){
			$sql="DELETE FROM visits WHERE time<".(time()-900);
			$stmt=$this->conn->prepare($sql);
			$stmt->execute();		
		}

		function selectVisits(){
			$sql="SELECT * FROM visits WHERE ip=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->execute(array($_SERVER['REMOTE_ADDR']));
			return $stmt->fetch(PDO::FETCH_ASSOC);
			
		}

		function insertVisits(){
			$sql="INSERT INTO visits SET quantity=?, ip=?, time=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->execute(array(1, $_SERVER['REMOTE_ADDR'], time() ) );

		}
		
		function updateVisits(){
			$sql="UPDATE visits SET quantity=? WHERE ip=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->execute(array(2, $_SERVER['REMOTE_ADDR']));	
			
		}
		
		function getdeleteTime(){
			$sql="SELECT `time_of_clean` FROM background";
			$stmt=$this->conn->query($sql);
			$res=$stmt->fetch(PDO::FETCH_ASSOC);
			return $res;	
		
		}
        
		function putTime($time){
			$sql="UPDATE `background` SET `time_of_clean`=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $time, PDO::PARAM_INT);
			$stmt->execute();
		}
		
		function getImages(){
		
			$sql="SELECT `images` FROM `products`";
			$stmt=$this->conn->query($sql);
			$res=$stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach($res as $key=>$value){
				 $res[$key]=unserialize($value['images']);    
				}
					$res=array_filter($res);
					$res2=array();
						foreach($res as $key=>$value){
						$res2=array_merge($res2, $res[$key]);
						}
							foreach($res2 as $key=>$value){
							$res2[$key]=strtolower('/uploads/'.$value);
							$res3[$key]=strtolower('/uploads/thumbnail/'.$value);
							}
			$res=array_merge($res2, $res3);
			
			$sql="SELECT `image` FROM `carousel`";
			$stmt=$this->conn->query($sql);
			$res1=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$res2=array();
				foreach($res1 as $one){
				$res2[]=strtolower('/uploads/carousel/'.$one['image']);
				}
			
			$res=array_merge($res, $res2);
			
			$sql="SELECT `picture` FROM `comments`";
			$stmt=$this->conn->query($sql);
			$res1=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$res2=array();
				foreach($res1 as $one){
					if($one['picture']){
					$res2[]=strtolower('/uploads/comments/'.$one['picture']);
					}
				}
			
			$res=array_merge($res, $res2);
			
			$sql="SELECT `image` FROM `slider`";
			$stmt=$this->conn->query($sql);
			$res1=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$res2=array();
				foreach($res1 as $one){
				$res2[]=strtolower('/uploads/slider/'.$one['image']);
				}
			
			$res=array_merge($res, $res2);
			
			return $res;
		}

}
?>