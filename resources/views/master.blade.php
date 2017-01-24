<!doctype html>
<html lang="fr" xmlns:og="http://ogp.me/ns#">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="favicon.ico" />
        <title>MyWebsite - @yield('title')</title>

        <!-- SEO -->
        <meta name="description" content="{{$info->description}} @yield('description')" />
        <meta name="keywords" content="{{$tags}}" />

        <!-- OpenGraph Metadata -->
        <meta property="og:title" content="MyWebsite - @yield('title')" />
        <meta property="og:description" content="{{$info->description}} @yield('description')" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{url('/')}}" />
        <meta property="og:image" content="{{$url->img}}logo-gauche-CMJN-mini.png" />

        
        
        <!-- Custom Stylesheets --> 
        <link rel="stylesheet" href="{{$url->css}}styles.css?v=3" />
        @yield('extra_css')
        @yield('extra_font')
    </head>
    <body>
        
        
        @include('components.header')

        <div id="main" class="main {{ isset($link) ? $link : '' }}">
            @yield('content')
        </div>


        @include('components.footer')

        <!-- Include Javascript -->        
        <script src="{{$url->js}}jquery-2.2.4.min.js"></script>
        <script src="{{$url->js}}jquery.mobile-1.4.5.min.js"></script>
        <script src="{{$url->js}}bootstrap.min.js"></script>
        <script type="text/javascript">
            var global = {
                url : {
                    img :"{{$url->img}}",
                },
                info : {
                    gps : {
                        lat : Number("{{$info->gps}}".split(",")[0]),
                        lng : Number("{{$info->gps}}".split(",")[1]),
                    },
                    name: "{{$info->name}}",
                    gapi : "{{$info->gapi}}",
                    recaptcha : "{{$info->recaptchaP}}",
                }
            };

        </script>
        @yield('extra_js')        
        <script src="{{$url->js}}app.js"></script>


        

    </body>
</html>