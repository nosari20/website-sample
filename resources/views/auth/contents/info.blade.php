@extends('auth.master')
@section('title', 'Informations générales')
@section('content')

    <div class="mdl-color--white mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-card__supporting-text mdl-cell--12-col">
            <form action="{{ url('/admin/info') }}" method="POST">

                    {{ csrf_field() }}

                    @foreach ($infos as $info)
                        <!-- {{$info->name}} -->
                        @if($info->type != 'tags')
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{$info->name}}">
                                <input
                                    class="mdl-textfield__input"
                                    id="{{$info->name}}"
                                    type="{{$info->type}}"
                                    name="{{$info->name}}"
                                    value="{{$info->value}}"
                                    @if($info->pattern)
                                        pattern="{{$info->pattern}}"
                                    @endif
                                >
                                <label class="mdl-textfield__label" for="{{$info->name}}">{{$info->label}}</label>               
                            </div>
                        @else

                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty">
                            <input id="{{$info->name}}" type="text" class="tags" value="{{$info->value}}" name="{{$info->name}}"/>
                            <label style="top:0;" class="mdl-textfield__label" for="{{$info->name}}">{{$info->label}}</label> 
                        </div>

                        @endif
                    @endforeach


                
               



                <div class="spacer large"></div>
               
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
    </script>
@endsection