<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="mb-4">Rekap Mingguan Antrian Cuci</h1>
        <a href="{{route('rekap.generate')}}" class="btn btn-success">Cek rekap</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                    <th>Total Kendaraan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paginatedRekap as $rekap)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rekap->tanggal_awal }}</td>
                        <td>{{ $rekap->tanggal_akhir }}</td>
                        <td>{{ $rekap->total_kendaraan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        {{ $paginatedRekap->links() }}
    
        <!-- Tombol untuk download PDF -->
        <a href="{{ route('rekap.downloadPdf') }}" class="btn btn-success">Download PDF</a>

</x-layout>