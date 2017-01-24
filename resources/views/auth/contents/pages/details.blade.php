@extends('auth.master')
@section('title'){{$page->title}}@endsection
@section('content')



<div class="mdl-color--white mdl-card mdl-card--full mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">{{$page->title}}</h2>
        </div>
        <div class="mdl-card__supporting-text mdl-cell--12-col">
            
            <form action="@if($page->id!=-1){{url('/admin/page/'.$page->id)}}@else {{url('/admin/page')}}  @endif" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="title" value="{{$page->title}}" name="title">
                    <label class="mdl-textfield__label" for="title">Titre...</label>
                </div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="desc" value="{{$page->description}}" name="description">
                    <label class="mdl-textfield__label" for="desc">Déscription...</label>
                </div>

                <div>
                    @foreach($categories as $category)
                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="cat-{{$category->id}}">
                            <input type="radio" id="cat-{{$category->id}}" class="mdl-radio__button" name="category" value="{{$category->id}}" @if($page->category_id == $category->id) checked @endif>
                            <span class="mdl-radio__label">{{$category->name}}</span>
                        </label>
                    @endforeach
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="cat--1">
                        <input type="radio" id="cat--1" class="mdl-radio__button" name="category" value="-1" @if($page->category_id == -1) checked @endif>
                        <span class="mdl-radio__label">Sans</span>
                    </label>
                   
                </div>
                @if($page->category_id == -1)
                    <div>
                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="menu">
                            <input type="checkbox" id="menu" class="mdl-switch__input" name="menu" @if($page->menu==1) checked @endif >
                            <span class="mdl-switch__label">Menu</span>
                        </label>
                    </div>
                @endif

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input id="tags" type="text" class="tags" value="{{$page->tags}}" name="tags"/>
                </div>

                <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                    <div class="mdl-tabs__tab-bar">
                        <a href="#desktop" class="mdl-tabs__tab is-active">Desktop</a>
                        <a href="#tab" class="mdl-tabs__tab">Tablette</a>
                        <a href="#mobile" class="mdl-tabs__tab">Mobile</a>

                    </div>

                    <div class="mdl-tabs__panel is-active" id="desktop">

                            <input type="hidden" name="content-desktop">
                            <div class="editor-desktop editor">
                                {!!$page->content!!}         
                            
                            </div>
                    
                    </div>

                    <div class="mdl-tabs__panel" id="tab">

                            <input type="hidden" name="content-tab">
                            <div class="editor-tab editor">
                                {!!$page->content_tab!!}         
                            
                            </div>
                    
                    </div>
                    <div class="mdl-tabs__panel" id="mobile">

                            <input type="hidden" name="content-mobile">
                            <div class="editor-mobile editor">
                                {!!$page->content_mobile!!}         
                            
                            </div>
                    
                    </div>
                </div>


                 <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">Enregistrer</button>
                 @if($page->id!=-1)
                    <a class="mdl-button mdl-button-right mdl-button--colored mdl-js-button mdl-button--raised mdl-js-ripple-effect" href="{{url('/admin/page/delete/'.$page->id)}}" onclick="return confirm('Confirmer la suppresion')">Supprimer</a>
                 @endif
            </form>

        </div>
    </div>

@endsection

@section('extra_js')

    <script src="{{$adminUrl->js}}tag.min.js"></script>
    <script src="{{$adminUrl->vendor}}bootstrap/bootstrap.min.js"></script>

    <!--
    <script src="{{$adminUrl->vendor}}summernote/summernote.min.js"></script>
    <script src="{{$adminUrl->vendor}}summernote/lang/summernote-fr-FR.js"></script>
    -->

    <script src="{{$adminUrl->vendor}}tinymce/tinymce.min.js"></script>
    <script src="{{$adminUrl->vendor}}tinymce/jquery.tinymce.min.js"></script>
    


    <link rel="stylesheet" type="text/css" href="{{$adminUrl->vendor}}jquery-ui/jquery-ui.min.css" />
    <script src="{{$adminUrl->vendor}}jquery-ui/jquery-ui.min.js"></script>


    <link rel="stylesheet" type="text/css" href="{{$adminUrl->vendor}}grid-editor/grideditor.css" />
    <link rel="stylesheet" type="text/css" href="{{$adminUrl->vendor}}grid-editor/grideditor-font-awesome.css" />
    <script src="{{$adminUrl->vendor}}grid-editor/jquery.grideditor.js"></script>

    <link rel="stylesheet" type="text/css" href="{{$adminUrl->css}}style-editor.css" />

    <script type="text/javascript">

        $('#tags').tagsInput({width:'100%'});


        var tiny_config = {
                config: {
                            paste_as_text: true,
                            language: 'fr_FR',
                            plugins : "link image code imageupload textcolor colorpicker autoresize imagetools",
                            toolbar: "undo redo | forecolor backcolor fontsizeselect fontselect | justifyleft justifycenter justifyright justifyfull | bullist numlist outdent indent | link image imageupload | code",
                            relative_urls: false,
                            fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
                            imagetools_toolbar: "imageoptions",
                            font_formats :      "Open Sans='Open Sans', sans-serif;"+
                                                "Roboto='Roboto','Helvetica','Arial',sans-serif;"+
                                                "Andale Mono=andale mono,times;"+
                                                "Arial=arial,helvetica,sans-serif;"+
                                                "Arial Black=arial black,avant garde;"+
                                                "Book Antiqua=book antiqua,palatino;"+
                                                "Comic Sans MS=comic sans ms,sans-serif;"+
                                                "Courier New=courier new,courier;"+
                                                "Georgia=georgia,palatino;"+
                                                "Helvetica=helvetica;"+
                                                "Impact=impact,chicago;"+
                                                "Symbol=symbol;"+
                                                "Tahoma=tahoma,arial,helvetica,sans-serif;"+
                                                "Terminal=terminal,monaco;"+
                                                "Times New Roman=times new roman,times;"+
                                                "Trebuchet MS=trebuchet ms,geneva;"+
                                                "Verdana=verdana,geneva;"+
                                                "Webdings=webdings;"+
                                                "Wingdings=wingdings,zapf dingbats",
                            style_formats: [
                                        {title: 'Headers', items: [
                                            {title: 'Header 1', block: 'h1'},
                                            {title: 'Header 2', block: 'h2'},
                                            {title: 'Header 2', block: 'h2', classes:'reverse'},
                                            {title: 'Header 3', block: 'h3'},
                                            {title: 'Header 4', block: 'h4'},
                                            {title: 'Header 5', block: 'h5'},
                                            {title: 'Header 6', block: 'h6'}
                                        ]},
                                        {title: 'Inline', items: [
                                            {title: 'Bold', icon: 'bold', format: 'bold'},
                                            {title: 'Italic', icon: 'italic', format: 'italic'},
                                            {title: 'Underline', icon: 'underline', format: 'underline'},
                                            {title: 'Strikethrough', icon: 'strikethrough', format: 'strikethrough'},
                                            {title: 'Superscript', icon: 'superscript', format: 'superscript'},
                                            {title: 'Subscript', icon: 'subscript', format: 'subscript'},
                                            {title: 'Code', icon: 'code', format: 'code'}
                                        ]},
                                        {title: 'Blocks', items: [
                                            {title: 'Paragraph', format: 'p'},
                                            {title: 'Blockquote', format: 'blockquote'},
                                            {title: 'Div', format: 'div'},
                                            {title: 'Pre', format: 'pre'}
                                        ]},
                                        {title: 'Alignment', items: [
                                            {title: 'Left', icon: 'alignleft', format: 'alignleft'},
                                            {title: 'Center', icon: 'aligncenter', format: 'aligncenter'},
                                            {title: 'Right', icon: 'alignright', format: 'alignright'},
                                            {title: 'Justify', icon: 'alignjustify', format: 'alignjustify'}
                                        ]}
                                    ]
                           
                    }
        }

 


        $('.editor-desktop').gridEditor({
            tinymce: tiny_config
            
        });
         $('.editor-tab').gridEditor({
            layouts : ['tab'],
            tinymce: tiny_config
            
        });
         $('.editor-mobile').gridEditor({
            layouts : ['phone'],
            tinymce: tiny_config
            
        });
        $('form').submit(function(){
            $('input[name="content-desktop"]').val($('.editor-desktop').gridEditor('getHtml'));

            $('input[name="content-tab"]').val($('.editor-tab').gridEditor('getHtml'));

            $('input[name="content-mobile"]').val($('.editor-mobile').gridEditor('getHtml'));
        });





    </script>
@endsection


