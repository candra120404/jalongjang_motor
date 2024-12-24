<x-layout :data="['user' => auth()->user()]" :title="['title' => 'ANTRIAN']">
    <!-- Form pencarian -->
    <form action="{{ route('antrian.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama pelanggan"
            class="bg-gray-100 text-gray-700 border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-1/2 md:w-1/3">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-2 sm:mt-0 sm:ml-2">
            Cari
        </button>
    </form>
    @if (session('success'))
        <div id="alert-3" x-data="{ show: true }" x-show="show" @click.away="show = false"
            class="flex items-center p-4 mb-2 mx-5 mt-2 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button" @click="show = false"
                class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
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
</x-layout>
