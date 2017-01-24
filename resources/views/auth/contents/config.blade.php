@extends('auth.master')
@section('title', 'Configuration')
@section('content')

    <div class="mdl-color--white mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-card__supporting-text mdl-cell--12-col">
            <form action="{{ url('/admin/config') }}" method="POST"  enctype="multipart/form-data">

                    {{ csrf_field() }}


                    @foreach ($configs as $config)
                        <!-- {{$config->name}} -->
                        @if($config->type == 'image')
                                <div class="input-image">
                                    <label class="mdl-textfield__label" for="{{$config->name}}">{{$config->label}}</label> 
                                    <div class="wrapper">
                                        <div class="image" style="background-image: url({{$url->upload}}{{$config->name}}/{{$config->value}})">
                                            <i class="material-icons action change">file_upload</i>
                                        </div>
                                        <input type="file" accept="image/*" name="{{$config->name}}">
                                        
                                        
                                    </div>
                                </div>

                        @elseif($config->type == 'tags')

                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty">
                            <input id="{{$config->name}}" type="text" class="tags" value="{{$config->value}}" name="{{$config->name}}"/>
                            <label style="top:0;" class="mdl-textfield__label" for="{{$config->name}}">{{$config->label}}</label> 
                        </div>


                        @else

                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{$config->name}}">
                            <input
                                class="mdl-textfield__input"
                                id="{{$config->name}}"
                                type="{{$config->type}}"
                                name="{{$config->name}}"
                                value="{{$config->value}}"
                                @if($config->pattern)
                                    pattern="{{$config->pattern}}"
                                @endif
                            >
                            <label class="mdl-textfield__label" for="{{$config->name}}">{{$config->label}}</label>               
                        </div>

                        @endif
                    @endforeach

                   


    
               
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored center">
                    Valider
                </button>

            </form>

        </div>
    </div>

@endsection

@section('extra_js')
    <script src="{{$adminUrl->js}}tag.min.js"></script>
    <script type="text/javascript">
        $('.tags').tagsInput({width:'100%'});




        $('.input-image').each(function(){
            var $selfInputImage = $(this);

            var $action = $selfInputImage.find('.action');
            var $input = $selfInputImage.find('input');
            var $preview = $selfInputImage.find('.image');

            $action.click(function(){
                $input.click();
            })


            $input.change(function(){

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $preview.css("background-image", "url("+e.target.result+")");
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

    </script>
@endsection