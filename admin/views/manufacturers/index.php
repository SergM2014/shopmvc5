	<div id="show_manufacturer" class="col-sm-6 col-sm-offset-3" >

		<h2 class="text-center">Редактор производителей</h2>
			 <div id="manufacturer-editor"> 

			<header class="manufacturer-header">
			    <a href="#" id="add_manufacturer" class="text-center" ><span class="glyphicon glyphicon-plus"> &nbsp;&nbsp;Добавть производителя</a>
			</header>

			<?php echo $manufacturers?>
			</div>
	</div>




	<form id="add_manufacturer_form" class="form-horizontal">

		<h3 class="text-center">Добавить нового производителя</h3>

	  <div class="form-group">
		<label for="new_manufacturer" class="col-sm-2 control-label">Название производителя</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control"  id="new_manufacturer" placeholder="Производитель" title="Введите название">
		</div>
	  </div>


	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" id="add_manufacturer_submit" class="btn btn-default">Добавить нового производителя</button>
		</div>
	  </div>
	</form>


