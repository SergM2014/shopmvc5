<?php
//Модель вывода каталога
 class Application_Models_Comments extends Lib_DateBase
  {	  
	
	function getComments()
	    { 
		$order=$_POST['order'];
		 switch($order)
           {
		   	   case 'author_abc':
               $order=' ORDER BY `comments`.`name`'; break;
			   case 'author_cba':
               $order=' ORDER BY `comments`.`name` DESC'; break;
	           case 'email_abc':
               $order=' ORDER BY `comments`.`email`'; break;
	           case 'email_cba':
			   $order=' ORDER BY `comments`.`email`DESC'; break;
			   case 'first_old':
			   $order=' ORDER BY `comments`.`date` DESC'; break;
			   case 'first_new':
			   $order=' ORDER BY `comments`.`date`'; break;
			   case 'article_abc':
			   $order=' ORDER BY `products`.`title` '; break;
			   case 'article_cba':
			   $order=' ORDER BY `products`.`title` DESC'; break;
			   
	          default:		 
              $order=' ORDER BY `comments`.`id` DESC';			
			}
			
			switch($_POST['picture'])
			{
			 case 'picture_yes':
			 $condition=" `comments`.`picture` !=''";break;
			 case 'picture_no':
			 $condition=" `comments`.`picture` =''";break;
			}
			
			
			
			switch($_POST['published'])
			{
			  case 'published_yes':
			  $condition2="`comments`.`published`=1"; break;
		      case 'published_no':
			  $condition2="`comments`.`published`=0"; break;
			
			}
			
						
			switch($_POST['changed'])
			{
			  case 'changed_yes':
			  $condition3="`comments`.`changed`=1"; break;
		      case 'changed_no':
			  $condition3="`comments`.`changed`=0"; break;
			
			}	
			
			 if($condition) $maincondition= "WHERE ".$condition;
			 if($condition2 && $maincondition){$maincondition.=" AND ".$condition2;} elseif ($condition2 && !$maincondition){$maincondition=" WHERE ".$condition2;}
			 if($condition3 && $maincondition){$maincondition.=" AND ".$condition3;} elseif ($condition3 && !$maincondition){$maincondition=" WHERE ".$condition3;}
		
		if(isset($_POST['page'])){
		$start=(($_POST['page'])-1)*PERPAGEADMIN;} else {$start=0;}	
		
        $sql="SELECT `comments`.`id`, `comments`.`name`, `comments`.`email`, `comments`.`comments`, `comments`.`date`, `comments`.`published`, 
        `comments`.`changed`, `comments`.`picture`, `products`.`title` FROM `comments` LEFT JOIN `products` ON `products`.`id`= `comments`.`product_id` ".$maincondition.$order
		." LIMIT ?,".PERPAGEADMIN;
		$stmt=$this->conn->prepare($sql);
        $stmt->bindValue(1, $start, PDO::PARAM_INT);		
	    $stmt->execute();
		$res= $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $res;

        }
		
		
		
		
	function getNumber(){
		switch($_POST['picture'])
			{
			 case 'picture_yes':
			 $condition=" `comments`.`picture` !=''";break;
			 case 'picture_no':
			 $condition=" `comments`.`picture` =''";break;
			}
			
			
			
			switch($_POST['published'])
			{
			  case 'published_yes':
			  $condition2="`comments`.`published`=1"; break;
		      case 'published_no':
			  $condition2="`comments`.`published`=0"; break;
			
			}
			
						
			switch($_POST['changed'])
			{
			  case 'changed_yes':
			  $condition3="`comments`.`changed`=1"; break;
		      case 'changed_no':
			  $condition3="`comments`.`changed`=0"; break;
			
			}	
		if($condition) $maincondition= "WHERE ".$condition;
			 if($condition2 && $maincondition){$maincondition.=" AND ".$condition2;} elseif ($condition2 && !$maincondition){$maincondition=" WHERE ".$condition2;}
			 if($condition3 && $maincondition){$maincondition.=" AND ".$condition3;} elseif ($condition3 && !$maincondition){$maincondition=" WHERE ".$condition3;}
		

			
			$sql="SELECT id FROM comments ".$maincondition;
			$stmt=$this->conn->prepare($sql);
		   
			$stmt->execute();
			$numberofrows=$stmt->rowCount();
			$number=ceil($numberofrows/PERPAGEADMIN);
	    return $number;
	
	}
		function publish($id){
			$sql="UPDATE comments SET published=1 WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			 $stmt->bindValue(1, $id, PDO::PARAM_INT);
			$stmt->execute();
		}
		
		function unpublish($id){
			$sql="UPDATE comments SET published=0 WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			 $stmt->bindValue(1, $id, PDO::PARAM_INT);
			$stmt->execute();
		}
		
		function delete($id){
			$sql="DELETE FROM comments WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			 $stmt->bindValue(1, $id, PDO::PARAM_INT);
			$stmt->execute();
		}
		function getOneComment($id){
	
		$sql="SELECT * FROM comments WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			 $stmt->bindValue(1, $id, PDO::PARAM_INT);
			$stmt->execute();
			$res= $stmt->fetch(PDO::FETCH_ASSOC);
			
		return $res;
		}
		
		function updateComment(){
		$avatar= ($_SESSION['comments'])? explode('/', $_SESSION['comments']) : '';
		if($avatar) $avatar=array_pop($avatar);
		$update=AppUser::cleanInput($_POST);
		$sql="UPDATE comments SET name=?, email=?, comments=?, picture=? WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			 $stmt->bindValue(1, $update['name'], PDO::PARAM_STR);
			 $stmt->bindValue(2, $update['email'], PDO::PARAM_STR);
			 $stmt->bindValue(3, $update['comments'], PDO::PARAM_STR);
			 $stmt->bindValue(4, $avatar,PDO::PARAM_STR);
			 $stmt->bindValue(5, $update['id'], PDO::PARAM_INT);
			$stmt->execute();
		  return true;
		
		}
		
  }