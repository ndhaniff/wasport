<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Admin | WaSport')</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.min.css">
        @yield('meta')

    </head>
    <body class="">
    <nav class="navbar navbar-expand-lg bg-dark text-light">
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
    
    <script src="{{asset('js/app.js')}}"></script>
    @yield('scripts')
    </body>
</html>
