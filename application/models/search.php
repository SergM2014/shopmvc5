<?php
//Модель вывода каталога
 class Application_Models_Search extends Lib_DateBase
  {	  
	function getSearch($search){
		
		 $search=substr($search, 0, 100 );
		 $sql="SELECT 
		 id, author, title  FROM products
		 WHERE author
		 LIKE ? 
		 OR title LIKE ? ORDER BY author  ASC LIMIT 7
		 ";
		 $stmt=$this->conn->prepare($sql);
		 $stmt->bindValue(1, "%$search%", PDO::PARAM_STR);
		 $stmt->bindValue(2, "%$search%", PDO::PARAM_STR);
		 $stmt -> execute();
		 
		 if($stmt->rowCount()>0){
			while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
			$str='</br>  <span data-id='.$row['id'].'>';	
			$str.='  '.$row['author'];
			$str.= "  ";
			$str.=$row['title'];
			$str.= '</span></br>';
			
			echo $str;	
			}
			
			 
		 }else{
		 echo 'Поиск результатов не дал';
		 }
		 exit;
		}

	}
	
  