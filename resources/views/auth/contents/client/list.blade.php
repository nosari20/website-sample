@extends('auth.master')
@section('title', 'Clients')
@section('content')



    <table class="mdl-data-table mdl-shadow--2dp">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Utilisateur</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->name}}</td>
                <td><a href="{{url('/admin/client/'.$user->id)}}" class="action edit"><i class="material-icons">settings</i></i></a></td>
            </tr>
        @endforeach
    </tbody>
    </table>

<a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored fab-bottom-right" href="{{url('admin/client/nouveau')}}">
  <i class="material-icons">add</i>
</a>





@endsection