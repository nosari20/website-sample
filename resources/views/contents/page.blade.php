@extends('master')
@section('title'){{$page->title}}@endsection
@section('tags'){{$page->tags}}@endsection
@section('description'){{$page->description}}@endsection
@section('content')
    <section class="page">
        @if($agent->phone)
            {!!$page->content_mobile!!}
        @elseif($agent->tablet)
            {!!$page->content_tab!!}
        @else
            {!!$page->content!!}
        @endif
        
    </section>
@endsection