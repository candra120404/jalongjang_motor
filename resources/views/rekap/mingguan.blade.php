<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="mb-4">Rekap Mingguan Antrian Cuci</h1>
        <canvas id="rekapChart" width="400" height="100"></canvas>
        <div class="flex flex-col items-center justify-center">
            <div class="w-full bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Pilih Rentang Tanggal</h2>

                <div class="mb-4">
                    <label for="start-date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Awal</label>
                    <input type="date" id="start-date"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700" />
                </div>

                <div class="mb-4">
                    <label for="end-date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                    <input type="date" id="end-date"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700" />
                </div>

                <a href=""
                    onclick="this.href='/rekap/' + document.getElementById('start-date').value + '/' + document.getElementById('end-date').value"
                    class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Cetak Laporan
                </a>
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
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
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
