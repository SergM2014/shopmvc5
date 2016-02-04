<?php
//Модель вывода каталога
 class Application_Models_Catalog extends Lib_DateBase
  {	  

	function getContent(){

	switch($_GET['order']){
		
		case 'abc': $order='ORDER BY title'; break;
		
		case 'cba': $order='ORDER BY title DESC'; break;
		
		case 'cheap_first': $order='ORDER BY p.price'; break;
		
		case 'expensive_first': $order='ORDER BY p.price DESC'; break;
		
		default: $order='ORDER BY p.id DESC';
		}
		
		
		if(isset($_GET['p'])){
		$start=(($_GET['p'])-1)*PERPAGE;} else {$start=0;}	

		if(isset($_GET['category_id'])){
		$id=intval($_GET['category_id']);
		
		$sql="SELECT p.id, p.author, p.title, p.description, p.price, p.id_cat, p.manufacturer_id, p.images  FROM products p 
		 WHERE p.id_cat=? ".$order." LIMIT ?, ".PERPAGE ;
		$stmt=$this->conn->prepare($sql);
		 
		 $stmt->bindValue(1, $id, PDO::PARAM_INT);
		 $stmt->bindValue(2, $start, PDO::PARAM_INT);
		 $stmt->execute();
		 $res=$stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res;
		}
		if(isset($_GET['manufacturer_id']) !== FALSE){
		
		$id=intval($_GET['manufacturer_id']);
		$sql="SELECT id, author, title, description, price, id_cat, manufacturer_id, p.images  FROM products p
			WHERE manufacturer_id=? ".$order." LIMIT ?, ".PERPAGE ;
			$stmt=$this->conn->prepare($sql);
			 
			 $stmt->bindValue(1, $id, PDO::PARAM_INT);
			 $stmt->bindValue(2, $start, PDO::PARAM_INT);
			 $stmt->execute();
			 $res=$stmt->fetchAll(PDO::FETCH_ASSOC);
			 return $res;
		}
		else{
		
	   $sql=" SELECT p.id, p.author, p.title, p.description,  p.price, p.images,
	   c.cat_title, m.manufacturer_title FROM products p LEFT JOIN categories c ON p.id_cat=c.id LEFT JOIN manufacturer m  ON p.manufacturer_id = m.id ".$order." LIMIT ?, ".PERPAGE ;
	   $stmt=$this->conn->prepare($sql);
	   $stmt->bindValue(1, $start, PDO::PARAM_INT);
	   $stmt->execute();
	   $res=$stmt->fetchAll(PDO::FETCH_ASSOC);

		return $res;
		}	
	}
	
	function getAdminContent(){
	
	    $order="ORDER BY p.id DESC";
	 
		switch($_POST['order']){
		
		case 'author_abc': $order="ORDER BY p.author"; break;
		
		case 'author_cba': $order="ORDER BY p.author DESC"; break;
		
		case 'title_abc': $order="ORDER BY p.title ASC"; break;
		
		case 'title_cba': $order="ORDER BY p.title DESC"; break;
		
		case 'price_abc': $order="ORDER BY p.price"; break;
		
		case 'price_cba': $order="ORDER BY p.price DESC"; break;
		
		default: $order="ORDER BY p.id DESC";
		}

	if(isset($_POST['page'])){
		$start=(($_POST['page'])-1)*PERPAGEADMIN;} else {$start=0;}
		
		
	if(!empty($_POST['manufacturer_id'])){
		  $condition="WHERE p.manufacturer_id=".$_POST['manufacturer_id'];
		}
	if(!empty($_POST['category_id'])){
		if(isset($condition)){
		$condition.=" AND p.id_cat=".$_POST['category_id'];} else {$condition="WHERE p.id_cat=".$_POST['category_id'];}
		}
		
		
	if(!empty($_POST['picture'])){
		if($_POST['picture']=="with_picture") $picture="p.images !=''";
		if($_POST['picture']=="without_picture") $picture="p.images =''";
			if(isset($condition)){
			$condition.=" AND ".$picture;} else {$condition="WHERE ".$picture;}
		}	
		

		$sql=" SELECT  p.id, p.author, p.title,  p.price, p.images,
	    c.cat_title, m.manufacturer_title FROM products p LEFT JOIN categories c ON p.id_cat=c.id LEFT JOIN manufacturer m  ON p.manufacturer_id = m.id ".$condition." ".$order." LIMIT ?, ".PERPAGEADMIN ;
	
	   $stmt=$this->conn->prepare($sql);
	   $stmt->bindValue(1, $start, PDO::PARAM_INT);
	   $stmt->execute();
	
	   $res=$stmt->fetchAll(PDO::FETCH_ASSOC);

		  foreach ($res as $key1=>$value1){
		  
		  foreach($value1 as $key=>$value){
		  if($key=='images'){
		  $res[$key1][$key]=unserialize($value);
		  }
		  }
		   }
	  
	return $res;
	}
	
	
	
	function getAdminPageNumber(){
	
		if(!empty($_POST['manufacturer_id'])){
		  $condition="WHERE p.manufacturer_id=".intval($_POST['manufacturer_id']);
				}
		if(!empty($_POST['category_id'])){
				if(isset($condition)){
				$condition.=" AND p.id_cat=".intval($_POST['category_id']);} else {$condition="WHERE p.id_cat=".intval($_POST['category_id']);}
				}
		if(!empty($_POST['picture'])){
		if($_POST['picture']=="with_picture") $picture="p.images !=''";
		if($_POST['picture']=="without_picture") $picture="p.images =''";
			if(isset($condition)){
			$condition.=" AND ".$picture;} else {$condition="WHERE ".$picture;}
		}		
			
			$sql=" SELECT  p.id FROM products p LEFT JOIN categories c ON p.id_cat=c.id LEFT JOIN manufacturer m  ON p.manufacturer_id = m.id ".$condition ;
		
		    $stmt=$this->conn->query($sql);
	  
			$row=$stmt->rowCount();
			$pages=ceil($row/PERPAGEADMIN);
			return $pages;
	}
	
	
	
	function getpageNumber($perpage='user'){
			
			 if($perpage=='admin'){$perpage=PERPAGEADMIN;} else{$perpage=PERPAGE;}
			
			if(isset($_GET['category_id'])){
			$sql="SELECT id FROM products WHERE id_cat=? ";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $_GET['category_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row=$stmt->rowCount();
			$pages=ceil($row/$perpage);
			return $pages;
			}
			if(isset($_GET['manufacturer_id'])){
			$sql="SELECT id FROM products WHERE manufacturer_id=? ";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $_GET['manufacturer_id'], PDO::PARAM_INT);
			$stmt->execute();
			$row=$stmt->rowCount();
			$pages=ceil($row/$perpage);
			return $pages;
			}
			else
			{
			$sql="SELECT id FROM products ";
			$stmt=$this->conn->prepare($sql);
			$stmt->execute();
			$row=$stmt->rowCount();
			$pages=ceil($row/$perpage);
			return $pages;
			}
	}
	
	function getlastId(){
	    $sql="SELECT id FROM products ORDER BY id DESC LIMIT 1";
	    $stmt=$this->conn->query($sql);
		$res = $stmt->fetchColumn(); 
		return $res;
	}
	
	function insertProduct($insert){
	
	    $insert=AppUser::cleanInput($insert, 'pictures');
		
	    if($insert['author']!='' && $insert['title']!='' && $insert['description']!='' && $insert['body']!='' &&
		/*$insert['category']!='' &&*/ $insert['manufacturer']!='' && $insert['price']!=''){
		
		
		
		$sql="INSERT INTO products (author, title, description, body, price, id_cat, manufacturer_id) VALUES ( ?, ?, ?, ?, ?, ?, ? )";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $insert['author'], PDO::PARAM_STR);
		$stmt->bindValue(2, $insert['title'], PDO::PARAM_STR);
		$stmt->bindValue(3, $insert['description'], PDO::PARAM_STR);
		$stmt->bindValue(4, $insert['body'], PDO::PARAM_STR);
		$stmt->bindValue(5, $insert['price'], PDO::PARAM_STR);
		$stmt->bindValue(6, $insert['category'], PDO::PARAM_INT);
		$stmt->bindValue(7, $insert['manufacturer'], PDO::PARAM_INT);
		
		$stmt->execute();
		return true;
		}
	else return false;
	
	}

	function addImages($images, $number){
		$sql="UPDATE products SET images=? WHERE id=?";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1,$images);
		$stmt->bindValue(2, $number);
		$stmt->execute();
		
	}	

	
	function deleteProduct(){
		
		$sql="DELETE FROM products WHERE id=?";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $_POST['id'], PDO::PARAM_INT);
		$stmt->execute();
		return true;
	}
	
	function updateProduct($images, $update){
	
	     $insert=AppUser::cleanInput($update,'pictures');
		
	    if($insert['author']!='' && $insert['title']!='' && $insert['description']!='' && $insert['body']!='' &&
	    $insert['manufacturer']!='' && $insert['price']!=''){

			$sql="UPDATE products SET author=?, title=?, description=?, body=?, price=?, id_cat=?, manufacturer_id=?, images=? WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $insert['author'], PDO::PARAM_STR);
			$stmt->bindValue(2, $insert['title'], PDO::PARAM_STR);
			$stmt->bindValue(3, $insert['description'], PDO::PARAM_STR);
			$stmt->bindValue(4, $insert['body'],PDO::PARAM_STR);
			$stmt->bindValue(5, $insert['price'],PDO::PARAM_STR);
			$stmt->bindValue(6, $insert['category'], PDO::PARAM_INT);
			$stmt->bindValue(7, $insert['manufacturer'], PDO::PARAM_INT);
			$stmt->bindValue(8, $images, PDO::PARAM_STR);
			$stmt->bindValue(9, $insert['id'], PDO::PARAM_INT);
			
			$stmt->execute();
		
		 return true;
		}
	else return false;	
    }
  }