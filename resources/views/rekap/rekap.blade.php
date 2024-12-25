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

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>Rekap Antrian Cuci</h1>
    <h2>Periode: {{ $tglAwal }} - {{ $tglAkhir }}</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Total Kendaraan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->total_kendaraan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Total Kendaraan: {{ $totalKendaraan }}</h3>
</body>

</html>
