<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Ajax File Upload with jQuery and PHP - Demo</title>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.form.min.js"></script>
		<script type="text/javascript" src="js/javascript.js"></script>
		<link href="style/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="upload-wrapper">
		<div align="center">
		<h3>Ajax File Uploader</h3>
		<img alt="" id="image_preview" class="thumb" src="about:blank"/>
			<form action="processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
			<input name="FileInput" id="FileInput" type="file" />
			<input type="submit"  id="submit-btn" value="Upload" />
			<input type="reset"  id="reset-btn" value="Reset" />
			<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
			</form>
		<div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div>
		<div id="output"></div>
		</div>
		</div> 

	</body>
</html>