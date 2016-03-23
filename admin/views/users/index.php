<section id="show_users">

    <h1 class="text-center"> Просмотр Пользователей </h1>
	

    <button type="button" id="add_user" class="btn btn-success pull-right">Добавить пользователя</button>

	<div class="clearfix"></div>
			
			
    <div class="table-responsive">
         <table class="table table-striped">
            <tr>


                <th>Id</th>
                <th>Логин</th>

                <th>Пароль</th>

                <th>Роль</th>
                <th colspan="2"></th>
            </tr>


        <?php foreach($users as $value): ?>

            <tr id="line<?php echo $value['id'] ?>">

                <td ><?php echo $value['id']  ?></td>

                <td ><?php echo $value['login']  ?></td>
                <td ><?php echo $value['password']  ?></td>
                <td><?php echo $value['role']  ?></td>
                <td><button type="button" data-edit="<?php echo $value['id'] ?>" id="edit_user" class="btn btn-default">Редактировать</button></td>
                <td><button type="button" data-delete="<?php echo $value['id'] ?>" id="delete_user" class="btn btn-danger">Удалить</button></td>
            </tr>

        <?php endforeach;  ?>

        </table>
    </div><!--tablew-responsive-->

</section><!-- show users -->

