@extends('auth.master')
@section('title'){{$client->name}}@endsection
@section('content')



<div class="mdl-color--white mdl-card mdl-card--full mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid drop-zone">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">{{$client->name}}</h2>
        </div>
        <div class="mdl-card__supporting-text mdl-cell--12-col">
            <div class="mdl-grid files">
                @foreach($files as $file)

                    <a href="{{url('/file/download/'.$file->id)}}" class="mdl-cell mdl-cell--2-col mdl-cell--2-col-phone file" data-id="{{$file->id}}" data-user="{{$client->id}}" title="{{$file->name}}">
                        <div class="file-icon
                        @if(in_array($file->type,array('pdf')))
                            red
                        @elseif (in_array($file->type,array('xlsx','xlsm','xlsb','xltx','xltm','xls','xml','xla','ods')))
                            green
                        @elseif (in_array($file->type,array('jpeg','jpg','png','gif','bmp')))
                            transparent
                        @endif
                        "
                        >
                        @if (in_array($file->type,array('jpeg','jpg','png','gif','bmp')))
                            <img src="{{url('/file/download/'.$file->id)}}" alt="{{$file->name}}">
                        @else
                            {{$file->type}}
                        @endif
                            <button class="delete"><i class="material-icons">delete</i></button>
                        </div>
                        <div classs="file-name">{{(strlen($file->name) > 30) ? substr($file->name, 0, 30) . '...' : $file->name}}</div>
                        
                    </a>            

                @endforeach 
            </div>

        </div>
    </div>


<nav class="circle-menu">  
  <ul>
    <li>
       <button href="#" class="control-input" data-control="#file">
         <i class="material-icons">file_upload</i></i>
      </button>
    </li>
     <li>
       <button id="search-toggle">
         <i class="material-icons">search</i>
      </button>
    </li>
  </ul>
</nav>

<form action="" method="post" enctype="multipart/form-data" class="hidden-form" id="new-file">
    {{ csrf_field() }}
    <input type="hidden" value="{{$client->id}}" name="user">
    <input type="file" name="file[]" class="submit-after-change" id="file" multiple>    
    <input type="submit">
</form>

@endsection

@section('out')
    <div class="search-bar" data-user="{{$client->id}}">
        <input type="search">
        <ul class="results"> 
        </ul>
    </div>
@endsection

