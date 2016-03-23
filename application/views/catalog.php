<nav class="row">
	<ol class="breadcrumb ">
	  <li><a href="/">Главная</a></li>
	  <?php echo (AppUser::getBreadcrumb());  ?>


		<div  id="cart_res"  class="pull-right"><img src="img/korzina.jpg" > 
		<a href="#" id="show_busket" data-toggle="modal" data-target=".bs-example-modal-lg" >Корзина</a>&nbsp;&nbsp;&nbsp;Количество товара:<span><?php echo (!$_SESSION['total_items']) ? 0: $_SESSION['total_items']  ?></span
		>&nbsp;&nbsp;&nbsp;На сумму:<span><?php echo (!$_SESSION['total_price']) ?  0 :  $_SESSION['total_price']  ?>грн</span></div><!--cart_res-->
	</ol>
</nav>

<?php

 if(!empty($mod1)): ?>
	<div class="row">	
		<div  class="btn-group btn-xs col-sm-9 col-sm-offset-3">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				Сортировать по <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" role="menu">
				<li><a href="<?php echo $clearurl ?>order=abc">По алфавиту А-Я</a></li>
				<li><a href="<?php echo $clearurl ?>order=cba">По алфавиту Я-А</a></li>
				<li class="divider"></li>
				<li><a href="<?php echo $clearurl ?>order=cheap_first">Поцене сначала дешевые</a></li>
				<li><a href="<?php echo $clearurl ?>order=expensive_first">Поцене сначала дорогие</a></li>
			  </ul>
		</div>
	</div>	
<?php endif; ?>

<div class="row clearfix">

    <div class="col-sm-3">
		<h4 >Категории</h4>
		<ul class="leftcatalog">
	    <?php echo $cat_tree;?>
		</ul>

	    <h4 >Производители</h4>
	    <ul class="leftcatalog">
		<li><a href="/catalog?manufacturer_id=0">Не указан</a></li>
	    <?php echo $manufacturer_tree; ?>
	    </ul>
	</div>
	
	
	
	<section class="col-sm-9 ">
		<?php 
		
		if(!empty($mod1)): ?>
		 <?php foreach($mod1 as $val): ?>

			<div class="wrapgood">
                <?php if($val['images']==true) $images = unserialize($val['images']);?>
                <img src= "uploads/<?php  echo $images[0]?>" onerror="this.style.display='none'"/>
                <h4 class="text-center">Автор: <?php echo $val['author'] ?></h4>
                <h4 class="text-center">Название: <?php echo $val['title'] ?></h4>
                <p><strong>Описание: </strong><?php echo $val['description'] ?><p>
                <p><strong>Цена: </strong><?php echo $val['price'] ?>грн<p>
                <?php if($val['manufacturer']){ ?><p><strong>Производитель: </strong><?php echo $val['manufacturer'] ?><p><?php } ?>
                <p><a href="<?php echo URL  ?>product?article=<?php echo $val['id']  ?>">Подробно</a></p>
			</div>

		<?php  endforeach; 
       
		if($mod2>1): 
		
		$page= (!isset($_GET['p'])) ? 1: $_GET['p'];
		
		?>
		<nav  class="col-sm-8 col-sm-offset-2">
             <ul class="pagination">

                <?php if($_GET['p']>1) : ?>
                 <li><a href="<?php echo $url.$adjective ?>p=1" aria-label="Previous"><span aria-hidden="true">&laquo;&laquo;</span> </a> </li>
                 <li><a href="<?php echo $url.$adjective ?>p=<?php echo($page-1) ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span> </a> </li>

                <?php endif; ?>

                <?php for($i=1; $i<=$mod2; $i++) { ?> <li <?php if(!isset($_GET['p']) and $i==1 or $_GET['p']== $i) echo 'class="active"' ?>><a  href="<?php echo $url.$adjective?>p=<?php echo $i ?>"><?php echo $i ?></a></li> <?php } ?>

                <?php if($_GET['p']<$mod2): ?>
                <li> <a href="<?php echo $url.$adjective?>p=<?php echo ($page+1) ?>" aria-label="Next"> <span aria-hidden="true">&raquo;</span></a></li>
                <li> <a href="<?php echo $url.$adjective?>p=<?php echo $mod2 ?>" aria-label="Next"> <span aria-hidden="true">&raquo;&raquo;</span></a></li>
                <?php endif; ?>

            </ul>
	    </nav>
		<?php  endif; ?>
		
	<?php  else: ?><div id="not_founded"><h3> По данному запросу ничего не найдено!!</h3></div><?php endif; ?>
	</section>
</div><!--row-->