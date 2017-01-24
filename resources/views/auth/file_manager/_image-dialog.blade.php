<html>
<head>
	<meta charset="UTF-8">
	<title>Transférer une image</title>
	<link href="/css/app.css" rel="stylesheet">
	<style type="text/css">
		body {
			background-color: #eee;
		}

		.showbox {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			padding: 5%;
		}

		.loader {
			position: relative;
			margin: 0 auto;
			width: 100px;
		}
		.loader:before {
			content: '';
			display: block;
			padding-top: 100%;
		}

		.circular {
			-webkit-animation: rotate 2s linear infinite;
					animation: rotate 2s linear infinite;
			height: 100%;
			-webkit-transform-origin: center center;
					transform-origin: center center;
			width: 100%;
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
		}

		.path {
			stroke-dasharray: 1, 200;
			stroke-dashoffset: 0;
			-webkit-animation: dash 1.5s ease-in-out infinite, color 6s ease-in-out infinite;
					animation: dash 1.5s ease-in-out infinite, color 6s ease-in-out infinite;
			stroke-linecap: round;
		}

		@-webkit-keyframes rotate {
			100% {
				-webkit-transform: rotate(360deg);
						transform: rotate(360deg);
			}
		}

		@keyframes rotate {
			100% {
				-webkit-transform: rotate(360deg);
						transform: rotate(360deg);
			}
		}
		@-webkit-keyframes dash {
			0% {
				stroke-dasharray: 1, 200;
				stroke-dashoffset: 0;
			}
			50% {
				stroke-dasharray: 89, 200;
				stroke-dashoffset: -35px;
			}
			100% {
				stroke-dasharray: 89, 200;
				stroke-dashoffset: -124px;
			}
		}
		@keyframes dash {
			0% {
				stroke-dasharray: 1, 200;
				stroke-dashoffset: 0;
			}
			50% {
				stroke-dasharray: 89, 200;
				stroke-dashoffset: -35px;
			}
			100% {
				stroke-dasharray: 89, 200;
				stroke-dashoffset: -124px;
			}
		}
		@-webkit-keyframes color {
			100%,
			0% {
				stroke: #d62d20;
			}
			40% {
				stroke: #0057e7;
			}
			66% {
				stroke: #008744;
			}
			80%,
			90% {
				stroke: #ffa700;
			}
		}
		@keyframes color {
			100%,
			0% {
				stroke: #d62d20;
			}
			40% {
				stroke: #0057e7;
			}
			66% {
				stroke: #008744;
			}
			80%,
			90% {
				stroke: #ffa700;
			}
		}

	</style>
</head>
<body>
<div class="container">
	<div class="row col-md-10 col-md-offset-1">
		<div id="upload_form">
			<p>
				<!-- Change the url here to reflect your image handling controller -->
				{!! Form::open(array('url' => 'admin/filemanager/upload', 'method' => 'POST', 'files' => true, 'target' => 'upload_target')) !!}
				{!! Form::file('files[]', array('onChange' => 'this.form.submit(); ImageUpload.inProgress();', 'multiple'=>true)) !!}
				{!! Form::close() !!}
			</p>
		</div>
		<div id="image_preview" style="display:none; font-style: helvetica, arial;">
			<iframe frameborder=0 scrolling="no" id="upload_target" name="upload_target" height=240 width=320></iframe>
		</div>
	</div>
	<script type="text/javascript" src="{{$adminUrl->vendor}}/tinymce/plugins/imageupload/upload.js"></script>
</div>
</body>
</html>

