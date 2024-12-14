<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap Antrian</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h1>Rekap Mingguan Antrian Cuci</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Total Kendaraan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal_awal }}</td>
                    <td>{{ $item->tanggal_akhir }}</td>
                    <td>{{ $item->total_kendaraan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
