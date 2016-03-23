<div class="row">
    <ol class="breadcrumb ">
       <li><a href="/">Главная</a></li>
       <li class="active">О нас</li>
		<div  id="cart_res"  class="pull-right"><img src="img/korzina.jpg" > 
		<a href="#" id="show_busket" data-toggle="modal" data-target=".bs-example-modal-lg" >Корзина</a>&nbsp;&nbsp;&nbsp;Количество товара:<span><?php echo (!$_SESSION['total_items']) ? 0: $_SESSION['total_items']  ?></span
		>&nbsp;&nbsp;&nbsp;На сумму:<span><?php echo (!$_SESSION['total_price']) ?  0 :  $_SESSION['total_price']  ?>грн</span></div><!--cart_res-->
	</ol>
</div>
<h1 class="text-center">Добро пожаловать в интернет-магазин</h1>

<?php echo $about ?>

