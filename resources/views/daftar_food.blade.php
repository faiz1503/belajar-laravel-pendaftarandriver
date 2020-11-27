
<!doctype html>
<html lang="en">
  <head>
    @include('layouts.merchant.head')
  </head>

  <body>
    <form class="form-signin" method="post" action="{{ url('/foodPost') }}">
        @csrf
      <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Register Merchant Food</h1>
        <p>Silahkan Register Binis Anda Terlebih Dahulu</p>
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
        <input type="text" id="inputnama_bisnis" name="nama_bisnis" class="form-control" placeholder="Nama Bisnis" required>
        <label for="inputnama_bisnis">Nama Bisnis</label>
      </div>
        <label for="inputnama_bisnis">Tipe Bisnis:</label>
        <br>
        <label class="radio-inline"><input type="radio" name="tipe_bisnis" value="legal">Legal</label>
        <label class="radio-inline"><input type="radio" name="tipe_bisnis" value="non_legal">Non Legal</label>
      <div class="form-label-group">
        <input type="text" id="inputalamat" name="alamat" class="form-control" placeholder="Alamat" required>
        <label for="inputalamat">Alamat</label>
      </div>
      <div class="input-group">
        <select class="custom-select" id="kota" name="kota" required>
          <option selected>Pilih Kota...</option>
          <option value="pekanbaru">Pekanbaru</option>
          <option value="padang">Padang</option>
          <option value="medan">Medan</option>
          <option value="aceh">Aceh</option>
        </select>
      </div>
      <br>
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
        <input type="email" id="inputemail" name="email" class="form-control" placeholder="Email" required>
        <label for="inputemail">Email</label>
      </div>
      <div class="form-label-group">
        <input type="password" id="inputpassword" name="password" class="form-control" placeholder="Password" required>
        <label for="inputpassword">Password</label>
      </div>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Daftar</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2020</p>
    </form>
  </body>
</html>
