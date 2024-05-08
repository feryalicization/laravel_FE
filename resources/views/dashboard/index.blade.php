<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>


    <!-- vendor/fontawesome-free/css/all.min.css -->

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>

<body id="page-top">

        @include('sidebar')

               
       <!-- THE CONTENT -->
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-4"><!--left col-->
        <div class="text-center">
            @php
                $imageExtensions = ['.png', '.jpg'];
                $imageFound = false;
                foreach ($imageExtensions as $extension) {
                    if (file_exists(public_path('uploads/' . $user->username . $extension))) {
                        $imageFound = true;
                        $imagePath = asset('uploads/' . $user->username . $extension);
                        break;
                    }
                }
            @endphp

            @if($imageFound)
                <img src="{{ $imagePath }}" class="avatar img-circle img-thumbnail" alt="avatar">
            @else
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
            @endif
            
            <h5>{{ $user->first_name }}</h5>
            {{ $user->email }}
        </div>


            <hr><br>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Akses</span>
                    <span>{{ $user->first_name }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Tanggal Terdaftar</span>
                    <span>{{ $user->created_at }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Terakhir Login</span>
                    <span>{{ $user->last_login }}</span>
                </li>
            </ul>
        </div>

        <div class="col-sm-8">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Info Profil</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Ubah Password</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">

                <!-- info profile -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    
                <form class="form" action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="username"> Username </label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="{{ $user->username }}" required value="{{ $user->username }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"> Email </label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="{{ $user->email }}" required value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="first_name"> Nama Depan </label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="{{ $user->first_name }}" required value="{{ $user->first_name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="last_name"> Nama Belakang </label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="{{ $user->last_name }}" required value="{{ $user->last_name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="fileInput"> Upload Photo </label>
                                <input type="file" class="form-control-file" id="fileInput" name="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Update </button>
                                <button class="btn btn-lg btn-danger" type="reset"><i class="glyphicon glyphicon-repeat"></i> Cancel </button>
                            </div>
                        </div>
                    </form>

                </div>

                <!-- ubah password -->
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert" style="display: none;">
                    <span id="errorMessage"></span>
                </div>

                <form class="form" action="{{ route('update.password') }}" method="POST" id="passwordForm">
                        @csrf
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="password_lama"> Password Lama </label>
                                <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Password Lama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="password_baru"> Password Baru </label>
                                <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Password Baru" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="konfirmasi_password"> Konfirmasi Password </label>
                                <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Update </button>
                                <button class="btn btn-lg btn-danger" type="reset"><i class="glyphicon glyphicon-repeat"></i> Cancel </button>
                            </div>
                        </div>
                    </form>
                    
                </div>

            </div>
        </div>

    </div>
</div>
<!-- END CONTENT -->



            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

  <!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>


<script>
    // JavaScript validation
    document.getElementById('passwordForm').addEventListener('submit', function(event) {
        var passwordBaru = document.getElementById('password_baru').value;
        var konfirmasiPassword = document.getElementById('konfirmasi_password').value;

        if (passwordBaru !== konfirmasiPassword) {
            event.preventDefault();
            var errorAlert = document.getElementById('errorAlert');
            errorAlert.innerHTML = "Konfirmasi Password Tidak Sama";
            errorAlert.style.display = 'block';
            document.getElementById('konfirmasi_password').classList.add('is-invalid');
        }
    });
</script>




</body>

</html>