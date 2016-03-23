<script type="text/javascript" src="/../../lib/ckeditor/ckeditor.js"></script>


<form id="form1" name="form1" method="post" action="">
    <textarea name="editor1" id="editor1" cols="45" rows="5"><?php echo $about['about']; ?></textarea>
    <script type="text/javascript">
     CKEDITOR.replace( 'editor1');
    </script>
</form>

<button type="button" id="saveabout" class="btn btn-default pull-right">Сохранить</button>