<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

 error_reporting(E_ALL | E_STRICT); 
 require('UploadHandler.php');
 $path='temporary/';
 
 
 $options = array('upload_dir'=>$_SERVER['DOCUMENT_ROOT'].'/uploads/'.$path, 'upload_url'=>'http://'.$_SERVER['SERVER_NAME'].'/uploads/'.$path);
 $upload_handler = new UploadHandler($options);