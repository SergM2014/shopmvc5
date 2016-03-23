<h2 class="text-center">Добавить элемент карусели </h2>
<div id="for_add" class="col-sm-10 col-sm-offset-2">

		
	<h3 >Добавить изображение</h3>
		
			<img alt="" id="image_preview" class="thumb" src="about:blank" />
		   <form id="MyUploadForm"  enctype="multipart/form-data" method="post" >
		
			<input name="FileInput" id="FileInput" type="file" />
			<input type="button"  id="submit-btn" data-folder="carousel" class="btn btn-success" value="Загрузить" />

            <input type="reset"  id="reset-btn" data-folder="carousel" class="btn btn-danger" value="Удалить" />
			<div id="output"></div>
			
		   </form></br>
			
			<div class="progress">
			  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
				0%
			  </div>
			</div>			
				
				
</div><!-- for_add -->

	<form class="form-horizontal" >
		<div class="col-sm-10 col-sm-offset-2">
			 Поля позначение <span class="remark fa-lg">*</span> есть обязательными
			</div>
		  <div class="form-group">
			<label for="url" class="col-sm-2 control-label">URL <span class="remark">*</span></label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="url" id="url" maxlength="50" placeholder="Url"  title="Введите url адресс">
			</div>
		  </div>

	  
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-default" id="add_new_carousel">Створити новый элемент карусели</button>
			</div>
		  </div>
	</form>
