@extends('master')
@section('title', 'Espace client')
@section('content')
    
    <section>

        <h2 class="reverse">Fichiers disponibles</h2>

        <div class="container">

            @foreach($files as $file)

                <a href="{{url('/file/download/'.$file->id)}}" class="col-xs-4 col-sm-3 file">
                    <div class="file-icon
                    @if(in_array($file->type,array('pdf')))
                        red
                    @elseif (in_array($file->type,array('xlsx','xlsm','xlsb','xltx','xltm','xls','xml','xla','ods')))
                        green
                    @elseif (in_array($file->type,array('jpeg','jpg','png','gif','bmp')))
                        yellow
                    @endif
                    ">{{$file->type}}</div>
                    <div classs="file-name">{{$file->name}}</div>
                </a>
            

            @endforeach            

        </div>

    </section>
@endsection