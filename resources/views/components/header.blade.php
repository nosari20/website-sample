<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse-side" data-target=".navbar" data-container="#main">
                <i class="fa fa-bars open-nav"></i>
                <i class="fa fa-times close-nav"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#main">
                <i class="fa fa-globe"></i> Awesome
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a href="#main">Home</a>
                </li>
                <li>
                    <a class="page-scroll" href="#about">A propos</a>
                </li>
                <li>
                    <a class="page-scroll" href="#download">Download</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contact</a>
                </li>
            </ul>



        </div>

        <div class="navbar-info">
           <h3>Informations</h3>

            <ul>
                <li>{{$info->address}}
                    <br>
                    {{$info->cp}} {{$info->city}}</li>
                <li>{{$info->phone}}</li>
                <li class="social-info">
                    
                    @foreach ($social as $s)
                        @if ($s->value!="")
                            <a href="{{ $s->value}}" target="_blank"><i class="fa {{ $s->icon }}" aria-hidden="true"></i></a>
                        @endif
                    @endforeach
                   
                </li>

                <li>Legal</li>
            </ul>



        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

