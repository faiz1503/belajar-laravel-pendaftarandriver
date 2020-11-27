
<!doctype html>
<html lang="en">
  <head>
    @include('layouts.driver.head')
  </head>

  <body>

    @include('layouts.driver.navhead')

    <main role="main" class="container">

      <div class="starter-template">
        <h1>Halaman Utama Merchant Food</h1>
        <p class="lead">Silahkan Lengkapi Profil Anda Terlebih Dahulu.<br></p>
      </div>

      <div class="row">
        <div class="col-12 .col-md-8">
            <ul class="list-group">
                <li class="list-group-item" style="display: flex; justify-content: center;">
                    <a href="/editsuratperusahaan/{{Auth::id()}}" class="badge badge-primary">Masukkan Surat Perusahaan</a>
                    <?php if (!empty( Auth::user()->suratperusahaan)) {
                        echo "  <span class='badge badge-pill badge-success'>Data Sudah dimasukkan</span>";
                    } else {
                        echo "  <span class='badge badge-pill badge-warning'>Data belum dimasukkan</span>";
                    }
                    ?>
                </li>
                <li class="list-group-item" style="display: flex; justify-content: center;">
                    <a href="/editsuratdirektur/{{Auth::id()}}" class="badge badge-primary">Masukkan Surat Direktur</a>
                    <?php if (!empty( Auth::user()->suratdirektur)) {
                        echo "  <span class='badge badge-pill badge-success'>Data Sudah dimasukkan</span>";
                    } else {
                        echo "  <span class='badge badge-pill badge-warning'>Data belum dimasukkan</span>";
                    }
                    ?>
                </li>
                <li class="list-group-item" style="display: flex; justify-content: center;">
                    <a href="/editsuratpenanggungjawab/{{Auth::id()}}" class="badge badge-primary">Masukkan Surat Penanggung Jawab</a>
                    <?php if (!empty( Auth::user()->suratpenanggungjawab)) {
                        echo "  <span class='badge badge-pill badge-success'>Data Sudah dimasukkan</span>";
                    } else {
                        echo "  <span class='badge badge-pill badge-warning'>Data belum dimasukkan</span>";
                    }
                    ?>
                </li>
                <li class="list-group-item" style="display: flex; justify-content: center;">
                    <a href="/editsuratpembayaran/{{Auth::id()}}" class="badge badge-primary">Masukkan Surat Pembayaran</a>
                    <?php if (!empty( Auth::user()->suratpembayaran)) {
                        echo "  <span class='badge badge-pill badge-success'>Data Sudah dimasukkan</span>";
                    } else {
                        echo "  <span class='badge badge-pill badge-warning'>Data belum dimasukkan</span>";
                    }
                    ?>
                </li>
            </ul>
        </div>
      </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    @include('layouts.driver.footer')
  </body>
</html>
