<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perbandingan</title>

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

    <!-- gijgo datepicker -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />



    <style>
        .custom-filter {
        display: flex;
        align-items: center; 
        position: relative;
        top: 38px;
        left: 193px;
    }

    .custom-filter label {
        margin-right: 10px; 
    }

    .custom-filter span {
        display: flex;
        flex-direction: row;
    }

    .custom-filter input {
        width: 140px;
        height: 33px;
    }

    @media (max-width: 767px) {

    .custom-filter {
        display: none;

        }

    }

    </style>

</head>

<body id="page-top">
    @include('sidebar-2')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800"> Data Barang </h1>

        <div style="text-align: right;">
            <a href="{{ route('dashboard.create-barang') }}">
                <button type="button" class="btn btn-primary btn-sm">Create</button>
            </a>
        </div>


        <br>

        <!-- Your DataTable -->
        <div class="table-responsive">

            <div class="custom-filter">
                <label for="datepicker_start">Range Date</label>
                <span>
                    <input id="datepicker_start" width="155" placeholder="dd/mm/yyyy"/>&nbsp;&nbsp;&nbsp;
                    <input id="datepicker_end" width="155" placeholder="dd/mm/yyyy"/>
                </span>
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Jenis Barang</th>
                        <th style="text-align: center;">Jumlah Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                @if (!empty($response))
                    @foreach($response as $key => $barang)
                    <tr>
                        <td style="text-align: center;">{{ $key + 1 }}</td>
                        <td style="text-align: center;">{{ $barang['jenis_barang'] }}</td>
                        <td style="text-align: center;">{{ $barang['transaksi'] }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7">No barang data available</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <!-- End DataTable -->





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



    <!-- Modal Delete-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-circle fa-3x text-danger"></i>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Apakah anda yakin ingin menghapus data?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        <button type="submit" id="submitForm" class="btn btn-danger">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
</script>


<script>
    $(document).ready(function() {
        $('#datepicker_start').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd',
            change: function(e, date) {
                updateCallTable($('#datepicker_start').val(), $('#datepicker_end').val());
            }
        });

        $('#datepicker_end').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd',
            change: function(e, date) {
                updateCallTable($('#datepicker_start').val(), $('#datepicker_end').val());
            }
        });

        function updateCallTable(dateStart, dateEnd) {
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

                        $.ajax({
                            url: 'http://127.0.0.1:8001/perbandingan',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                start_date: dateStart,
                                end_date: dateEnd
                            },
                            headers: {
                                'Authorization': ' ' + token
                            },
                            success: function(response) {
                                console.log('API call successful:', response);
                                var tableBody = $('#example tbody');
                                tableBody.empty();

                                response.data.forEach(function(item, index) {
                                    var row = $('<tr>');
                                    var numberCell = $('<td>').text(index + 1).css('text-align', 'center');
                                    var jenisBarangCell = $('<td>').text(item.jenis_barang).css('text-align', 'center');
                                    var transaksiCell = $('<td>').text(item.transaksi).css('text-align', 'center');

                                    row.append(numberCell);
                                    row.append(jenisBarangCell);
                                    row.append(transaksiCell);

                                    tableBody.append(row);
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('API call error:', error);
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

        updateCallTable(null, null);
    });
</script>


</body>

</html>
