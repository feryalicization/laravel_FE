<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PT Qtasnim Digital Teknologi</title>
  </head>
  <body>
 
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('homepage') }}">PT Qtasnim Digital Teknologi</a>
            
            <span class="navbar-text">
                <a href="{{ route('dashboard.login') }}"> LOGIN </a> | <a href="#"> PRESENSI</a>
            </span>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->


    <!-- TEXT CENTER -->
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col text-center">
            <img src="{{ asset('resources/assets/index.jpg') }}" alt="">
                <p>Selamat Datang di Aplikasi Persensi Pegawai Non PNS Samsat Kabupaten Subang</p>
                <br>
                <div class="d-grid gap-2 d-md-block">
                  <a href="{{ route('presensi-masuk') }}"> <button class="btn btn-primary" type="button">Masuk</button> </a>
                  <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  <a href="{{ route('presensi-pulang') }}"> <button class="btn btn-danger" type="button">Pulang</button> </a>
                </div>
            </div>
        </div>
    </div>

    <!-- END TEXT CENTER -->


















    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>