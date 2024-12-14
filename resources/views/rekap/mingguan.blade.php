<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-semibold">Rekap Mingguan</h1>

        <table>
            <thead>
                <tr>
                    <th>Kendaraan</th>
                    <th>Status</th>
                    <th>Tanggal Antrian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekapAntrian as $rekap)
                    <tr>
                        <td>{{ $rekap->kendaraan->pelanggan->nama }}</td>
                        <td>{{ $rekap->status }}</td>
                        <td>{{ $rekap->tanggal_antrian }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout>