@extends('master')
@section('title', 'Contact')
@section('content')
<section class="container contact">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <form class="form-horizontal" method="post" action="{{url('/contact')}}">
                    <div class="text-center header"><h2 class="reverse">Nous contacter</h2></div>
                    <div class="panel-body">
                        <fieldset>
                            {{ csrf_field() }} 
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="fname" name="name" type="text" placeholder="Prénom - Nom" class="form-control" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="lname" name="company" type="text" placeholder="Société (facultatif)" class="form-control" value="{{ old('company') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="email" name="email" type="text" placeholder="Adresse e-mail" class="form-control" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input id="phone" name="phone" pattern="^0[0-9]([ .-]?[0-9]{2}){4}$" type="text" placeholder="Numero de téléphone" class="form-control" value="{{ old('phone') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <textarea class="form-control" id="message" name="message" placeholder="Message" rows="7" required>{{ old('message') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">                       
                                <div class="col-sm-12">
                                    <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LeorhUTAAAAAD6gXmRO_Ng5zP0qV3pczztx88bz"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </div>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            @if (session('success'))
                                <div class="alert alert-success">
                                    <ul>
                                        @foreach (session('success') as $success)
                                            <li>{{ $success }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="text-center header"><h2 class="reverse">Notre atelier</h2></div>
                <div class="panel-body text-center">
                    <h4>Adresse</h4>
                    <div>
                    {{$info->name}}<br/>
                    {{$info->address}}<br/>
                    {{$info->cp}} {{$info->city}}<br/><br/>
                    <a href="tel:{{$info->phone}}">{{$info->phone}}</a> - <a href="tel:{{$info->mobile}}">{{$info->mobile}}</a><br/>
                    <a href="mailto:{{$info->email}}">{{$info->email}}</a><br/>
                    </div>
                    <hr />
                    <div id="map1" class="map">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_js')
 <!-- Google maps API -->
<script src="https://maps.google.com/maps/api/js?sensor=false&key={{$info->gapi}}"></script>
 <!-- Google reCaptcha API -->
<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>

<script type="text/javascript">
    function init_map() {
        var myLocation = new google.maps.LatLng(global.info.gps.lat, global.info.gps.lng);
        var mapOptions = {
            center: myLocation,
            zoom: 16
        };
        var marker = new google.maps.Marker({
            position: myLocation,
            title: global.info.name
        });
        var map = new google.maps.Map(document.getElementById("map1"),
            mapOptions);
        marker.setMap(map);
    }
    init_map();



    //Google reCaptcha callback   
    var onloadCallback = function() {
        grecaptcha.render('g-recaptcha', {
            'sitekey' : global.info.recaptcha,
            'callback' : function(response) {
                $('form input[type="submit"]').attr("disabled", false);
            }
        });
    };
    
</script>




@endsection