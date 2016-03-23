</div><!--admincontent-->
</div><!-- container-->


   <?php
   if($_SESSION['login']!='' && $_SESSION['role']!=''):
   ?>
         <script type="text/javascript" src="/../../script/jquery.js"></script>
		
         <script type="text/javascript" src="/../../script/admin.js"></script>
		 <script src="/../../lib/bootstrap/js/bootstrap.min.js"></script>
         <link rel="stylesheet" type="text/css" href="/../../admin/template/admin.css">
		 <link href="/../../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

 <?php endif;

 if($_SESSION['for_imageload']==true) :
 ?>

<script src="/../../lib/multiuploader/js/vendor/jquery.ui.widget.js"></script>
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="/../../lib/multiuploader/js/jquery.iframe-transport.js"></script>
<script src="/../../lib/multiuploader/js/jquery.fileupload.js"></script>
<script src="/../../lib/multiuploader/js/jquery.fileupload-process.js"></script>
<script src="/../../lib/multiuploader/js/jquery.fileupload-image.js"></script>
<script src="/../../lib/multiuploader/js/jquery.fileupload-validate.js"></script>
<script src="/../../lib/multiuploader/js/jquery.fileupload-ui.js"></script>
<script src="/../../lib/multiuploader/js/main.js"></script>

<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="/../../lib/multiuploader/css/jquery.fileupload.css"><!-- big button of input -->
<link rel="stylesheet" href="/../../lib/multiuploader/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="/../../lib/multiuploader/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="/../../lib/multiuploader/css/jquery.fileupload-ui-noscript.css"></noscript>
<?php endif; ?>
</body>
</html>