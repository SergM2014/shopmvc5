	<form id="edit_manufacturer" class="form-horizontal">

		<h3 class="text-center">Изменить производителя</h3>

	  <div class="form-group">
		<label for="upmanufacturer" class="col-sm-2 control-label">Название производителя</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control"  id="upmanufacturer" value="<?php echo $manufacturer['manufacturer_title']  ?>" title="Введите название">
		</div>
	  </div>
	
	 <input type="hidden" id="id" value="<?php echo $manufacturer['id'] ?>">

	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" id="update_manufacturer_sub" class="btn btn-default">Сохранить изменения</button>
		</div>
	  </div>
	</form>
