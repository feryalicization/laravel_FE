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
                <a href="{{ route('dashboard.login') }}"> LOGIN </a> | <a href="{{ route('presensi') }}"> PRESENSI</a>
            </span>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->
    <br>
    <div class="container">
      <h3>PRESENSI MASUK</h3>
    </div>



    <!-- TEXT CENTER -->
<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center"> 
            <div class="d-flex flex-column align-items-center"> 
                <form class="row g-3 w-100" action="{{ route('presensi.qrcodeGenerator') }}" method="POST">
                    @csrf
                    <div class="col-auto">
                        <label for="nip" class="visually-hidden">NIP</label>
                        <input type="text" readonly class="form-control-plaintext" id="nip" name="nip" value="NIP">
                    </div>

                    <div class="col-auto">
                        <label for="nip" class="visually-hidden">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
                        <div class="mt-2 text-end w-100"> 
                          <a href="{{ route('presensi') }}"><small>< Presensi</small></a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button> 
                </form>

            </div>
        </div>
    </div>
</div>
<!-- END TEXT CENTER -->



















    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>