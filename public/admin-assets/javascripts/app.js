$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': global._token
    }
});

function startLoading(){
    $('#loader').show();
}
function stopLoading(){
    $('#loader').hide();
}


var $circleMenu = $('.circle-menu');
if($circleMenu){
    $circleMenu.circleMenu({
    direction: 'up',
    position: {
        x: 'right',
        y: 'bottom'
    }
    });
}


$('.control-input').click(function(e){
    e.preventDefault();
    $($(this).attr('data-control')).first().click();
});

$('.submit-after-change').change(function(){
    startLoading();
    setTimeout(function(){
         $(this).find('+input[type="submit"]').click();
         console.log('submit form');
    }.bind(this),2000);
});

$('form#new-file').submit(function(e){
    e.preventDefault();
    var data = new FormData($(this)[0]);
    sendFiles(data);
});

function sendFiles(data){
    console.log(data.get('file[]'));
    $.ajax({
       url : global.url.base+'/file/upload',
       type : 'POST',
       data : data,
       processData: false,
       contentType: false,
       success : function(data) {
            var $file;
            for (var i = 0; i < data.length; i++) {
                $file = $(createFileView(data[i].id,data[i].name,data[i].type, data[i].user));
                attachFileHandler($file);
                $('.files').append($file);
            }
           stopLoading();

       }
    });
}
function createFileView(id,nom,type,user){
    var color = '';
    if(['pdf'].indexOf(type)!=-1){
        color = 'red';
    }else if(['xlsx','xlsm','xlsb','xltx','xltm','xls','xml','xla','ods'].indexOf(type)!=-1){
        color = 'green';
    }else if(['jpeg','jpg','png','gif','bmp'].indexOf(type)!=-1){
        color = 'transparent';
    }
    return '<a href="'+global.url.root+'/file/download/'+id+'" class="mdl-cell mdl-cell--2-col mdl-cell--2-col-phone file" data-id="'+id+'" data-user="'+user+'" title="'+name+'">'+
                '<div class="file-icon '+color+'">'+((color == "transparent") ? '<img src="'+global.url.root+'/file/download/'+id+'" alt="'+nom+'">' : type)+'<button class="delete"><i class="material-icons">delete</i></button></div>'+
                '<div classs="file-name">'+((nom.length > 30) ? nom.substring(0,30)+'...' : nom )+'</div>'+
            '</a>';
}
function attachFileHandler(el){
    var $el = $(el);
    $el.find('.delete').click(function(e){
        e.stopPropagation();
        e.preventDefault();
        startLoading();
        if(confirm("Confirmer la supression ?")){
            var data = new FormData();
            data.append('user',$el.attr('data-user'));
            data.append('file',$el.attr('data-id'));
            $.ajax({
                url : global.url.base+'/file/delete',
                type : 'POST',
                data : data,
                processData: false,
                contentType: false,
                success : function(data) {
                    $el.hide();
                    console.log($el);
                    stopLoading();
                },
                error : function(){
                    alert('Une erreur est survenue');
                }
            });
        }
    });
}
$('.file').each(function(){
    attachFileHandler($(this));
});
/**
 * Drag and drop
**/
/*
if($('.drop-zone').length>0){
    $('.drop-zone').on('dragover', function(e){
        e.preventDefault();  
        $(this).css('border','dashed 6px gray');      
    });
    $('.drop-zone').on('dragenter',function(e){
         e.preventDefault();
         $(this).css('border','dashed 6px gray');
    });
    $('.drop-zone').on('dragleave',function(e){
         e.preventDefault();
         $(this).css('border','none');
    });
    $('.drop-zone').on('drop', function(e) {        
        e.preventDefault();
        e.stopPropagation();

        var files = e.originalEvent.dataTransfer.files;
        startLoading();
        console.log(files);
        if(files.length > 0){
             var data = new FormData($('form#new-file')[0]);

            data.append('file[]',files);  
                
            sendFiles(data);
        }else{
            stopLoading();
            alert('Une erreur est survenue, veuillez réesayer');
        }
       
        //e.originalEvent.dataTransfer.files
        $(this).css('border','none');
        return false;
    });
}
*/







if($('.search-bar').length>0){

    var $toggle = $('#search-toggle');

    $toggle.click(function(e){
        $('.search-bar').toggleClass('visible');
        e.stopPropagation();
    });

    $(document).click(function(e){
        $('.search-bar').removeClass('visible');
    });


    var $el = $('.search-bar');

    var $input = $el.find('input');
    var $list = $el.find('ul.results');
    var userId = $el.attr('data-user');

    $el.click(function(e){
        e.stopPropagation();
    });

    $input.change(function(){
        var $this = $(this);

        var query = $this.val();

        $.ajax({
            url : global.url.base+'/file/search/'+query,
            type : 'GET',
            processData: false,
            contentType: false,
            success : function(data) {
                    var $file;
                    $list.empty();
                    for (var i = 0; i < data.length; i++) {
                        
                        $file = $(createFileViewMini(data[i].id,data[i].name,data[i].type));
                        attachFileMiniHandler($file);
                        
                        $list.append($file);
                        
                    }

            }
        });




    });



    function createFileViewMini(id,nom,type){
        var color = '';
        if(['pdf'].indexOf(type)!=-1){
            color = 'red';
        }else if(['xlsx','xlsm','xlsb','xltx','xltm','xls','xml','xla','ods'].indexOf(type)!=-1){
            color = 'green';
        }else if(['jpeg','jpg','png','gif','bmp'].indexOf(type)!=-1){
            color = 'yellow';
        }
        return  '<li data-id="'+id+'">'+
                    '<div class="file-icon mini '+color+'">'+type+'</div>'+
                    '<div class="name">'+((nom.length > 30) ? nom.substring(0,30)+'...' : nom )+'</div>'+
                '</li>';
    }

    function attachFileMiniHandler(el){
    var $el = $(el);

    $el.click(function(){
        var user = userId;
        var id = $el.attr('data-id');

         var data = new FormData();
        data.append('user',user);
        data.append('file',id);
        startLoading();
        $.ajax({
            url : global.url.base+'/file/grant',
            type : 'POST',
            data : data,
            processData: false,
            contentType: false,
            success : function(data) {

                $file = $(createFileView(data.id,data.name,data.type,user));
                attachFileHandler($file);
                $('.files').append($file);
                stopLoading();

                $list.empty();
                $toggle.click();
                

            }
        });
    });
}



}

//tabs "router"
function router(){
    if(window.location.hash) {
        var myregexp = /tab\[([a-zA-Z0-9]+)\]/;
        var hash = window.location.hash.substring(1);
        var match = myregexp.exec(hash);
        if (match != null) {
            $('a[href="#'+match[1]+'"] span').click();
            console.log($('a[href="#'+match[1]+'"] span'));


            $('a.mdl-tabs__tab').removeClass('is-active');
            // activate desired tab
             $('a[href="#'+match[1]+'"]').addClass('is-active');
            // remove all is-active classes from panels
            $('.mdl-tabs__panel').removeClass('is-active');
            // activate desired tab panel
             $('#'+match[1]).addClass('is-active');
        }
    }
    document.removeEventListener('mdl-componentupgraded', router);
}
document.addEventListener('mdl-componentupgraded', router);


//table-form
function initHandlerTableFormRow(row){
    var $row = $(row);
    $row.each(function(){
        var $selfRow = $(this);
        initHandlerTableFormEditImage($selfRow);
        initHandlerTableFormDelete($selfRow);
        initHandlerTableFormColorChoser($selfRow);
        
    });
    componentHandler.upgradeDom();
    
}
function initHandlerTableFormEditImage(el){
    var $el = $(el).find('.input-image');

    $el.each(function(){
        var $selfInputImage = $(this);

        var $action = $selfInputImage.find('.action');
        var $input = $selfInputImage.find('input');
        var $preview = $selfInputImage.find('.image');
        var cropper;

        var name = $input.attr('name').split('-');
        var context = name[0];
        var content = name[1];
        name.shift();
        name.shift();
        var id = name.shift();
        

        $action.click(function(){
            $input.click();
        })

        var isCrop = $selfInputImage.is('.crop-image');

        if(isCrop){


            
            var $b64Input = $('<input type="hidden" name="'+$input.attr('name')+'">');
            var $imageTypeInput = $('<input type="hidden" name="'+context+'-'+content+'-type-'+id+'" value="b64">');
            $b64Input.insertAfter($input);
            $imageTypeInput.insertAfter($input);

            var $cropButton = $('<i class="material-icons action change" style="right:40px; display:none;">crop</i>')
            $cropButton.insertAfter($action);

            

            var $thumbBox =     $('<div class="thumbBox"'+
                                    'style = "'+
                                    'position: relative;'+ 
                                    'height: 100%;'+ 
                                    'width: 100%;'+ 
                                    'border:1px solid #aaa;'+ 
                                    'background: none repeat scroll 0% 0% transparent;'+ 
                                    'overflow: hidden;'+ 
                                    'background-repeat: no-repeat;'+ 
                                    'cursor:move;'+ 
                                    '"'+ 
                                  '></div');

            $preview.append($thumbBox);
            var crop_options = {
                thumbBox: $thumbBox,
                imgSrc: $preview.attr('data-src'),
                ratio : 10,
                startCroping : function(){
                    $cropButton.show();
                }
            }

            cropper = $preview.cropbox(crop_options);

            $cropButton.click(function(){
                var img = cropper.getDataURL();
                $b64Input.val(img);
                $(this).hide();
            });

            $input.attr('name','');
        }

        $input.change(function(){

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    
                    if(isCrop){
                        crop_options.imgSrc = e.target.result;
                        cropper = $preview.cropbox(crop_options);
                        this.files = [];
                        $b64Input.val(cropper.getDataURL());
                    }else{
                        $preview.css("background-image", "url("+e.target.result+")");
                    }
                }
                reader.readAsDataURL(this.files[0]);
            }
        });





    });
    
}
function initHandlerTableFormDelete(el){
    var $el = $(el).find('.action.delete');
    $el.click(function(){
        $delete = $(this);
        if(confirm('Confirmer la suppresion')){
            $delete.closest('tr').remove();
        }
    });
}
function initHandlerTableFormColorChoser(el){
    var $el = $(el).find('.color-choser');
    $el.each(function(){
        $this = $(this);
        var baseColors= [ 
                 
                "#0D93D2",
                "#444",
                "#ABABAB",
                "#D6D6D6",
                "#F5F5F5",

                '#1abc9c',
                '#2ecc71',
                '#3498db',
                '#9b59b6',
                '#34495e',
                '#16a085',
                '#27ae60',
                '#2980b9',
                '#8e44ad',
                '#2c3e50',
                '#f1c40f',
                '#e67e22',
                '#e74c3c',
                '#ecf0f1',
                '#95a5a6',
                '#f39c12',
                '#d35400',
                '#c0392b',
                '#bdc3c7',
                '#7f8c8d',
            ];

        if($this.attr('data-color') == 'transparent'){

            function hexToR(h) {return parseInt((cutHex(h)).substring(0,2),16)}
            function hexToG(h) {return parseInt((cutHex(h)).substring(2,4),16)}
            function hexToB(h) {return parseInt((cutHex(h)).substring(4,6),16)}
            function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h}
            colors = [];            
            $.each(baseColors, function(i,color){
                colors.push('rgba('+hexToR(color)+','+hexToG(color)+','+hexToB(color)+',.4)');
            })
        }else{
             colors = baseColors;
        }
        $('[name="'+$this.attr('name')+'"]').paletteColorPicker({
           colors: colors,
           position: 'downside',
        });
    });
    
}
//General
var $tableForm = $('.table-form');
initHandlerTableFormRow($tableForm.find('tr'));


//table form carousel
var $tableFormCarousel = $('.table-form.carousel');
var $addRowCarousel = $tableFormCarousel.find('.add-row');
function createCarouselRow(){
    var id = (new Date().getTime()).toString(16);
    var html = '<tr>'+
                    '<td class="input-image">'+
                        '<div class="wrapper">'+
                            '<div class="image" style="background-image: url('+global.url.upload+'carousel/default.jpg)">'+
                                '<i class="material-icons action change">file_upload</i>'+
                            '</div>'+
                            '<input type="file" accept="image/*" name="slide-image-new-'+id+'">'+
                            
                        '</div>'+
                    '</td>'+
                    '<td class="input-text">'+
                        '<div class="mdl-textfield mdl-js-textfield">'+
                            '<input class="mdl-textfield__input" type="text" id="slide-text-new-'+id+'" value="" name="slide-text-new-'+id+'"> '+
                            '<label class="mdl-textfield__label" for="slide-text-new-'+id+'">Texte...</label>'+
                        '</div>'+
                        '<input type="hidden" name="hidden-slide-new-'+id+'">'+
                    '</td>'+
                    '<td>'+
                        '<div class="mdl-textfield mdl-js-textfield">'+
                            '<input class="mdl-textfield__input color-choser" type="text" value="" name="slide-color-new-'+id+'">'+ 
                        '</div>'+
                    '</td>'+
                    '<td>'+
                        '<div class="mdl-textfield mdl-js-textfield">'+
                            '<input class="mdl-textfield__input color-choser" type="text" value="" name="slide-bgcolor-new-'+id+'" data-color="transparent">'+
                        '</div>'+
                        
                    '</td>'+
                    '<td>'+
                        '<div class="mdl-textfield mdl-js-textfield">'+
                            '<input class="mdl-textfield__input" type="number" value="30" name="slide-size-new-'+id+'">'+
                        '</div>'+                        
                    '</td>'+
                    '<td><a href="#" class="action delete"><i class="material-icons">delete</i></a></td>'+
                '</tr>';
    
    return $(html);
}
$addRowCarousel.click(function(){
    var $row = createCarouselRow().insertBefore($addRowCarousel);
    initHandlerTableFormRow($row);
});




//table form domains
var $tableFormDomains = $('.table-form.domains');
var $addRowDomains = $tableFormDomains.find('.add-row');
function createDomainsRow(){
    var id = (new Date().getTime()).toString(16);
    var html = '<tr>'+
                    '<td class="input-text">'+
                        '<div class="mdl-textfield mdl-js-textfield">'+
                            '<input class="mdl-textfield__input" type="text" id="domain-text-'+id+'" value="" name="domain-text-new-'+id+'"> '+
                            '<label class="mdl-textfield__label" for="domain-text-'+id+'">Nom...</label>'+
                        '</div>'+
                        '<input type="hidden" name="hidden-domain-new-'+id+'">'+
                   '</td>'+
                        '<td class="input-text">'+
                        '<div class="mdl-textfield mdl-js-textfield">'+
                            '<input class="mdl-textfield__input" type="url" id="domain-lik-'+id+'" value="" name="domain-link-new-'+id+'">'+ 
                            '<label class="mdl-textfield__label" for="domain-lik-'+id+'">URL...</label>'+
                        '</div>'+
                    '</td>'+
                    '<td class="input-text">'+
                        '<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="domain-cat-'+id+'-1">'+
                            '<input type="radio" id="domain-cat-'+id+'-1" class="mdl-radio__button" name="domain-cat-new-'+id+'" value="part" checked>'+
                            '<span class="mdl-radio__label">Particuliers&nbsp;</span>'+
                        '</label>'+
                        '<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="domain-cat-'+id+'-2">'+
                            '<input type="radio" id="domain-cat-'+id+'-2" class="mdl-radio__button" name="domain-cat-new-'+id+'" value="pro">'+
                            '<span class="mdl-radio__label">Professionnels</span>'+
                        '</label>'+
                    '</td>'+
                    '<td><a href="#" class="action delete"><i class="material-icons">delete</i></a></td>'+
                '</tr>';
    
    return $(html);
}
$addRowDomains.click(function(){
    var $row = createDomainsRow().insertBefore($addRowDomains);
    initHandlerTableFormRow($row);
});



//table form Part
var $tableFormPart = $('.table-form.partenaires');
var $addRowPart = $tableFormPart.find('.add-row');
function createPartRow(){
    var id = (new Date().getTime()).toString(16);
    var html = '<tr>'+
                    '<td class="input-image">'+
                        '<div class="wrapper">'+
                            '<div class="image" style="background-image: url('+global.url.upload+'partenaires/default.jpg)">'+
                                '<i class="material-icons action change">file_upload</i>'+
                            '</div>'+
                            '<input type="file" accept="image/*" name="part-logo-new-'+id+'">'+
                            
                        '</div>'+
                    '</td>'+
                    '<td class="input-text">'+
                        '<div class="mdl-textfield mdl-js-textfield">'+
                            '<input class="mdl-textfield__input" type="text" id="part-text-new-'+id+'" value="" name="part-link-new-'+id+'"> '+
                            '<label class="mdl-textfield__label" for="part-text-new-'+id+'">URL...</label>'+
                        '</div>'+
                        '<input type="hidden" name="hidden-part-new-'+id+'">'+
                    '</td>'+
                    '<td><a href="#" class="action delete"><i class="material-icons">delete</i></a></td>'+
                '</tr>';
    
    return $(html);
}
$addRowPart.click(function(){
    var $row = createPartRow().insertBefore($addRowPart);
    initHandlerTableFormRow($row);
});