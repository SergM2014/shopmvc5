<h2 class="text-center">Изменить элемент слайдера </h2>


	<form class="form-horizontal" >
		<div class="col-sm-10 col-sm-offset-2">
			 Поля позначение <span class="remark fa-lg">*</span> есть обязательными
			</div>
		  <div class="form-group">
			<label for="edit_login" class="col-sm-2 control-label">изменить логин <span class="remark">*</span></label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="edit_login" id="edit_login" maxlength="50" placeholder="логин"  title="Введите логин" value="<?php echo $user['login'] ?>">
			</div>
		  </div>
		  
		  


		  <div class="form-group">
			<label for="radio" class="col-sm-2 control-label">изменить пароль </label>
			<div class="col-sm-10">
				<label class="radio-inline">
				<input type="radio" name="inlineRadioOptions" id="password1" value="option1"> Оставить как есть
				</label>
				<label class="radio-inline">
				  <input type="radio" name="inlineRadioOptions" id="password2" value="option2"> Поменять пароль
				</label>
				 <input type="text"  name="edit_password" id="edit_password" maxlength="50" placeholder="Пароль" title="Введите новый пароль"   value="">
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
			  <button type="submit" class="btn btn-default" id="sub_edited_user" data-id="<?php  echo $user['id'] ?>">Редактировать пользователя</button>
			</div>
		  </div>
	</form>
