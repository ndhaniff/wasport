<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Admin | WaSport')</title>

        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" >

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/antd/3.8.2/antd.min.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin-style.css') }}" rel="stylesheet">
        @yield('meta')

    </head>
    <body class="">
    <nav class="navbar navbar-expand-lg admin-navbar text-light">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Wasport</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler">

        <form class="my-2 my-lg-0" role="form" method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-light my-2 my-sm-0" type="submit">Logout</button>
        </form>
    </div>
</nav>
    @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>Success!</strong> {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="wrapper">
    @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script>
    @yield('scripts')
    </body>
</html>
