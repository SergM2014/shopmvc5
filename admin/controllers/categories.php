<?php
class Admin_Controllers_Categories  extends Lib_BaseController 
  {
    function index() 
	{

		$categories.= "<ul id='category-tree'>";
		$categories.= Lib_Category::getInstance()->getCategoryTree();//строит древовидный список на основе getHierarchyCategory().	
		$categories.= "</ul>";

		$this->categories=$categories;

    }
	
	function addmain(){
		$id=Lib_Category::getInstance()->addMainCat();
		if($id){
			$response=array("msg"=>"нову категорию под назавнием ".$_POST['create_category']." створено", "status"=>"success");
			$this->id=$id;
			 }else{ $response= array("msg"=>"чтото пошлюне так!", "status"=>"danger");}
		 echo json_encode($response);
		 exit();
	}
	
	function deletecat(){

		$mod=Lib_Category::getInstance();
		
		$mod2=Lib_Category::getInstance()->getIdCategory();

		$vars = array();
		foreach ($mod as $key => $value){
			$vars[$key] = $value;
		}

		foreach($vars['categories'] as $cat){
			if($cat['parent']==$_POST['id_cat_delete']){
				$flag=TRUE;
				break;
			}
		}

		if($flag==TRUE)
			{$response=array("msg"=>"Категория родительська Не удалось удалить категорию!","case"=>"Parent_cat", "status"=>"danger"); }
		elseif($mod2){
			$response=array("msg"=>"В категории находятся товары! Удалить нельзя","case"=>"Goods in cat", "status"=>"danger");	
			}
		else
			{Lib_Category::getInstance()->deleteCat();
			
			$response=array("msg"=>"Удалена категория № {$_POST['id_cat_delete']}","case"=>"delete_cat","success"=>true, "status"=>"success");
			}	
			
		echo json_encode($response);

		exit();
	}
	
	function create_new_category () {
	
	}
	
	function add_sub_category(){
		$id=Lib_Category::getInstance()->insertSubCat();
		if($id){
			$response=array("msg"=>"нову подкатегорию под назавнием ".$_POST['create_sub_category']." створено", "status"=>"success");
			$this->id=$id;
			 }else{ $response= array("msg"=>"чтото пошлo не так!", "status"=>"danger");}
		echo json_encode($response);
		exit();
	}
	
	function edit_sub_category(){
	
		$category=Lib_Category::getInstance()->selectOneCat();
		
		$mod1=Lib_Category::getInstance()->getHierarchyCategory();
		$droplist=Lib_Category::getInstance()->getTitleCategory($mod1);
	  
		$this->category=$category;
		$this->droplist=$droplist;
	
	}
	
	
	function updatecategory(){
		$mod=Lib_Category::getInstance()->updateCat();
		if($mod){
			$response=array("msg"=>"Категорию под назавнием ".$_POST['uptitle']." изменено", "status"=>"success");
			
			 }else{ $response= array("msg"=>"чтото пошлo не так!", "status"=>"danger");}
		echo json_encode($response);
		exit();
	}
	
	function addnewsubcat(){
	
	}
	
}	
?>