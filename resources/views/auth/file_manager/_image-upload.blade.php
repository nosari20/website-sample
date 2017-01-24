<html>
<head>
	<meta charset="UTF-8">
	<title>Transférer une image</title>
	<script type="text/javascript" src="{{$adminUrl->vendor}}/tinymce/plugins/imageupload/upload.js"></script>
	<script type="text/javascript">
	window.parent.window.ImageUpload.uploadSuccess({
		files : JSON.parse('{!! $files !!}').files
	});
	
	</script>
	
</head>
<body>
</body>
</html>