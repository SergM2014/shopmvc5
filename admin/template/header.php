<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adminka!</title>

   </head>
   <body>
     <div class="container">
	
	 <div id="contextMenu">  </div>

	  <?php if($_SESSION['login']!='' && $_SESSION['role']!=''): ?>

	 <header class="site-header">
	  <h1 class="text-center clearfix">Привет админ!</h1>

     <a href="<?php echo URL; ?>">Назад на сайт</a>   <div class="pull-right"> <?php echo $_SESSION['login']; ?> (<a href="<?php echo URL ?>admin/exit">Выйти</a>)</div>
	
     <nav class="site-menu">
			    
 
    <p>Вы в панели администратирования!</p>		
			<div  class="col-sm-12  info-menu">
			  <?php switch ($_SESSION['role']){ 
			  case 'superadmin': ?>
			     <a class="btn btn-info" href="/admin/categories/index/" role="button">Категории</a>
				 <a class="btn btn-info" href="/admin/manufacturers/index/" role="button">Производители</a>
				 <a class="btn btn-info" href="/admin/products/index/" role="button">Товары</a>
				 <a class="btn btn-info" href="/admin/carousel/index/" role="button">Карусель</a>
				 <a class="btn btn-info" href="/admin/slider/index/" role="button">Слайдер</a>
				 <a class="btn btn-info" href="/admin/comments/index/" role="button">Коментарии</a>
				 <a class="btn btn-info" href="/admin/users/index/" role="button">Пользователи</a>
				 <a class="btn btn-info" href="/admin/about/index/" role="button">О нас</a>
				
				 <?php break;
				 case 'admin': ?>
			     <a class="btn btn-info" href="/admin/categories/index/" role="button">Категории</a>
				 <a class="btn btn-info" href="/admin/manufacturers/index/" role="button">Производители</a>
				 <a class="btn btn-info" href="/admin/products/index/" role="button">Товары</a>
				 <a class="btn btn-info" href="/admin/carousel/index/" role="button">Карусель</a>
				 <a class="btn btn-info" href="/admin/slider/index/" role="button">Слайдер</a>
				 <a class="btn btn-info" href="/admin/comments/index/" role="button">Коментарии</a>
				 <a class="btn btn-info" href="/admin/about/index/" role="button">О нас</a>
				 <?php break;
				 case 'editor': ?>			 
			     <a class="btn btn-info" href="/admin/categories/index/" role="button">Категории</a>
				 <a class="btn btn-info" href="/admin/manufacturers/index/" role="button">Производители</a>
				 <a class="btn btn-info" href="/admin/products/index/" role="button">Товары</a>
				 <a class="btn btn-info" href="/admin/about/index/" role="button">О нас</a>
				 <?php break;
			}?>
			</div>
		</nav><!--site-menu-->
	</header><!--site- header -->
     <?php endif; ?>
	<div id="admincontent">	