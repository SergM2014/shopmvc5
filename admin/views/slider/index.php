<section id="show_slider">
    <h1 class="text-center"> Просмотр слайдера </h1>
			
    <a href="<?php echo URL ?>admin/slider/addslider" id="add_slider" class="pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Добавить еще один слайд</a> </br>
				
    <div class="clearfix"></div>

    <div class="table-responsive">
         <table class="table table-striped">
            <tr>
                <th>Id</th>
                <th>Илюстрация</th>
                <th>URL</th>
                <th colspan="2"></th>
            </tr>

        <?php foreach($slider as $value): ?>
            <tr id="line<?php echo $value['id'] ?>">
                <td ><?php echo $value['id']  ?></td>
                <td><?php if($value['image']) :?> <img src="/../../uploads/slider/<?php echo $value['image'] ?>" onerror="this.style.display='none'" class="slider"><?php endif; ?></td>
                <td ><?php echo $value['url']  ?></td>

                <td><a class="btn btn-default" href="/admin/slider/editeslider?id=<?php  echo $value['id'] ?>" role="button">Редактировать</a></td>
                <td><button data-slider_delete="<?php  echo $value['id'] ?>"> Удалить</button></td>

            </tr>

        <?php endforeach;  ?>

        </table>
    </div>

		<?php if(!$slider) :?>
		<h1 class="text-center">За Вашим запросом ничего не найдено</h1>
		<?php endif; ?>
		
</section>

