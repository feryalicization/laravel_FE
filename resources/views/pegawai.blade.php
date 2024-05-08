<!-- resources/views/pegawai/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai List</title>
</head>
<body>
    <h1>Pegawai List</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pegawai</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($pegawai as $pegawaiItem)
                <tr>
                    <td>{{ $pegawaiItem->id }}</td>
                    <td>{{ $pegawaiItem->nama_pegawai }}</td>
                    <!-- Add more columns as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pegawai->links() }} <!-- Pagination links -->

</body>
</html>
