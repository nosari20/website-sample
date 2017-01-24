<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <title>Administration - @yield('title')</title>

        <!-- Add to homescreen for Chrome on Android -->
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="icon" sizes="192x192" href="favicon.ico">

        <!-- Add to homescreen for Safari on iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="Administration">
        <link rel="apple-touch-icon-precomposed" href="favicon.ico">

        <meta name="robots" content="noindex">

        <!-- Tile icon for Win8 (144x144 + tile color) -->
        <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
        <meta name="msapplication-TileColor" content="#3372DF">

        <link rel="icon" href="favicon.ico" />

        <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
        <!--
        <link rel="canonical" href="http://www.example.com/">
        -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.grey-red.min.css">
        <link rel="stylesheet" href="{{$adminUrl->css}}styles.css" />

        <link rel="stylesheet" href="{{$adminUrl->vendor}}color-picker/src/palette-color-picker.css"/>


        <link rel="stylesheet" href="{{$adminUrl->font}}font-awesome/css/font-awesome.min.css">

        <!-- Dialog PolyFill -->
        <script src="{{$adminUrl->js}}dialog-polyfill/dialog-polyfill.js"></script>
        <link rel="stylesheet" type="text/css" href="{{$adminUrl->js}}dialog-polyfill/dialog-polyfill.css" />

    </head>
    <body>
        <div id="loader" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
         <div class="layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            @include('auth.components.header')
            @include('auth.components.aside')

            <main class="mdl-layout__content mdl-color--grey-100">
                <div class="mdl-grid">
                    @yield('content')
                </div>
            </main>

            @yield('out')

            

        </div>

     <!-- Include Javascript -->
     <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
     <script src="{{$adminUrl->js}}jquery-2.2.4.min.js"></script>    
     <script src="{{$adminUrl->js}}jquery-circle-menu.js"></script>   
     <script src="{{$adminUrl->vendor}}color-picker/src/palette-color-picker.min.js"></script> 
     <script src="{{$adminUrl->vendor}}cropbox/cropbox.js"></script>
     <script type="text/javascript">
        var global = {
            url : {
                base :"{{ url('/admin') }}",
                root :"{{ url('/') }}",
                upload :"{{$url->upload}}",
            },
            _token :"{{ csrf_token() }}",
            
        };

    </script>


    @yield('extra_js')
    <script src="{{$adminUrl->js}}app.js"></script>
  </body>
</html>


  
