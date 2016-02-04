<?php
    class Application_Views_Search{
        function showWindow($mod){
        ?>

            <span class="pull-right"><img src="img/close.png"></span>
            <div class="clearfix"></div>
            <?php $images = unserialize($mod['images']);

             if(isset($images)) : ?>
            <img width="160" height="180" src="uploads/<?php echo $images[0] ?>" onerror="this.style.display='none'"></br><?php endif; ?>

            <div>
            <p><strong>Автор: <?php echo $mod['author']  ?></strong></p>
            <p><strong>Название: <?php echo $mod['title']  ?></strong></p>
            <p> <strong>Описание: </strong><?php echo $mod['description']  ?> </p>
            <?php  if ($_POST['admin']){ ?><p > Цена:<?php echo $mod['price']  ?>грн<a id="edit" data-good_edit="<?php echo $_POST['id']  ?>" href="#">Редактировать товар</a> </p><?php   }
            else{ ?>
            <p><strong> Цена: </strong><?php echo $mod['price']  ?>грн</p>
            <div class="centered"><a href="<?php echo URL ?>product?article=<?php echo $mod['id'] ?>" >Перейти на страницу</a> <?php } ?></div>

            </div>
        <?php }
    }
?>