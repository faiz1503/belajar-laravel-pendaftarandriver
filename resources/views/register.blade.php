
<!doctype html>
<html lang="en">
  <head>
    @include('layouts.login.head')
  </head>

  <body>
    <form class="form-signin" method="post" action="{{ url('/registerPost') }}">
        @csrf
      <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Register Driver</h1>
        <p>Silahkan Register Driver Terlebih Dahulu</p>
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
      <div class="form-label-group">
        <input type="text" id="inputnama_depan" name="nama_depan" class="form-control" placeholder="Nama Depan" required>
        <label for="inputnama_depan">Nama Depan</label>
      </div>
      <div class="form-label-group">
        <input type="text" id="inputnama_belakang" name="nama_belakang" class="form-control" placeholder="Nomor HP" required>
        <label for="inputnama_belakang">Nama Belakang</label>
      </div>
      <div class="form-label-group">
        <input type="text" id="inputno_hp" name="no_hp" class="form-control" placeholder="Nomor HP" required>
        <label for="inputno_hp">Nomor HP</label>
      </div>
      <div class="form-label-group">
        <input type="password" id="inputpassword" name="password" class="form-control" placeholder="Password" required>
        <label for="inputpassword">Password</label>
      </div>
      <div class="input-group">
        <select class="custom-select" id="tipe_driver" name="tipe_driver" required>
          <option selected>Pilih Tipe Driver...</option>
          <option value="motor">Motor</option>
          <option value="mobil">Mobil</option>
        </select>
      </div>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2020</p>
    </form>
  </body>
</html>
