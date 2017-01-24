@extends('auth.master')
@section('title','Accueil')
@section('content')




  <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
        <div class="mdl-tabs__tab-bar">
                <a href="#diapo" class="mdl-tabs__tab is-active">Diaporama</a>
                <a href="#domains" class="mdl-tabs__tab">Domaines d'intervention</a>
                <a href="#partenaires" class="mdl-tabs__tab">Partenaires</a>
                @foreach($others as $other)
                    <a href="#{{$other->name}}" class="mdl-tabs__tab">{{$other->label}}</a>
                @endforeach
        </div>

        <div class="mdl-tabs__panel is-active" id="diapo">
           <div class="mdl-color--white mdl-card mdl-card--full mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Diaporama</h2>
                </div>
                <div class="mdl-card__supporting-text mdl-cell--12-col">


                    
                    <form action="{{url('/admin/page/accueil/carousel')}}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <table class="mdl-data-table mdl-shadow--2dp table-form carousel">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Texte</th>
                                    <th>Couleur</th>
                                    <th>Couleur de fond</th>
                                    <th>Taille en pixel</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    @forelse($carousel as $slide)
                                        <tr>
                                            <td class="input-image crop-image">
                                                <div class="wrapper">
                                                    <div class="image" style="background-image: url({{$url->upload}}carousel/{{$slide->image}})" data-src="{{$url->upload}}carousel/{{$slide->image}}">
                                                        <i class="material-icons action change">file_upload</i>
                                                    </div>
                                                    <input type="file" accept="image/*" name="slide-image-{{$slide->id}}">
                                                    
                                                </div>
                                            </td>
                                            <td class="input-text">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="slide-text-{{$slide->id}}" value="{{$slide->text}}" name="slide-text-{{$slide->id}}"> 
                                                    <label class="mdl-textfield__label" for="slide-text-{{$slide->id}}">Texte...</label>
                                                </div>
                                                <input type="hidden" name="hidden-slide-{{$slide->id}}">
                                            </td>
                                            <td>
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input color-choser" type="text" value="{{$slide->color}}" name="slide-color-{{$slide->id}}"> 
                                                </div>
                                                
                                            </td>
                                            <td>
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input color-choser" type="text" value="{{$slide->bgcolor}}" name="slide-bgcolor-{{$slide->id}}" data-color="transparent"> 
                                                </div>
                                                
                                            </td>
                                            <td>
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="number" value="{{$slide->size}}" name="slide-size-{{$slide->id}}"> 
                                                </div>
                                                
                                            </td>
                                            <td><a href="#" class="action delete"><i class="material-icons">delete</i></a></td>
                                        </tr>
                                    @empty


                                        <tr>
                                            <td colspan="6">Aucun contenu</td>
                                        </tr>
                                    @endforelse
                                    <tr class="add-row">
                                        <td colspan="6">
                                            <i class="material-icons action edit">add</i>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>


                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">Enregistrer</button>
                    </form>

                </div>
            </div>
        </div>


         <div class="mdl-tabs__panel" id="domains">
           <div class="mdl-color--white mdl-card mdl-card--full mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Domaines d'intervention</h2>
                </div>
                <div class="mdl-card__supporting-text mdl-cell--12-col">


                    
                    <form action="{{url('/admin/page/accueil/domains')}}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <table class="mdl-data-table mdl-shadow--2dp table-form domains">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>URL</th>
                                    <th>Catégorie</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    @forelse($domains as $domain)
                                        <tr>
                                           
                                            <td class="input-text">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="domain-text-{{$domain->id}}" value="{{$domain->text}}" name="domain-text-{{$domain->id}}"> 
                                                    <label class="mdl-textfield__label" for="domain-text-{{$domain->id}}">Nom...</label>
                                                </div>
                                                <input type="hidden" name="hidden-domain-{{$domain->id}}">
                                            </td>
                                             <td class="input-text">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="url" id="domain-link-{{$domain->id}}" value="{{$domain->link}}" name="domain-link-{{$domain->id}}"> 
                                                    <label class="mdl-textfield__label" for="domain-link-{{$domain->id}}">URL...</label>
                                                </div>
                                            </td>
                                            <td class="input-text">
                                                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="domain-cat-{{$domain->id}}-1">
                                                    <input type="radio" id="domain-cat-{{$domain->id}}-1" class="mdl-radio__button" name="domain-cat-{{$domain->id}}" value="part" @if($domain->cat=='part') checked @endif>
                                                    <span class="mdl-radio__label">Particuliers</span>
                                                </label>
                                                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="domain-cat-{{$domain->id}}-2">
                                                    <input type="radio" id="domain-cat-{{$domain->id}}-2" class="mdl-radio__button" name="domain-cat-{{$domain->id}}" value="pro" @if($domain->cat=='pro') checked @endif>
                                                    <span class="mdl-radio__label">Professionnels</span>
                                                </label>
                                            </td>
                                            <td><a href="#" class="action delete"><i class="material-icons">delete</i></a></td>
                                        </tr>
                                    @empty


                                        <tr>
                                            <td colspan="4">Aucun contenu</td>
                                        </tr>
                                    @endforelse
                                    <tr class="add-row">
                                        <td colspan="4">
                                            <i class="material-icons action edit">add</i>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>


                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">Enregistrer</button>
                    </form>

                </div>
            </div>
        </div>


        <div class="mdl-tabs__panel" id="partenaires">
           <div class="mdl-color--white mdl-card mdl-card--full mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Partenaires</h2>
                </div>
                <div class="mdl-card__supporting-text mdl-cell--12-col">


                    
                    <form action="{{url('/admin/page/accueil/partenaires')}}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <table class="mdl-data-table mdl-shadow--2dp table-form partenaires">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>URL</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    @forelse($parts as $part)
                                        <tr>
                                            <td class="input-image">
                                                <div class="wrapper">
                                                    <div class="image" style="background-image: url({{$url->upload}}partenaires/{{$part->logo}})">
                                                        <i class="material-icons action change">file_upload</i>
                                                    </div>
                                                    <input type="file" accept="image/*" name="part-logo-{{$part->id}}">
                                                    
                                                </div>
                                            </td>
                                            <td class="input-text">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="url" id="part-link-{{$part->id}}" value="{{$part->url}}" name="part-link-{{$part->id}}"> 
                                                    <label class="mdl-textfield__label" for="part-link-{{$part->id}}">URL...</label>
                                                </div>
                                                <input type="hidden" name="hidden-part-{{$part->id}}">
                                            </td>
                                        
                                            <td><a href="#" class="action delete"><i class="material-icons">delete</i></a></td>
                                        </tr>
                                    @empty


                                        <tr>
                                            <td colspan="4">Aucun contenu</td>
                                        </tr>
                                    @endforelse
                                    <tr class="add-row">
                                        <td colspan="4">
                                            <i class="material-icons action edit">add</i>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>


                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">Enregistrer</button>
                    </form>

                </div>
            </div>
        </div>

        @foreach($others as $other)

            <div class="mdl-tabs__panel" id="{{$other->name}}">
           <div class="mdl-color--white mdl-card mdl-card--full mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{$other->label}}</h2>
                </div>
                <div class="mdl-card__supporting-text mdl-cell--12-col">


                    
                    <form action="{{url('/admin/page/accueil/'.$other->name)}}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}


                            <div class="editor mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty" style="margin-bottom:25px">
                                <textarea name="{{$other->name}}" placeholder="">{{$other->content}}</textarea>
                            </div>
                        


                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">Enregistrer</button>
                    </form>

                </div>
            </div>
        </div>
        @endforeach

    </div>


@section('extra_js')



<style>
.cropit-preview {
  /* You can specify preview size in CSS */
  width: 200px;
  height: 200px;
}
</style>


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


























@endsection

@section('extra_js')

    <script src="{{$adminUrl->js}}tag.min.js"></script>
    <script src="{{$adminUrl->vendor}}bootstrap/bootstrap.min.js"></script>
@endsection


