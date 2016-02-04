<?php
//Модель вывода каталога
 class Application_Models_Product extends Lib_DateBase
  {	  

      function show() 
	  { if($_SESSION['cart']){ 
	
		foreach($_SESSION['cart'] as $id=>$qty):
		
			$product=$this->getProduct($id);
			$str= '<tr>';
			$str.='<td>'.$product['author'].'</td>';
			$str.='<td>'.$product['title'].'</td>';
			$str.='<td>'.number_format($product['price'],2).'грн</td>';
			$str.='<td><input type="text" name="'.$id.'" size="2" value="'.$qty.'" maxlength="2"></td>';
			$str.='<td>'.$product['price'] * $qty.' грн.</td></tr>';
			
			echo $str;
			endforeach; }
			
			return false;	  
      }

	
	function getProduct($id){
		
			$sql="SELECT * FROM products WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindParam(1,$id, PDO::PARAM_INT);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$sql1="SELECT id FROM products ORDER BY id DESC";
			$stmt=$this->conn->query($sql1);
			$row1=$stmt->fetchColumn();
			if($id>$row1)return false;	
			
			
			if(isset($row['images']) && !empty($row['images'])){
			 $images=unserialize($row['images']);
			
				foreach($images as $one){
				//$one=strtolower($one);
				
				copy( PATH_SITE.'/uploads/thumbnail/'.$one, PATH_SITE.'/uploads/temporary/thumbnail/'.$one);
				copy( PATH_SITE.'/uploads/'.$one, PATH_SITE.'/uploads/temporary/'.$one);
			}
			}
			
			
			return $row; 
	}
	

	// from comments
	function getComments($id, $order, $page)
	    { 
           // $page=(int)$page;
		    if(!isset($page)) $page=1;
			$offset=($page-1)*PERPAGEADMIN;
			if($offset<1) $offset=0;

         switch($order)
         {
	          case $order=='name':
               $order='name ASC'; break;
	          case $order=='email':
			   $order='email ASC'; break;
			   case $order=='date':
			   $order='date DESC'; break;
			   
	          default:		 
              $order='date DESC';			
			}

		$sql="SELECT * FROM comments WHERE published ='1'  AND product_id=?  ORDER BY ".$order." LIMIT ?, ?";

		 $stmt=$this->conn->prepare($sql);
          $stmt->bindValue(1, $id, PDO::PARAM_INT);
          $stmt->bindValue(2, $offset, PDO::PARAM_INT);
          $stmt->bindValue(3, PERPAGEADMIN, PDO::PARAM_INT);
          $stmt->execute();
          $res= $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $res;

        }
		
		function getNumber($id){	
			$sql="SELECT * FROM comments WHERE published= '1' AND product_id=? ";
			$stmt=$this->conn->prepare($sql);
		    $stmt->bindValue(1, $id, PDO::PARAM_INT);
			$stmt->execute();
			$numberofrows=$stmt->rowCount();
			$number=ceil($numberofrows/PERPAGEADMIN);
	          return $number;
	
	}
	
  }