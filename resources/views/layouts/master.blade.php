<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'WaSport')</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/antd/3.8.2/antd.min.css">
        @yield('meta')
		@yield('script')
    </head>
    <body>
      <div id="navbar" class="d-flex flex-column flex-md-row align-items-center bg-dark">
        <h1 id="logo" class="m-0"><a href="{{url('/')}}"><img src="{{asset('img/wasport_logo.png')}}" alt=""></a></h1>
        <div>
        <nav id="topbar" class=" text-right p-2">
        <span class="dropdown">
        <a class="p-2 text-light btn locale" id="dropdownMenuLink" data-toggle="dropdown" >{{App::getLocale()}}</a>
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
            <span class="dropdown">
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
                                <button class="btn loginFb btn-secondary">{{__("auth.login.withfb")}}</button><br>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                                </a>
                        </div>
                        @csrf
                        
                    </form>
                    </div>
                </div>
            </span>
            <a style="vertical-align:middle" class="p-2 text-light" href="{{ route('register') }}">{{__("CREATE ACCOUNT")}}</a>
            @else
            <span class="dropdown loggedIn">
            <a id="navbarDropdown" class="btn dropdown-toggle text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="w-50 dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            <a class="p-2 text-light" href="#">{{__("HOME")}}</a>
            <a class="p-2 text-light" href="#">{{__("GUIDE")}}</a>
            <a class="p-2 text-light" href="#">{{__("EVENT")}}</a>
            <a class="p-2 text-light" href="#">{{__("OFFLINE EVENT")}}</a>
            <a class="p-2 text-light" href="#">{{__("HOW IT WORKS")}}</a>
        </nav>
        </div>
      </div>

        <div class="full-container">
        @yield('content')
        </div>
        <script src="{{asset('js/app.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
