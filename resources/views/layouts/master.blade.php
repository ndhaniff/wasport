<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'WaSport')</title>

        <!-- $title . " | WaSport" -->

        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" >

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.29/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.29/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.theme.css">
        <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/antd/3.8.2/antd.min.css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/antd-style.css') }}" rel="stylesheet">

        @yield('meta')
		@yield('script')
    </head>
    <body>

      <div id="navbar" class="d-flex flex-column flex-md-row align-items-center bg-dark">
        <h1 id="logo" class="m-0"><a href="{{url('/')}}"><img src="{{asset('img/wasport_logo.png')}}" alt="" id="wasport-logo"></a></h1>
        <div>
        <nav id="topbar" class=" text-right p-2">
        <span class="dropdown">
        <a class="p-2 text-light btn locale" id="dropdownMenuLink" data-toggle="dropdown" >
          <i class="fa fa-globe" aria-hidden="true" style="color:#fff;"></i>
          {{App::getLocale()}}
          <i class="fa fa-caret-down" aria-hidden="true" style="color:#fff;"></i></a>
            <ul class="dropdown-menu w-50" name="lang" id="lang">
              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], false) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
            </ul>
        </span>

            @guest
            <!--<span class="dropdown">
                <a class="p-2 text-light btn" id="dropdownMenuLink" data-toggle="dropdown" >{{__("LOGIN")}}</a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-item sign-in">
                    <form class="p-2" method="POST" action="{{ route('login') }}">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Password</label>
                            <input class="form-control" type="password" name="password" id="password" required>
                            @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                        </div>
                        <div class="form-group mb-0">
                                <button class="btn btn-primary" type="submit">{{__("auth.login.regular")}}</button>
                                <a href="{{ url('/auth/facebook') }}" class="btn loginFb btn-secondary">Login with FB</a><br>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                                </a>
                        </div>
                        @csrf

                    </form>
                    </div>
                </div>
            </span>-->
            <a class="p-2 text-light btn" href="{{ route('login') }}" >{{__("LOGIN")}}</a>
            <a class="p-2 text-light" href="{{ route('register') }}">
              <button id="create-account-btn">{{__("CREATE ACCOUNT")}}</button>
            </a>
            @else
            <span class="dropdown loggedIn">
            <a id="navbarDropdown" class="btn dropdown-toggle text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="w-50 dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="/dashboard">
                      {{ __('Profile') }}</a>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </span>
            @endguest
        </nav>
        <nav id="menu" class=" p-2">
            <a class="p-2 text-light" href="/">{{__("HOME")}}</a> |
            <a class="p-2 text-light" href="/guide">{{__("GUIDE")}}</a> |
            <a class="p-2 text-light" href="/races">{{__("EVENT")}}</a> |
            <a class="p-2 text-light" href="#">{{__("OFFLINE EVENT")}}</a> |
            <a class="p-2 text-light" href="/howitworks">{{__("HOW IT WORKS")}}</a>
        </nav>
        </div>
      </div>

      <div id="navbar-mobile">
        <nav id="topbar" class="navbar navbar-inverse text-right p-2">
          <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="{{ asset('img/wasport-logo-mobile.png') }}" id="navbar-mobile-logo"></a>
            <div style="float:right">
              <span class="dropdown">
                <a class="p-2 text-light btn locale" id="dropdownMenuLink" data-toggle="dropdown" >
                  <i class="fa fa-globe" aria-hidden="true" style="color:#fff;"></i>
                  {{App::getLocale()}}
                  <i class="fa fa-caret-down" aria-hidden="true" style="color:#fff;"></i></a>
                  <ul class="dropdown-menu w-50" name="lang" id="lang">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], false) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                    @endforeach
                  </ul>
              </span>

                @guest
                <a class="p-2 text-light btn" href="{{ route('login') }}" >{{__("LOGIN")}}</a>
                <a class="p-2 text-light" href="{{ route('register') }}">
                  <button id="create-account-btn">{{__("CREATE ACCOUNT")}}</button>
                </a>
                @else
                <span class="dropdown loggedIn">
                <a id="navbarDropdown" class="btn dropdown-toggle text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="w-50 dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="/dashboard">
                          {{ __('Profile') }}</a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endguest
              </span>
            </div>
          </div>
        </nav>

        <nav id="btmbar" class="navbar navbar-inverse">
          <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="{{ asset('img/wasport-logo-mobile.png') }}" id="navbar-logo"></a>
            <!--<div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
              </button>
            </div>-->
            <span style="font-size:30px;cursor:pointer;color:#fff;" onclick="openNav()">&#9776;</span>
            <div id="mySidenav" class="sidenav">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
              <a href="/">{{__("HOME")}}</a>
              <a href="/guide">{{__("GUIDE")}}</a>
              <a href="/races">{{__("EVENT")}}</a>
              <a href="#">{{__("OFFLINE EVENT")}}</a>
              <a href="/howitworks">{{__("HOW IT WORKS")}}</a>
            </div>
            <!--<div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="/">{{__("HOME")}}</a></li>
                <li><a href="/guide">{{__("GUIDE")}}</a></li>
                <li><a href="/races">{{__("EVENT")}}</a></li>
                <li><a href="#">{{__("OFFLINE EVENT")}}</a></li>
                <li><a href="/howitworks">{{__("HOW IT WORKS")}}</a></li>
              </ul>
            </div>-->
          </div>
        </nav>
      </div>

      <a href="#" id="scroll" style="display:none"><span></span></a>

      <div class="full-container">
        @yield('content')
      </div>

      <footer>
        <div class="container">
          <div class="row" id="footer-content">
            <div class="col-sm-12 col-md-4" id="footer-col-1">
              <a href="/"><img src="{{asset('img/wasport-logo-footer.png')}}" id="footer-logo"></a>

              <div class="footer-social">
                <a href="#"><img src="{{asset('img/footer-social-fb.png')}}" alt="Facebook"></a>
                <a href="#"><img src="{{asset('img/footer-social-twitter.png')}}" alt="Twitter"></a>
                <a href="#"><img src="{{asset('img/footer-social-ig.png')}}" alt="Instagram"></a>
              </div>

              <div class="footer-social-mobile">
                <center>
                  <a href="#"><img src="{{asset('img/footer-social-fb.png')}}" alt="Facebook"></a>
                  <a href="#"><img src="{{asset('img/footer-social-twitter.png')}}" alt="Twitter"></a>
                  <a href="#"><img src="{{asset('img/footer-social-ig.png')}}" alt="Instagram"></a>
                </center>
              </div>
            </div>
            <div class="col-sm-12 col-md-2">
              <h5>{{__("Company")}}</h5>
              <hr id="footer-title-hr">
              <p><a href="/aboutus">{{__("About Us")}}</a></p>
              <p><a href="/contactus">{{__("Contact")}}</a></p>
              <p><a href="/privacypolicy">{{__("Privacy Policy")}}</a></p>
              <p><a href="/termsandconditions">{{__("Terms and Conditions")}}</a></p>
            </div>
            <div class="col-sm-12 col-md-2">
              <h5><a href="\races">{{__("Event")}}</a></h5>
              <hr id="footer-title-hr">
              <p><a href="\races#new-race">{{__("New Race")}}</a></p>
              <p><a href="\races#past-race">{{__("Past Race")}}</a></p>
            </div>
            <div class="col-sm-12 col-md-4">
              <h5>{{__("Get In Touch")}}</h5>
              <hr id="footer-title-hr">
              <p>{{__("To work with WaSport, please click")}} <a href="\relatedcooperation">{{__("HERE")}}</a><br id="footer-br"/>
              {{__("or send email to")}} info@wasportsrun.com</p>
            </div>
          </div>
        </div>

        <script src="{{asset('js/app.js')}}"></script>

        <hr id="footer-hr">

        <div class="container">
          <p id="copyright">© 2018 WaSport.Designed by Jumix</p>
        </div>
      </footer>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

      <script type="text/javascript">
      function openNav() {
        document.getElementById("mySidenav").style.width = "200px";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }

        $(document).ready(function() {
          $("#carousel").owlCarousel({
            navigation : false,
            slideSpeed : 500,
            paginationSpeed : 800,
            rewindSpeed : 1000,
            singleItem: true,
            autoPlay : true,
            stopOnHover : true,
          });

          $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
              $('#scroll').fadeIn();
            } else {
              $('#scroll').fadeOut();
            }
          });

          $('#scroll').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
          });

        });
      </script>
    </body>
</html>
