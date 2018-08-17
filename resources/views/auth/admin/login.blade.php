<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Wasport Admin Area</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  
<div class="container p-5">
<div class="form-signin card  w-50 m-auto">
  <h5 class="card-header">Admin Login</h5>
  <div class="card-body">
  @if(session('failed'))
  <div class="alert alert-danger">{{session('failed')}}</div>  
  @endif
    <form class="px-3" method="POST" action="{{route('admin.login.submit')}}">
      <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="email" value="{{ old('email') }}" name="email" id="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" type="password" name="password" id="password" required>
      </div>
      <div class="form-group row">
          <div class="col-md-6 offset-md-4">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember">
                      Remember Me
                  </label>
              </div>
          </div>
      </div>
      @csrf
      <button class="btn btn-primary" type="submit">Login</button>
    </form>
  </div>
</div>
</div>

</body>
</html>