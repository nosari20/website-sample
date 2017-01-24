@extends('auth.master')
@section('title', 'Pages')
@section('content')

  <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
  <div class="mdl-tabs__tab-bar">
        <a href="#category-other" class="mdl-tabs__tab is-active">Général</a>
        @foreach($categories as $category)
            <a href="#category-{{$category->id}}" class="mdl-tabs__tab">{{$category->name}}</a>
        @endforeach
  </div>

    <div class="mdl-tabs__panel is-active" id="category-other">
            <table class="mdl-data-table mdl-shadow--2dp">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Accueil</td>
                        <td><a href="{{url('/admin/page/accueil')}}" class="action edit"><i class="material-icons">settings</i></a></td>
                    </tr>
                    @foreach($pages->other as $page)
                        <tr>
                            <td>{{$page->title}}</td>
                            <td><a href="{{url('/admin/page/'.$page->id)}}" class="action edit"><i class="material-icons">settings</i></a></td>
                        </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
  @foreach($categories as $category)
        <div class="mdl-tabs__panel" id="category-{{$category->id}}">
            <table class="mdl-data-table mdl-shadow--2dp">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages->{$category->id} as $page)
                        <tr>
                            <td>{{$page->title}}</td>
                            <td><a href="{{url('/admin/page/'.$page->id)}}"><i class="material-icons">settings</i></a></td>
                        </tr>
                    
                    @empty
                        <tr>
                            <td colspan="2">Aucun contenu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endforeach

    </div>


    <a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored fab-bottom-right" href="{{url('admin/page')}}">
        <i class="material-icons">add</i>
    </a>
@endsection