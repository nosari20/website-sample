@extends('auth.master')
@section('title') FAQ @endsection
@section('content')



<div class="mdl-color--white mdl-card mdl-card--full mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">{{$faq->question}}</h2>
    </div>
    <div class="mdl-card__supporting-text mdl-cell--12-col">
        
        <form action="{{url('/admin/faq/'.$faq->id)}}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="question" value="{{$faq->question}}" name="question">
                <label class="mdl-textfield__label" for="question">Question...</label>
            </div>

                <div class="editor mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty" style="margin-bottom:25px">
                    <textarea name="answer" placeholder="Réponse">{{$faq->answer}}</textarea>
                    <label class="mdl-textfield__label" for="question">Réponse...</label>
                </div>

                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">Enregistrer</button>
                @if($faq->id!=-1)
                    <a class="mdl-button mdl-button-right mdl-button--colored mdl-js-button mdl-button--raised mdl-js-ripple-effect" href="{{url('/admin/faq/delete/'.$faq->id)}}" onclick="return confirm('Confirmer la suppresion')">Supprimer</a>
                @endif
        </form>

    </div>
</div>

@endsection

@section('extra_js')

    <!--
    <script src="{{$adminUrl->vendor}}summernote/summernote.min.js"></script>
    <script src="{{$adminUrl->vendor}}summernote/lang/summernote-fr-FR.js"></script>
    -->
    <script src="{{$adminUrl->vendor}}tinymce/tinymce.min.js"></script>>
    <link rel="stylesheet" type="text/css" href="{{$adminUrl->css}}style-editor.css" />
    <script type="text/javascript">

    document.addEventListener('mdl-componentupgraded', function(e) {
        tinymce.init({
                            selector: '.editor > textarea',
                            mode: 'textareas',
                            body_class: 'editor',
                            content_css : '{{$adminUrl->css}}style-editor.css, {{$adminUrl->vendor}}bootstrap/bootstrap.min.css',
                            height: 500,
                            language: 'fr_FR',
                            plugins : "link image code imageupload textcolor colorpicker autoresize imagetools media",
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
                           
                    });

    });


    </script>
@endsection


