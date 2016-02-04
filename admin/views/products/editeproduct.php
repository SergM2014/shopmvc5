<h2 class="text-center"> Редагування товару</h2>
<h3 class="text-center">Редактировать изображения </h3>
<div id="for_увше" class="col-sm-10 col-sm-offset-2">
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-8">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Добавить изображения</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Загрузить</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Отменить загрузку</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Удалить</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
    <br>


<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Начать</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Отменить</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Удалить</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Отменить</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

</div><!--for_add-->

<form class="form-horizontal" >
  <input type="hidden" name="id" id="hidden_id" value="<?php echo $mod1['id'] ?>">
  <div class="form-group">
    <label for="author" class="col-sm-2 control-label">Автор</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="author" id="author" maxlength="50" value="<?php echo $mod1['author'] ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">Название</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="title" id="title" maxlength="50" value="<?php echo $mod1['title'] ?>">
    </div>
  </div>
  
   <div class="form-group">
    <label for="description" class="col-sm-2 control-label">Описание</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows=3" id="description" name="description"><?php echo $mod1['description'] ?></textarea>
    </div>
  </div>
  
   <div class="form-group">
    <label for="body" class="col-sm-2 control-label">Выдержка из текста</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows=3" id="body" name="body" ><?php echo $mod1['body'] ?></textarea>
    </div>
  </div>
  
    <div class="form-group">
    <label for="category_id" class="col-sm-2 control-label">Категория</label>
    <div class="col-sm-2">
      <select  class="form-control" name="category" id="category_id" size="1"> 
					
					<option value="<?php echo $mod1['id_cat'] ?>" >Оставить как эсть
					<option  value="0"> Без категории
					<?php echo $mod3 ?>
					</select>
    </div>
  </div>
  
      <div class="form-group">
    <label for="manufacturer_id" class="col-sm-2 control-label">Производитель</label>
    <div class="col-sm-2">
      <select class="form-control" name="manufacturer" id="manufacturer_id" size="1"> 
					<option value="<?php echo $mod1['manufacturer_id'] ?>" >Оставить как эсть
					<option  value="0"> не указывать
					<?php echo $mod4 ?>
					</select>
    </div>
  </div>
  
    <div class="form-group">
    <label for="price" class="col-sm-2 control-label">Цена</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="price" id="price"  value="<?php echo $mod1['price'] ?>">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" id="edit_product">Редактировать товар</button>
    </div>
  </div>
</form>
<?php $_SESSION['for_imageload']=1; ?>