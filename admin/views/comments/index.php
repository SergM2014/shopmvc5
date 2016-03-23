<section id="show_comments">
    <h1 class="text-center"> Просмотр комментариев </h1>

    <div class="clearfix"></div>

    <button type="button" id="to_publish" class="btn btn-success">Опубликовать</button>
    <button type="button" id="to_unpublish" class="btn btn-warning">не публиковать</button>
    <button type="button" id="to_edit" class="btn btn-info">Редактировать </button>
    <button type="button" id="to_delete" class="btn btn-danger">Удалить</button>
			
    <div class="table-responsive">
         <table class="table table-striped">
            <tr>

            <th></th>
                <th>Id</th>
                <th>аватар</br>
                <select  id="get_picture" size="1" >
                <option  value=""></option>
                <option value="picture_yes">с аватаром </option>
                <option value="picture_no">без аватара </option>
                </select>

                <th>Автор</br>
                <select  id="get_author" size="1" >
                <option  value=""></option>
                <option value="author_abc">по aлфавиту </option>
                <option value="author_cba">против алфавита </option>
                </select>
                </th>

                <th>Email</br>
                <select  id="get_email" size="1">
                <option  value=""></option>
                <option value="email_abc">по aлфавиту </option>
                <option value="email_cba">против алфавита </option>
                </select>
                </th>

                <th>Коментарий</th>

                <th>Дата</br>
                <select  id="get_data" size="1">
                <option  value=""></option>
                <option value="first_old">сначала старые </option>
                <option value="first_new">сначала новые </option>
                </select>
                </th>


                <th>Опупликован</br>
                <select  id="published" size="1">
                <option  value=""></option>
                <option value="published_yes">Да </option>
                <option value="published_no">Нет </option>
                </select>
                </th>


                <th>Изменен<br>
                <select  id="changed" size="1">
                <option  value=""></option>
                <option value="changed_yes">Да </option>
                <option value="changed_no">Нет </option>
                </select>
                </th>

                <th>Товар</br>
                <select  id="get_article" size="1">
                <option  value=""></option>
                <option value="articel_abc">по алфавиту </option>
                <option value="articel_cba">против алфавита </option>
                </select>
                </th>

                <th >   <button type="button" id="make_choise_comments" class="btn btn-warning btn-block">Выбор</button></th>
            </tr>


            <?php foreach($comments as $value): ?>

                <tr id="line<?php echo $value['id'] ?>">
                <td><div class="checkbox"><label><input type="checkbox" value="" data-good="<?php  echo $value['id'] ?>"  ></label></td>
                    <td ><?php echo $value['id']  ?></td>
                    <td align="center"> <img src="/../../uploads/comments/<?php echo $value['picture']; ?>"onerror="this.style.display='none'"> </td>
                    <td ><?php echo $value['name']  ?></td>
                    <td ><?php echo $value['email']  ?></td>
                    <td><?php echo $value['comments']  ?></td>
                    <td><?php echo Language::rus_date("H:i j F Y  ",$value['date'])  ?></td>
                    <td align="center"<?php if($value['published']){echo 'style="color:green; font-size:20px;"';}else{echo 'style="color: red; font-size:20px;"';} ?>><?php echo ($value['published'])?'ДА':'НЕТ';  ?></td>
                    <td  align="center"<?php if($value['changed']){echo 'style="color:red; font-size:20px;"';}else{echo 'style="color: green; font-size:20px;"';} ?>><?php echo $value['changed']?'ДА':'НЕТ';  ?></td>
                    <td ><?php echo $value['title']  ?></td>
                    <td></td>



                </tr>

            <?php endforeach;  ?>

            </table>
        </div><!--tablew-responsive-->


		<?php //print_r($pagination); ?>
	<?php	if($pagination>1): 
		
		$page= (!isset($_POST['page'])) ? 1: $_POST['page'];
		
		?>
		<nav  class="col-sm-8 col-sm-offset-4">

             <ul class="pagination pagination-comments">

                <?php if($page>1) : ?>
                 <li><a href="#" aria-label="Previous" data-page="1" ><span aria-hidden="true">&laquo;&laquo;</span> </a> </li>
                 <li><a href="#" aria-label="Previous" data-page="<?php echo($page-1) ?>"><span aria-hidden="true">&laquo;</span> </a> </li>
                <?php endif; ?>

                <?php for($i=1; $i<=$pagination; $i++) {
                ?> <li <?php if(!isset($page) and $i==1 or $page== $i) echo 'class="active"'; ?>>
                <a  href="#" data-page="<?php echo $i ?>"><?php echo $i ?></a></li> <?php
                } ?>

                <?php if($page<$pagination): ?>
                <li> <a href="#" aria-label="Next" data-page="<?php echo ($page+1) ?>"> <span aria-hidden="true">&raquo;</span></a></li>
                <li> <a href="#" aria-label="Next"data-page="<?php echo $pagination ?>"> <span aria-hidden="true">&raquo;&raquo;</span></a></li>
                <?php endif; ?>

            </ul>

	    </nav><!-- col-sm-9 col-sm-offset-4-->

		<?php  endif; ?>
		<?php if(!$comments) :?>
		<h2 class="text-center">За Вашим запросом ничего не найдено</h2>
		<?php endif; ?>

</section><!-- show comments -->

