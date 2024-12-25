<x-layout :data="['user' => auth()->user()]" :title="['title' => 'ANTRIAN']">
    <!-- Form pencarian -->
    <form action="{{ route('antrian.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama pelanggan"
            class="bg-gray-100 text-gray-700 border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-1/2 md:w-1/3">

        <select name="month" class="bg-gray-100 text-gray-700 border border-gray-300 rounded-lg px-4 py-2 sm:ml-2">
            <option value="">Pilih Bulan</option>
            @foreach (range(1, 12) as $m)
                <option value="{{ $m }}" {{ request('month', date('n')) == $m ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                </option>
            @endforeach
        </select>

        <select name="year" class="bg-gray-100 text-gray-700 border border-gray-300 rounded-lg px-4 py-2 sm:ml-2">
            <option value="">Pilih Tahun</option>
            @foreach (range(date('Y') - 5, date('Y')) as $y)
                <!-- Menampilkan 5 tahun terakhir -->
                <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endforeach
        </select>


        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-2 sm:mt-0 sm:ml-2">
            Cari
        </button>
    </form>




    <div id="antrian_cuci" class="container mx-auto p-4">
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
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $a->kendaraan->jenis_kendaraan }} -
                                {{ $a->kendaraan->merk }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $a->kendaraan->nomor_polisi }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $a->tanggal_antrian }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $a->waktu_antrian }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $a->status == 'menunggu' ? 'bg-yellow-300 text-yellow-800' : 'bg-green-300 text-green-800' }}">
                                    {{ ucfirst($a->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-600">
                                <form action="{{ route('antrian.update', $a->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="page" value="{{ request('page') }}">
                                    <select name="status" onchange="this.form.submit()"
                                        class="bg-blue-500 text-white px-3 py-1 rounded-md shadow hover:bg-blue-600">
                                        <option value="menunggu" {{ $a->status == 'menunggu' ? 'selected' : '' }}>
                                            Menunggu</option>
                                        <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                    </select>
                                </form>
                                <button id="show-user"
                                    class="px-4 py-1 text-white bg-orange-500 rounded hover:bg-orange-700"
                                    data-url="{{ $a->id }}">
                                    detail
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination Links -->
            <div class="mt-4 p-2">
                {{ $antrian->links() }}
            </div>
        </div>
    </div>

    {{-- modal read by id --}}
    <div id="userShowModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center px-4 py-2 border-b">
                <h5 class="text-lg font-bold">Detail</h5>
                <button type="button" class="text-gray-500 hover:text-gray-800" id="closeModal">&times;</button>
            </div>
            <div class="p-4 space-y-2">
                <p class="bg-[#f8d7da] p-2 rounded-md"><strong>ID:</strong> <span id="pelanggan-id"></span></p>
                <p class="bg-[#d4edda] p-2 rounded-md"><strong>Name:</strong> <span id="pelanggan-name"></span></p>
                <p class="bg-[#cce5ff] p-2 rounded-md"><strong>Alamat:</strong> <span id="pelanggan-alamat"></span></p>
                <p class="bg-[#fff3cd] p-2 rounded-md"><strong>No Telp:</strong> <span id="pelanggan-telp"></span></p>
                <p class="bg-[#f1f1f1] p-2 rounded-md"><strong>Kendaraan:</strong> <span
                        id="pelanggan-kendaraan"></span></p>
                <p class="bg-[#e2e3e5] p-2 rounded-md"><strong>Tahun Kendaraan:</strong> <span
                        id="pelanggan-tahun"></span></p>
                <p class="bg-[#fefefe] p-2 rounded-md"><strong>No Polisi:</strong> <span
                        id="pelanggan-no-polisi"></span></p>
                <p class="bg-[#fde2e2] p-2 rounded-md"><strong>Tanggal:</strong> <span id="pelanggan-tanggal"></span>
                </p>
                <p class="bg-[#e0ffe0] p-2 rounded-md"><strong>Waktu Antrian:</strong> <span
                        id="pelanggan-waktu"></span></p>
                <p class="bg-[#d9ecff] p-2 rounded-md"><strong>Status:</strong> <span id="pelanggan-status"></span></p>
            </div>
            <div class="flex justify-end px-4 py-2 border-t">
                <button type="button" id="closeButton"
                    class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-800">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Add this JavaScript code -->
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('userShowModal');
            const showButtons = document.querySelectorAll('#show-user');
            const closeModal = document.getElementById('closeModal');
            const closeButton = document.getElementById('closeButton');

            showButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const antrianId = this.getAttribute('data-url');
                    fetchAntrianDetails(antrianId);
                });
            });

            [closeModal, closeButton].forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });

            function fetchAntrianDetails(id) {
                fetch(`/antrian/${id}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('pelanggan-id').textContent = data.id;
                        document.getElementById('pelanggan-name').textContent = data.kendaraan.pelanggan.nama;
                        document.getElementById('pelanggan-alamat').textContent = data.kendaraan.pelanggan
                            .alamat;
                        document.getElementById('pelanggan-telp').textContent = data.kendaraan.pelanggan
                            .no_telepon;
                        document.getElementById('pelanggan-kendaraan').textContent =
                            `${data.kendaraan.jenis_kendaraan} - ${data.kendaraan.merk}`;
                        document.getElementById('pelanggan-tahun').textContent =
                            `${data.kendaraan.tahun}`;
                        document.getElementById('pelanggan-no-polisi').textContent = data.kendaraan
                            .nomor_polisi;
                        document.getElementById('pelanggan-tanggal').textContent = data.tanggal_antrian;
                        document.getElementById('pelanggan-waktu').textContent = data.waktu_antrian;
                        document.getElementById('pelanggan-status').textContent = data.status;

                        modal.classList.remove('hidden');
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
</x-layout>
