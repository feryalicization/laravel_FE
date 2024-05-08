<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laporan Presensi</title>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

</head>

<body id="page-top">
    @include('sidebar-2')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800"> Laporan PT Qtasnim Digital Teknologi </h1>

        <div style="text-align: right;">
            <button type="button" class="btn btn-primary btn-sm" id="downloadBtn">Download</button>
            <button type="button" class="btn btn-danger btn-sm" id="printBtn">Print</button>
        </div>

        <br>

        <!-- Your DataTable -->
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($presensi as $key => $presensiItem)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $presensiItem->pegawai->nip }}</td>
                        <td>{{ $presensiItem->pegawai->nama_pegawai }}</td>
                        <td>{{ $presensiItem->pegawai->divisi }}</td>
                        <td>{{ $presensiItem->tgl }}</td>
                        <td>{{ $presensiItem->jam_masuk }}</td>
                        <td>{{ $presensiItem->jam_keluar }}</td>
                    </tr>
                    @endforeach
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
        document.getElementById("downloadBtn").addEventListener("click", function() {
            var table = document.getElementById("example");

            var ws = XLSX.utils.table_to_sheet(table);

            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

            XLSX.writeFile(wb, "presensi.xlsx");
        });
    </script>

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "scrollX": true,
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": true
        });

        // Print button functionality
        document.getElementById("printBtn").addEventListener("click", function() {
            var tableBodyRows = document.querySelectorAll("#example tbody tr");
            var tableBody = '<tbody>';
            tableBodyRows.forEach(function(row) {
                tableBody += row.outerHTML;
            });
            tableBody += '</tbody>';

            var printContents = '<table>' +
                                '<thead>' +
                                '<tr>' +
                                '<th>No</th>' +
                                '<th>NIP</th>' +
                                '<th>Nama</th>' +
                                '<th>Divisi</th>' +
                                '<th>Tanggal</th>' +
                                '<th>Jam Masuk</th>' +
                                '<th>Jam Keluar</th>' +
                                '</tr>' +
                                '</thead>' +
                                tableBody +
                                '</table>';

            var originalContents = document.body.innerHTML;
            var popupWin = window.open('', 'width=600');

            popupWin.document.open();
            popupWin.document.write(`
                <html>
                    <head>
                        <title>Print</title>
                        <style>
                            @media print {
                                @page {
                                    size: auto;
                                    margin: 0;
                                }
                                body {
                                    margin: 0;
                                }
                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }
                                th, td {
                                    border: 1px solid #ddd;
                                    padding: 8px;
                                }
                                th {
                                    background-color: #f2f2f2;
                                }
                            }
                        </style>
                    </head>
                    <body onload="window.print();">${printContents}</body>
                </html>`
            );
            popupWin.document.close();
        });
    });
</script>



</body>

</html>
