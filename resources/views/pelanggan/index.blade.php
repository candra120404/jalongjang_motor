<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form cuci Jalongjang motor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
        <h1 class="text-center text-2xl font-bold text-gray-700 mb-6">Form cuci motor</h1>
        <p class="text-center mb-2">Selamat datang di <strong>Jalongjang Motor!</strong> Isi formulir di bawah ini untuk
            mendaftarkan
            kendaraan
            Anda untuk layanan
            cuci motor kami yang cepat dan terpercaya.</p>
        <form class="grid grid-cols-1 sm:grid-cols-2 gap-6" action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            @method('POST')
            <!-- Nama -->
            <div class="col-span-1">
                <label for="nama" class="block text-sm font-medium text-gray-900">Nama</label>
                <input type="text" id="nama" name="nama" required
                    class="mt-1 block w-full rounded-sm p-2 border border-gray-500 shadow-sm outline-indigo-500 focus:border-red-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Alamat -->
            <div class="col-span-1">
                <label for="alamat" class="block text-sm font-medium text-gray-900">Alamat</label>
                <input type="text" id="alamat" name="alamat" required
                    class="mt-1 block w-full rounded-md p-2 border border-gray-500 outline-indigo-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- No Telepon -->
            <div class="col-span-1">
                <label for="no_telepon" class="block text-sm font-medium text-gray-900">No Telepon</label>
                <input type="text" id="no_telepon" name="no_telepon" required
                    class="mt-1 block w-full rounded-md p-2 border border-gray-500 outline-indigo-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Jenis Kendaraan -->
            <div class="col-span-1">
                <label for="jenis_kendaraan" class="block text-sm font-medium text-gray-900">Jenis Kendaraan</label>
                <input type="text" name="kendaraan[0][jenis_kendaraan]" required
                    class="mt-1 block w-full rounded-md p-2 border border-gray-500 outline-indigo-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Merk -->
            <div class="col-span-1">
                <label for="merk" class="block text-sm font-medium text-gray-900">Merk</label>
                <input type="text" name="kendaraan[0][merk]" required
                    class="mt-1 block w-full rounded-md p-2 border border-gray-500 outline-indigo-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Tahun -->
            <div class="col-span-1">
                <label for="tahun" class="block text-sm font-medium text-gray-900">Tahun</label>
                <input type="number" name="kendaraan[0][tahun]" required
                    class="mt-1 block w-full rounded-md p-2 border border-gray-500 outline-indigo-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Nomor Polisi -->
            <div class="col-span-1">
                <label for="nomor_polisi" class="block text-sm font-medium text-gray-900">Nomor Polisi</label>
                <input type="text" name="kendaraan[0][nomor_polisi]" required
                    class="mt-1 block w-full rounded-md p-2 border border-gray-500 outline-indigo-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Submit Button -->
            <div class="col-span-1 sm:col-span-2">
                <div>
                    <button type="submit"
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Kirim</button>
                </div>
            </div>
        </form>
        @if (session('success'))
            <div id="alert-3" x-data="{ show: true }" x-show="show" @click.away="show = false"
                class="flex items-center p-4 mb-2 mx-5 mt-2 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
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
        @if (session('error'))
            <div id="alert-4" x-data="{ show: true }" x-show="show" @click.away="show = false"
                class="flex items-center p-4 mx-5 mt-2 mb-2 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Warning</span>
                <div class="ml-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button" @click="show = false"
                    class="ml-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-300 dark:hover:bg-gray-700"
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

        <form action="{{ route('pelanggan.cekAntrianTerkini') }}" method="GET" class="mt-4">
            @csrf
            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cek
                Antrian Terkini</button>
        </form>
    </div>
</body>

</html>
