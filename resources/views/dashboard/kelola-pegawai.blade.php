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

        <h1 class="h3 mb-2 text-gray-800">Transaksi Barang</h1>

        <div style="text-align: right;">
            <a href="{{ route('dashboard.create-pegawai') }}">
                <button type="button" class="btn btn-primary btn-sm">Create</button>
            </a>
        </div>


        <br>

        <!-- Your DataTable -->
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Tanggal Transaksi</th>
                        <th style="text-align: center;">Barang</th>
                        <th style="text-align: center;">Jenis Transaksi</th>
                        <th style="text-align: center;">Jumlah</th>
                        <th style="text-align: center;">Action</th>
                        <!-- Add other columns based on your Pegawai model attributes -->
                    </tr>
                </thead>
                <tbody>
                @if (!empty($response))
                    @foreach ($response as $key => $transaction)
                        <tr>
                            <td style="text-align: center;">{{ $key + 1 }}</td>
                            <td style="text-align: center;">{{ $transaction['tanggal_transaksi'] }}</td>
                            <td style="text-align: center;">{{ $transaction['nama_barang'] }}</td>
                            <td style="text-align: center;">{{ $transaction['jenis_transaksi'] }}</td>
                            <td style="text-align: center;">{{ $transaction['jumlah'] }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('dashboard.edit-pegawai', $transaction['id']) }}">
                                    <button class="btn btn-warning btn-sm" type="button">EDIT</button>
                                </a>
                                <button class="btn btn-danger btn-sm" type="button" onclick="confirmDelete({{ $transaction['id'] }})" data-bs-toggle="modal" data-bs-target="#exampleModal">HAPUS</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">No transaction data available</td>
                    </tr>
                @endif
            </tbody>
            </table>
        </div>
        <!-- End DataTable -->



        <!-- Modal Delete-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-center align-items-center w-100">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-circle fa-3x text-danger"></i>
                    </h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                Apakah anda yakin ingin menghapus data?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="{{ route('pegawai.destroy', ':id') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

    <script>
    $(document).ready(function () {
        $('#example').DataTable({
            "scrollX": true,
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": true
        });
    });

    function confirmDelete(pegawaiId) {
        var deleteForm = document.getElementById('deleteForm');
        deleteForm.action = deleteForm.action.replace(':id', pegawaiId);
        $('#deleteConfirmationModal').modal('show');
    }
</script>



</body>

</html>
