<!DOCTYPE html>
	<html lang="ru">
	  <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>интернет магазин</title>



			<script src="script/jquery.js"></script>
			<script src="template/jgallery-master/js/tinycolor-0.9.16.min.js"></script>
			<script src="template/jgallery-master/js/jgallery.min.js?v=1.2.0"></script>
		
			<script src="template/bx/jquery.bxslider.min.js"></script>
			<script src="script/javascript.js"></script>

			<script src="template/menu/leftmenu.js"></script>

			<link rel="stylesheet" href="template/jgallery-master/css/font-awesome.min.css"/>
			<link rel="stylesheet" href="template/jgallery-master/css/jgallery.min.css?v=1.2.0"/>

			<link rel="stylesheet" href="template/bx/jquery.bxslider.css" type="text/css" />
			
			
			<link rel="stylesheet" href="template/menu/default.css"/>
            <link rel="stylesheet" href="template/default.css"/>

			<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		   
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		   <script src="lib/bootstrap/js/bootstrap.min.js"></script>
		   

	<!--	<noscript><span>У Вас отключён JavaScript сайт не будет работать адекватно</span></noscript> --> 
		
	</head>
	<body>

		<div class="container">
		
		    <header class="site_header row"><h2 class="text-center">Наше лого</h2></header>
			
			<nav class="navbar navbar-default row">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header ">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="/">интернет магазин</a>
					</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					  <ul class="nav navbar-nav ">
                       <?php echo $menu ?>
					  </ul>
					  
					  <form class="navbar-form navbar-right" role="search" >
						<div class="form-group">
						<label>Поиск</label>
						  <input type="text" id="search" class="form-control " placeholder="Поиск">
						</div>
					  </form>

					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>


		
			<div class="modal fade bs-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">Ваши покупки</h4>
				  </div>
				  <div class="modal-body">
					
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Закрить</button>
					
				  </div>
				</div>
			  </div>
			</div>
			<div id="message_box"></div>
			<div id="search_res" class="invisible"></div>
			<div id="show_res" class="col-sm-8 col-sm-offset-2 col-xs-12 invisible" ></div>
			<div id="content">