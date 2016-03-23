<?php
 class Lib_Category   extends Lib_DateBase
 {
	 public $categories;
	 protected static $instance; 
	 
	 
	 
	 function __construct(){
		 parent::__construct();
		$sql="SELECT * FROM categories";	
		$stmt=$this->conn->query($sql);

		$this->categories= $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	 
	 
	 public static function getInstance() {
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
    }
	 
	 
	 function addMainCat(){ 
		$category=AppUser::cleanInput($_POST['create_category']);

		$sql="INSERT INTO categories (
			  cat_title,parent_id )
			 VALUES( ?, 0)";
			
			$stmt=$this->conn->prepare($sql);
			$stmt->bindValue(1, $category, PDO::PARAM_STR);
			$stmt->execute();
            $res=$this->conn->lastInsertId(); 
			
        return $res;			
	}
	
	
	function getIdCategory(){
		$id=AppUser::cleanInput($_POST['id_cat_delete']);
		$sql="SELECT id FROM products WHERE id_cat=? LIMIT 1";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		$res=$stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
		}
	
	
	function deleteCat(){
		$id=$_POST['id_cat_delete'];
		$sql="DELETE FROM categories WHERE id=?";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
	}
	
	
	function insertSubCat(){
	
		$sub_category=AppUser::cleanInput($_POST['create_sub_category']);
		$parent=$_POST['parent_id'];
		
		$sql="INSERT INTO categories ( cat_title, parent_id ) VALUES (?, ? ) ";	
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $sub_category, PDO::PARAM_STR);
		$stmt->bindValue(2, $parent, PDO::PARAM_INT);
		
	    $stmt->execute();
	    $res=$this->conn->lastInsertId(); 
			
        return $res;				
		}
		
	function updateCat(){	

		$upcategory= AppUser::cleanInput($_POST['uptitle']);
		$upparent_id=$_POST['upparent_id'];
		$id= $_POST['id'];	
		$sql="UPDATE categories SET cat_title=?, parent_id=?  WHERE id=?";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $upcategory, PDO::PARAM_STR);
		$stmt->bindValue(2, $upparent_id, PDO::PARAM_INT);
		$stmt->bindValue(3, $id, PDO::PARAM_INT);
		
		$stmt->execute();		
		return true;		
		}
		
		
		
	function selectOneCat(){

		$sql="SELECT * FROM categories WHERE id=?";
		$stmt=$this->conn->prepare($sql);
		$stmt->bindValue(1, $_POST['id_cat_edit'], PDO::PARAM_INT);
		$stmt->execute();
		$res= $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
	}
	
	public function  getCategoryTree( $parent=0 )//выводится в админ меню при нажатии категория оперирует 
{
	 foreach($this->categories as $category){
		 if($category["parent_id"]==$parent){
		 if($category['parent_id']!='0') $root='<span class="glyphicon glyphicon-arrow-right" ></span>';
			$print.=
			'<li> '.$root.'   <a class="btn btn-default" rel="CategoryTree" data-id="'.$category['id'].'" data-parent_id="'.$category["parent_id"].'">'.$category['cat_title'].'</a>';

			
			foreach($this->categories as $sub_category){ 
				 if($sub_category["parent_id"]==$category['id']){
		        	$flag=TRUE;
			        break;
			}		 	
		}
			if($flag==TRUE ){
			$print.="<ul>";
				$print.= $this->getCategoryTree($category['id']);
				$print.="</ul>";
				$print.='
				</li>';	 
				 }else
			$print.='</li>';
		 }
		
	 }
	 	
	 return  $print;		 
	}
	
	
    public function  getleftmenuStructure($parent=0 )//формирование віпадающего вертикального меню
    {
	    foreach($this->categories as $category)
	    {
		 if($category["parent_id"]==$parent)
		    {
			    $print.=
			   
			   '<li> <span  class="item btn menu-class" data-id="'.$category['id'].'">'.$category['cat_title'].'</span>';
			    foreach($this->categories as $sub_category)
			    { //если текущая категория значится гдето в родительской
				    if($sub_category["parent_id"]==$category['id'])
				    { $flag=TRUE; break; }		 	
		        }
			    if($flag==TRUE )
			    {
			        $print.="<ul>";
				    $print.= $this->getleftmenuStructure($category['id']);
				    $print.="</ul>";
				    $print.="</li>";	 
			    }else $print.="</li>";
		    }
	    }
	 return  $print;
	}	
	
	
		public function  getCat_Tree_Catalog( $parent=0 )//выводится в админ меню при нажатии категория оперирует 
{
		 foreach($this->categories as $category){
			 if($category["parent_id"]==$parent){
				$print.=
				'<li><a href="/catalog?category_id='.$category['id'].'" >'.$category['cat_title'].'</a>';
				foreach($this->categories as $sub_category){ 
					 if($sub_category["parent_id"]==$category['id']){
						$flag=TRUE;
						break;
				}		 	
			}
				if($flag==TRUE ){
				$print.="<ul>";
					$print.= $this->getCat_Tree_Catalog($category['id']);
					$print.="</ul>";
					$print.='
					</li>';	 
					 }else
				$print.='</li>';
			 }
			
		 }
	 	
	 return  $print;		 
	}
	


	public function  getHierarchyCategory($parent=0)
	{
		
	$cat_array=array();
		 foreach($this->categories as $category){	
			 if($category["parent_id"]==$parent){	
						$child=$this->getHierarchyCategory($category["id"]);
						
						if(!empty($child)){						
							$array=$category;
							$array["child"]=$child;	
							}
						else
							$array=$category;
						
						$cat_array[]=$array;
										
				}	
			} 

		 return  $cat_array;		
	}


//vielleicht zu beseitigen
	public function  getTitleCategory($array_categories)//возвращает выпадающий список select с категориями;	
	{
		global $lvl;
		$option='';
			foreach($array_categories as $category){
			
				if($_POST['id_cat_edit']!= $category['id']){
				$option.="<option value=".$category["id"].">";
				$option.= str_repeat("-", $lvl);//str_repeat — Возвращает повторяющуюся строку
				$option.= $category["cat_title"];
				$option.="</option>";
		           }
				   
				if(isset($category["child"])){
					$lvl++;
					$option.= $this->getTitleCategory($category["child"]);
					$lvl--;
				}
			}
		//print_r($option);	
		return $option;	
	}
	
	

	
	public function getCat(){
	$sql="SELECT * FROM categories";	
		$stmt=$this->conn->query($sql);

		$cat= $stmt->fetchAll(PDO::FETCH_ASSOC);	
		return $cat;
	}
		
	
 }
?>