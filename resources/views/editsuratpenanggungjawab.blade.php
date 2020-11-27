
<!doctype html>
<html lang="en">
  <head>
    @include('layouts.merchant.head');
  </head>

  <body>

    @include('layouts.merchant.navhead');

    <main role="main" class="container">

      <div class="starter-template">
        <h1>Halaman Utama Merchant Food</h1>
        <p class="lead">Silahkan Lengkapi Profil Anda Terlebih Dahulu.<br></p>
        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('index_food') }}';">
            Kembali
        </button>
      </div>

      <div class="row">
        <div class="col-12 .col-md-8">
            <form action="/editsuratpenanggungjawab/update" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $food->id }}"> <br/>
                <ul class="list-group">
                    <div class="text-center">
                        <img src="{{ url('/data_file/food_merchant/'. $food->suratpenanggungjawab) }}" style="width: 500px; height: 500px;" class="rounded mx-auto d-block">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="custom-file col-12 col-md-12">
                            <input type="file" class="custom-file-input" id="suratpenanggungjawab" name="suratpenanggungjawab" required>
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
                            <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Upload</button>
                        </div>
                    </div>
                </ul>
            </form>
        </div>
      </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    @include('layouts.driver.footer');
  </body>
</html>
