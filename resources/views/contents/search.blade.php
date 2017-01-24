@extends('master')
@section('title', 'Recherche')
@section('content')

<section class="container search">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h3 class="reverse">
                        {{count($results)}} résultats pour : <span class="text-navy">{{$query}}</span>
                    </h3>
        
                    <div class="search-form">
                        <form action="{{url('/search')}}" method="get">
                            <div class="input-group">
                                <input type="text" placeholder="RECHERCHER" name="query" value="{{$query}}" class="form-control input-lg">
                                <div class="input-group-btn">
                                    <button class="btn btn-lg btn-primary" type="submit">
                                        Rechercher
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @foreach($results as $result)
                        <div class="hr-line-dashed"></div>
                        <div class="search-result">
                            <h3><a href="{{$result->link}}">{{$result->title}}</a></h3>
                            <a href="{{$result->link}}" class="search-link">{{$result->link}}</a>
                            <p>
                                {!!$result->description!!}
                            </p>
                        </div>
                    @endforeach
                    <div class="hr-line-dashed"></div>
                </div>
            </div>
        </div>
    </div>
</div>
                    

@endsection