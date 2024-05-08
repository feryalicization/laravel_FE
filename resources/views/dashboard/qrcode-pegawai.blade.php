<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Transaksi Barang</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- DataTables CSS and JS for Bootstrap 4 -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/9da3847bc8.js" crossorigin="anonymous"></script>


    <!-- Your other scripts -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>        



</head>

<body id="page-top">
    @include('sidebar-2')

    <!-- Begin Page Content -->
    <div class="container-fluid">
            <div class="row">
        <div class="col-sm-4">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Generate QR Code</h5>
                <br>
                <form action="{{ route('user.qrcodeGenerator') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nip" class="form-label"> <strong> INPUT NIP </strong></label>
                        <input type="text" class="form-control" id="nip" name="nip" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title"> Informasi QR Code akan muncul disini</h5>

            </div>
            </div>
        </div>

        </div>
     



    </div>
    <!-- End Page Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2024</span>
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

 

    <script>

    function confirmDelete(pegawaiId) {
        var deleteForm = document.getElementById('deleteForm');
        deleteForm.action = deleteForm.action.replace(':id', pegawaiId);
        $('#deleteConfirmationModal').modal('show');
    }
</script>



</body>

</html>
