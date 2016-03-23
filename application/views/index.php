<div class="row">
	<ol class="breadcrumb ">
	  <li class="active">Главная</li>

		<div  id="cart_res"  class="pull-right"><img src="img/korzina.jpg" > 
		<a href="#" id="show_busket" data-toggle="modal" data-target=".bs-example-modal-lg" >Корзина</a>&nbsp;&nbsp;&nbsp;Количество товара:<span><?php echo (!$_SESSION['total_items']) ? 0: $_SESSION['total_items']  ?></span
		>&nbsp;&nbsp;&nbsp;На сумму:<span><?php echo (!$_SESSION['total_price']) ?  0 :  $_SESSION['total_price']  ?>грн</span></div><!--cart_res-->
	</ol>	
</div>


<h1 class="text-center">Добро пожаловать в интернет-магазин</h1>

<div class="row clearfix" id="gallery_div">
    <button type="button"  id="menu_button" class="btn btn-primary  visible-xs hidden-sm hidden-md hidden-lg">меню >>></button>
    <button type="button"  id="menu_button_hide" class="btn btn-primary  hidden-xs hidden-sm hidden-md hidden-lg"><<< меню</button>
	<div id="menu" class="col-lg-2 col-md-3 col-sm-4 ">
	<?php echo $leftmenu ?>
	</div>

	<div class="col-lg-10 col-md-9 col-sm-8">

		<div id="carousel" class="carousel slide" >
		  <!-- Indicators -->
			  <ol class="carousel-indicators">
			  <?php  if ($mod1){foreach($mod1 as $key=>$slider): ?>
				<li data-target="#carousel" data-slide-to="<?php echo $key ?>" <?php if($key=="0") echo 'class="active"'; ?>></li>
					<?php endforeach; } ?>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">

			  <?php  if ($mod1)
			  {foreach($mod1 as $key=>$slider): ?>
				<div class="item <?php if($key=="0") echo 'active'; ?>">
					 <a href="<?php echo URL.$slider['url'] ?>">
					 <img src="uploads/slider/<?php echo $slider['image'] ?>" alt="..." class="img-responsive" /> </a>
				  <div class="carousel-caption">
					<h3>111111</h3>
					  <p>222</p>
				  </div>
				</div>

				<?php endforeach; } ?>
			  </div>

		  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			  </a>
		</div>
    </div>

</div><!--row-->



	<div class="row">
	 <?php 
	  if($mod3['carousel']){ ?>
	<ul  class="slider1">
	   <?php foreach($mod2 as $carousel):  ?>
		 <li>   <a href="<?php echo $carousel['url'] ?>"><img src="uploads/carousel/<?php echo $carousel['image'] ?>"></a> </li>
	  <?php  endforeach; ?>
	</ul> 

	<?php } ?>
	</div><!-- row -->