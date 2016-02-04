<h2 class="text-center">Добавить Пользователя </h2>

	<form class="form-horizontal" >
		<div class="col-sm-10 col-sm-offset-2">
			 Поля позначение <span class="remark fa-lg">*</span> есть обязательными
			</div>
		  <div class="form-group">
			<label for="name" class="col-sm-2 control-label">Имя <span class="remark">*</span></label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="name" id="name" maxlength="50" placeholder="Имя"  title="Введите имя">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="password" class="col-sm-2 control-label">Пароль <span class="remark">*</span></label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="password" id="password" maxlength="50" placeholder="пароль"  title="Введите пароль">
			</div>
		  </div>
		  


		  
		   <div class="form-group">
				<label for="role" class="col-sm-2 control-label">Роль <span class="remark">*</span></label>
					<div class="col-sm-2">
						<select id="role" class="form-control">
						  <option value="editor">editor</option>
						  <option value="admin" >admin</option>
						  <option value="superadmin">superadmin</option>
						
						</select>
					</div>
		  </div>

	  
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-default" id="add_new_user">Добавить нового пользователя</button>
			</div>
		  </div>
	</form>
