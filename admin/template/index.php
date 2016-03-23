<?
//if(isset($_POST['ajax']))
if(isset($_REQUEST['ajax']))
    { 
     $view=$router->getView();
     include ($view);
    }else
	{
     require_once "header.php";

    // Вывод контента
		 
    $view=$router->getView();
	
     include ($view); 

     require_once "footer.php";

	}
?>