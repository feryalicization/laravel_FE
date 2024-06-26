<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Charts</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/9da3847bc8.js" crossorigin="anonymous"></script>

    <!-- Custom styles for DataTables -->
    <link href="{{ asset('https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>

<!-- rest of the HTML content remains unchanged -->


<body id="page-top">

    @include('sidebar-2')

    <!-- Begin Page Content -->
    <div class="container-fluid"> 

        <form id="editTranasaksi">
            <div class="mb-3">
                <label for="barang" class="form-label">Barang</label> 
                <select class="form-select" id="barang" name="barang" required style="margin-left: 53px;width: 150px;">
                    @foreach ($response as $key => $barang)
                    <option value="{{ $barang['id'] }}"> {{ $barang['nama_barang'] }} </option>
                    @endforeach

            </select>
            </div>
            <div class="mb-3">
                <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                <select class="form-select" id="jenis_transaksi" name="jenis_transaksi" required style="width: 150px;">
                    <option value="jual">Jual</option>
                    <option value="beli">Beli</option>
            </select>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <!-- Other form fields here -->
            <button type="button" id="submitForm" class="btn btn-primary">Edit</button>
            <a href="{{ route('dashboard.transaksi') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
    <!-- End Page Content -->

    <!-- /.container-fluid -->

    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>

    <script>
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: 'http://127.0.0.1:8001/api/token/',
            headers: {
                'accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRFToken': '5KBmbMfCpOK4lycIYb2zsswWtQE8WNTiZBOOJ8I5QI1lQS7buSkJTP3i9s31ooVM'
            },
            data: JSON.stringify({
                "email": "fery@gmail.com",
                "password": "1234"
            }),
            success: function(tokenResponse) {
                var token = tokenResponse.token;
                if (token) {
                    var urlPath = window.location.pathname;
                    var segments = urlPath.split('/');
                    var transactionId = segments[segments.length - 2];

                    var transactionHeaders = {
                        'accept': 'application/json',
                        'Authorization': '' + token,
                        'Content-Type': 'application/json',
                        'X-CSRFToken': 'kuniCMoBBljuYsz9QgQrHJc65GS812UQIgXz3O5fTvmkN3AX5Co8quRRqqcWMOVe'
                    };

                    $.ajax({
                        type: 'GET',
                        url: `http://127.0.0.1:8001/transaksi/${transactionId}/`, 
                        headers: transactionHeaders,
                        success: function(response) {
                            console.log('Get Detail Transaction successfully:', response);
                            var namaBarang = response.nama_barang;
                            var jenisTransaksi = response.jenis_transaksi;
                            var jumlah = response.jumlah;

                            $('#barang').append(`<option value="${response.barang}" selected>${namaBarang}</option>`);
                            $('#jenis_transaksi').append(`<option value="${jenisTransaksi}" selected>${jenisTransaksi}</option>`);
                            $('#jumlah').val(jumlah);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error retrieving transaction:', error);
                        }
                    });
                } else {
                    console.error('Error: Token not found in response.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error generating token:', error);
            }
        });
    });
</script>


    <script>
       $(document).ready(function() {
        function fetchTokenAndPatchTransaction() {
        $.ajax({
            type: 'POST',
            url: 'http://127.0.0.1:8001/api/token/',
            headers: {
                'accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRFToken': '5KBmbMfCpOK4lycIYb2zsswWtQE8WNTiZBOOJ8I5QI1lQS7buSkJTP3i9s31ooVM'
            },
            data: JSON.stringify({
                "email": "fery@gmail.com",
                "password": "1234"
            }),
            success: function(tokenResponse) {
                var token = tokenResponse.token;
                if (token) {
                    var urlPath = window.location.pathname;
                    var segments = urlPath.split('/');
                    var transactionId = segments[segments.length - 2];

                    var barang = $('#barang').val();
                    var jenis_transaksi = $('#jenis_transaksi').val();
                    var jumlah = $('#jumlah').val();

                    var payload = {
                        "barang": barang,
                        "jenis_transaksi": jenis_transaksi,
                        "jumlah": jumlah
                    };


                    var transactionHeaders = {
                        'accept': 'application/json',
                        'Authorization': '' + token,
                        'Content-Type': 'application/json',
                        'X-CSRFToken': 'kuniCMoBBljuYsz9QgQrHJc65GS812UQIgXz3O5fTvmkN3AX5Co8quRRqqcWMOVe'
                    };

                    $.ajax({
                        type: 'PUT',
                        url: `http://127.0.0.1:8001/transaksi/${transactionId}/`,
                        headers: transactionHeaders,
                        data: JSON.stringify(payload),
                        success: function(response) {
                            console.log('Transaction updated successfully:', response);
                            window.location.href = '/transaksi'; 
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating transaction:', error);
                        }
                    });
                } else {
                    console.error('Error: Token not found in response.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error generating token:', error);
            }
        });
    }

    $('#submitForm').click(function() {
        fetchTokenAndPatchTransaction();
    });
});

    </script>

</body>

</html>
