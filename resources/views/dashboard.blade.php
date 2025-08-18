{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    {{-- Tailwind via CDN (cepat untuk mulai). Jika sudah pakai Vite, hapus baris ini dan gunakan @vite --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Flowbite (komponen siap pakai) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" />

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lucide-static@0.468.0/font/lucide.css" />

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    {{-- Jika menggunakan Vite: --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <style>
        /* Haluskan scrolling & sedikit touch pada card */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="i-lucide-activity text-indigo-600 text-2xl"></span>
                    <h1 class="text-xl font-semibold">Dashboard</h1>
                </div>
                <div class="flex items-center gap-2">
                    <button data-modal-target="filterModal" data-modal-toggle="filterModal"
                        class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 text-sm shadow">
                        <span class="i-lucide-sliders"></span>
                        Filter
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- KPI Cards -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <article class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Penjualan Hari Ini</p>
                        <h3 class="text-2xl font-bold" id="kpiTodaySales">Rp 0</h3>
                        <p class="text-xs text-emerald-600 mt-1" id="kpiTodayDelta">+0% dari kemarin</p>
                    </div>
                    <span class="i-lucide-shopping-bag text-3xl text-indigo-600"></span>
                </div>
            </article>
            <article class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Transaksi</p>
                        <h3 class="text-2xl font-bold" id="kpiOrders">0</h3>
                        <p class="text-xs text-gray-500 mt-1">bulan ini</p>
                    </div>
                    <span class="i-lucide-receipt text-3xl text-indigo-600"></span>
                </div>
            </article>
            <article class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Rata2 Nilai Order</p>
                        <h3 class="text-2xl font-bold" id="kpiAOV">Rp 0</h3>
                        <p class="text-xs text-gray-500 mt-1">bulan ini</p>
                    </div>
                    <span class="i-lucide-gauge text-3xl text-indigo-600"></span>
                </div>
            </article>
            <article class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Stok Hampir Habis</p>
                        <h3 class="text-2xl font-bold" id="kpiLowStock">0</h3>
                        <p class="text-xs text-gray-500 mt-1">barang</p>
                    </div>
                    <span class="i-lucide-warehouse text-3xl text-indigo-600"></span>
                </div>
            </article>
        </section>

        <!-- Tabel Transaksi Terbaru -->
        <section class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-3">
                <h4 class="font-semibold">Transaksi Terbaru</h4>
                <a href="#" class="text-sm text-indigo-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                        <tr>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Invoice</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="recentTableBody">
                        <!-- Isi via JS (dummy) atau render server-side -->
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Modal Filter -->
    <div id="filterModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-2xl shadow">
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold">Filter Dashboard</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-600" data-modal-hide="filterModal">
                        <span class="i-lucide-x text-xl"></span>
                    </button>
                </div>
                <div class="p-4 space-y-4">
                    <div>
                        <label class="block text-sm mb-1">Rentang Tanggal</label>
                        <select id="dateRange" class="w-full rounded-xl border-gray-300">
                            <option value="30">30 Hari Terakhir</option>
                            <option value="90">90 Hari Terakhir</option>
                            <option value="365">1 Tahun Terakhir</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm mb-1">Cabang</label>
                        <select id="branch" class="w-full rounded-xl border-gray-300">
                            <option value="all">Semua Cabang</option>
                            <option value="samarinda">Samarinda</option>
                            <option value="balikpapan">Balikpapan</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-2 p-4 border-t">
                    <button class="px-4 py-2 rounded-xl border" data-modal-hide="filterModal">Batal</button>
                    <button id="applyFilterBtn" class="px-4 py-2 rounded-xl bg-indigo-600 text-white"
                        data-modal-hide="filterModal">Terapkan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Flowbite script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <script>
        // ===== Dummy Data (ganti dengan data server-side) =====
        const rupiah = (n) => new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(n);

        function generateDummySales(days = 30) {
            const labels = Array.from({
                length: days
            }, (_, i) => `${i + 1}`);
            const values = labels.map(() => Math.floor(Math.random() * 7_000_000) + 500_000);
            return {
                labels,
                values
            };
        }

        function dummyCategories() {
            return {
                labels: ['Bearing', 'Oil Seal', 'V-Belt', 'Hydraulic Seal', 'Chain'],
                values: [35, 28, 22, 14, 9]
            };
        }

        const recent = Array.from({
            length: 8
        }, (_, i) => ({
            date: new Date(Date.now() - i * 86400000).toISOString().slice(0, 10),
            invoice: `INV-${String(10234 + i)}`,
            customer: ['Umum', 'PT Andalan', 'CV Maju', 'Bpk Dedi'][i % 4],
            total: Math.floor(Math.random() * 9_000_000) + 500_000,
            status: ['Sukses', 'Sukses', 'Pending', 'Batal'][i % 4]
        }));

        // ===== Render KPI =====
        function renderKPI(data) {
            const sum = data.values.reduce((a, b) => a + b, 0);
            const today = data.values[data.values.length - 1];
            const yesterday = data.values[data.values.length - 2] || today;
            const delta = (((today - yesterday) / (yesterday || 1)) * 100).toFixed(1);

            document.getElementById('kpiTodaySales').textContent = rupiah(today);
            document.getElementById('kpiTodayDelta').textContent = `${delta > 0 ? '+' : ''}${delta}% dari kemarin`;
            document.getElementById('kpiOrders').textContent = (Math.round(sum / 1_000_000)).toLocaleString('id-ID');
            document.getElementById('kpiAOV').textContent = rupiah(Math.round(sum / (data.values.length || 1)));
            document.getElementById('kpiLowStock').textContent = 12; // contoh
        }

        // ===== Render Table =====
        function renderTable(items) {
            const tbody = document.getElementById('recentTableBody');
            tbody.innerHTML = '';
            items.forEach(item => {
                const tr = document.createElement('tr');
                tr.className = 'border-b hover:bg-gray-50';
                tr.innerHTML = `
                    <td class="px-4 py-3">${item.date}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">${item.invoice}</td>
                    <td class="px-4 py-3">${item.customer}</td>
                    <td class="px-4 py-3">${rupiah(item.total)}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs ${
                            item.status === 'Sukses' ? 'bg-emerald-100 text-emerald-700' :
                            item.status === 'Pending' ? 'bg-amber-100 text-amber-700' :
                            'bg-rose-100 text-rose-700'
                        }">${item.status}</span>
                    </td>
                    <td class="px-4 py-3">
                        <button class="text-indigo-600 hover:underline">Detail</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // ===== Charts =====
        let salesChart, catChart;

        function renderCharts(days = 30) {
            const sales = generateDummySales(days);
            const cats = dummyCategories();

            document.getElementById('salesRangeLabel').textContent = `1–${days} (Dummy)`;

            // KPI & Table dari data sales
            renderKPI(sales);
            renderTable(recent);

            // Destroy dulu jika sudah ada
            if (salesChart) salesChart.destroy();
            if (catChart) catChart.destroy();

            const ctx1 = document.getElementById('salesLineChart');
            salesChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: sales.labels,
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: sales.values,
                        fill: true,
                        tension: 0.35
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                callback: (v) => v.toLocaleString('id-ID')
                            }
                        }
                    }
                }
            });

            const ctx2 = document.getElementById('categoryBarChart');
            catChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: cats.labels,
                    datasets: [{
                        label: 'Qty',
                        data: cats.values
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        // Apply filter
        document.getElementById('applyFilterBtn').addEventListener('click', () => {
            const days = parseInt(document.getElementById('dateRange').value || '30', 10);
            renderCharts(days);
        });

        // Inisialisasi awal
        renderCharts(30);
    </script>
</body>

</html>
