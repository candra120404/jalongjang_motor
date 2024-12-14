<x-layout>
    <div class="container mx-auto p-4">
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Pelanggan</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Kendaraan</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nomor Polisi</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal Antrian</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Waktu Antrian</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($antrian as $a)
                        <tr class="border-b">
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $a->kendaraan->pelanggan->nama }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $a->kendaraan->jenis_kendaraan }} - {{ $a->kendaraan->merk }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $a->kendaraan->nomor_polisi }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $a->tanggal_antrian }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $a->waktu_antrian }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $a->status == 'menunggu' ? 'bg-yellow-300 text-yellow-800' : 'bg-green-300 text-green-800' }}">
                                    {{ ucfirst($a->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-600">
                                <form action="{{ route('antrian.update', $a->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="bg-blue-500 text-white px-3 py-1 rounded-md shadow hover:bg-blue-600">
                                        <option value="menunggu" {{ $a->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>