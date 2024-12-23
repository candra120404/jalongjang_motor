<x-layout :data="['user' => auth()->user()]" :title="['title' => 'OVERVIEW']">
    {{-- bagian alert --}}
    @if (session('success'))
        <div id="alert-3"
            class="flex items-center p-4 mb-2 mx-5 mt-2 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-lg font-medium">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    <div class="container mx-auto p-4">
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Total pelanggan cuci motor jalongjang
                </h2>
                <div class="text-4xl font-bold text-blue-600">
                    {{ $totalPelanggan }}
                </div>
            </div>
            <canvas id="rekapChart" width="400" height="100"></canvas>
        </div>
    </div>

    <script>
        // Ambil data dari controller
        const rekapData = @json($rekapData);

        // Buat array label untuk semua bulan dalam setahun
        const months = [
            "Januari", "Februari", "Maret", "April",
            "Mei", "Juni", "Juli", "Agustus",
            "September", "Oktober", "November", "Desember"
        ];
        // Map data untuk mendapatkan total kendaraan per bulan yang ada
        const dataPerMonth = months.map((month, index) => {
            const yearData = rekapData.find(item => item.month - 1 === index);
            return yearData ? yearData.total_kendaraan : 0;
        });

        // Siapkan labels (bulan-bulan dalam setahun)
        const labels = months;

        // Siapkan data untuk chart
        const ctx = document.getElementById('rekapChart').getContext('2d');
        const rekapChart = new Chart(ctx, {
            type: 'line', // Jenis chart (bar chart)
            data: {
                labels: labels, // Nama bulan
                datasets: [{
                    label: 'Total Kendaraan',
                    data: dataPerMonth,
                    borderColor: 'red',
                    backgroundColor: 'red',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Kendaraan'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-layout>
