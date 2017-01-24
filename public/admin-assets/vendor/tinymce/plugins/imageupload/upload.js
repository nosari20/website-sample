var ImageUpload = {
	inProgress : function() {
		document.getElementById("upload_form").innerHTML = '<br><p>Transfert en cours...</p><div class="showbox"> <div class="loader"> <svg class="circular" viewBox="25 25 50 50"> <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/> </svg> </div></div>';
		
	},
	uploadSuccess : function(result) {
		document.getElementById("image_preview").style.display = 'block';
		document.getElementById("upload_form").innerHTML = '<br><p>Image transférée</p>';

		
		for (var index = 0; index < result.files.length; ++index) {

			console.log(result.files[index]);
			if(result.files[index].type == 'mp4' | result.files[index].type == 'webm' | result.files[index].type == 'ogg'){

				var node = '<video style="width: 100%;" controls>'+
							'<source src="'+result.files[index].src+'" type="video/'+result.files[index].type+'">'+
							'<object type="application/x-shockwave-flash" width="400" height="222" data="'+result.files[index].src+'">'+
								'<param name="movie" value="'+result.files[index].src+'" />'+
								'<param name="wmode" value="transparent" />'+

								'<!--[if lte IE 6 ]>'+
								'<embed src="'+result.files[index].src+'" type="application/x-shockwave-flash"  allowscriptaccess="always" allowfullscreen="true" width="400" height="222">'+
								'</embed>'+
								'<![endif]-->'+
								'Vous n\'avez pas de navigateur moderne, ni Flash installé... suivez les liens ci-dessous pour télécharger les vidéos.'+
							'</object>'+
						'</video>'
				parent.tinymce.EditorManager.activeEditor.insertContent(node);
													
			}else{
				parent.tinymce.EditorManager.activeEditor.insertContent('<img width:"100%;" src="' + result.files[index].src +'">');
				console.log("Image");
			}
			
		}

		
	}

};