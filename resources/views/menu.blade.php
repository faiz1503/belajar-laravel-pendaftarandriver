
<!doctype html>
<html lang="en">
  <head>
    @include('layouts.menu.head')
  </head>

  <body>
    <form class="form-signin" method="post" action="{{ url('/loginPost')}}">
        @csrf
      <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Menu Menu</h1>
        <p>Silahkan Pilih Menu</p>
        @if (count($errors) > 0)
        <div class = "alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
      </div>
      <button class="btn btn-lg btn-primary btn-block" onclick="location.href='{{ route('login_driver') }}';" type="button">Login Driver</button>
      <button class="btn btn-lg btn-primary btn-block" onclick="location.href='{{ route('login_food') }}';" type="button" >Login Merchant Food</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2020</p>
    </form>
  </body>
</html>
