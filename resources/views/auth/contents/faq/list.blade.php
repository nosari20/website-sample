@extends('auth.master')
@section('title', 'FAQ')
@section('content')


    <table class="mdl-data-table mdl-shadow--2dp">
    <thead>
        <tr>
            <th>Question</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($faqs as $faq)
            <tr>
                <td>{{$faq->question}}</td>
                <td><a href="{{url('/admin/faq/'.$faq->id)}}" class="action edit"><i class="material-icons">settings</i></a></td>
            </tr>

        @empty

            <tr>
                <td colspan="2">Aucun contenu</td>
            </tr>
        @endforelse
    </tbody>
    </table>

<a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored fab-bottom-right" href="{{url('admin/faq')}}">
  <i class="material-icons">add</i>
</a>





@endsection