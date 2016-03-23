<?php 
    if($_SESSION['login']=='' && $_SESSION['role']==''):
?>
	
    <div class="login_form" style="width:350px; margin:0 auto;">
        <h3>Войти в админ часть!</h3>
        <div id="login">

             <fieldset>
                 <form  method="POST" action="<?php echo URL ?>enter">

                 <label>Логин</label><br>
                 <input   name="login" type="text" maxlength="25" value="<?php if(isset($_SESSION['login']))echo $_SESSION['login'] ?>"><br>
                 
				 <label>Роль</label><br>
                 <input   name="role" type="text" maxlength="25" value="<?php if(isset($_SESSION['role']))echo $_SESSION['role'] ?>"><br>
				 
                 <label>Пароль</label><br>
                 <input   name="password" type="password" maxlength="25"><br>
                 </br>
                 <input  type="submit" value="Войти">

                 </form>

             </fieldset>
         </div>
     </div>

  <?endif;?>
