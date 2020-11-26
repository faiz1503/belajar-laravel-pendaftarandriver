
<!doctype html>
<html lang="en">
  <head>
    @include('layouts.login.head')
  </head>

  <body>
    @if(\Session::has('alert'))
    <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
    </div>
    @endif
    @if(\Session::has('alert-success'))
        <div class="alert alert-success">
            <div>{{Session::get('alert-success')}}</div>
        </div>
    @endif
    <form class="form-signin" method="post" action="{{ url('/loginPost')}}">
      <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Login Driver</h1>
        <p>Silahkan Login Terlebih Dahulu</p>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif
      </div>
      <div class="form-label-group">
        <input type="text" id="inputno_hp" name="no_hp" class="form-control" placeholder="Nomor HP" required autofocus>
        <label for="inputno_hp">Nomor HP</label>
      </div>
      <div class="form-label-group">
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
      <button class="btn btn-lg btn-primary btn-block" href="{{ url('register') }}" type="button" >Belum Punya Akun? Register</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2020</p>
    </form>
  </body>
</html>
