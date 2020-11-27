
<!doctype html>
<html lang="en">
  <head>
    @include('layouts.driver.head');
  </head>

  <body>

    @include('layouts.driver.navhead');

    <main role="main" class="container">

      <div class="starter-template">
        <h1>Halaman Utama Driver</h1>
        <p class="lead">Silahkan Lengkapi Profil Anda Terlebih Dahulu.<br></p>
      </div>

      <div class="row">
        <div class="col-12 .col-md-8">
            <ul class="list-group">
                <li class="list-group-item" style="display: flex; justify-content: center;">
                    <a href="/editktp/{{Auth::id()}}" class="badge badge-primary">Masukkan KTP</a>
                    <?php if (!empty( Auth::user()->ktp)) {
                        echo "  <span class='badge badge-pill badge-success'>Data Sudah dimasukkan</span>";
                    } else {
                        echo "  <span class='badge badge-pill badge-warning'>Data belum dimasukkan</span>";
                    }
                    ?>
                </li>
                <li class="list-group-item" style="display: flex; justify-content: center;">
                    <a href="/editsim/{{Auth::id()}}" class="badge badge-primary">Masukkan SIM</a>
                    <?php if (!empty( Auth::user()->sim)) {
                        echo "  <span class='badge badge-pill badge-success'>Data Sudah dimasukkan</span>";
                    } else {
                        echo "  <span class='badge badge-pill badge-warning'>Data belum dimasukkan</span>";
                    }
                    ?>
                </li>
                <li class="list-group-item" style="display: flex; justify-content: center;">
                    <a href="/editstnk/{{Auth::id()}}" class="badge badge-primary">Masukkan STNK</a>
                    <?php if (!empty( Auth::user()->stnk)) {
                        echo "  <span class='badge badge-pill badge-success'>Data Sudah dimasukkan</span>";
                    } else {
                        echo "  <span class='badge badge-pill badge-warning'>Data belum dimasukkan</span>";
                    }
                    ?>
                </li>
                <li class="list-group-item" style="display: flex; justify-content: center;">
                    <a href="/editskck/{{Auth::id()}}" class="badge badge-primary">Masukkan SKCK</a>
                    <?php if (!empty( Auth::user()->skck)) {
                        echo "  <span class='badge badge-pill badge-success'>Data Sudah dimasukkan</span>";
                    } else {
                        echo "  <span class='badge badge-pill badge-warning'>Data belum dimasukkan</span>";
                    }
                    ?>
                </li>
                <li class="list-group-item" style="display: flex; justify-content: center;">
                    <a href="/editsuratkesehatan/{{Auth::id()}}" class="badge badge-primary">Masukkan Surat Kesehatan</a>
                    <?php if (!empty( Auth::user()->suratkesehatan)) {
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
    @include('layouts.driver.footer');
  </body>
</html>
