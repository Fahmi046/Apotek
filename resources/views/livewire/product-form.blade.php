<div class="p-6 bg-gray-50 min-h-screen">
    <h1 class="text-2xl font-bold mb-6">Master Produk</h1>

    {{-- Form Input Produk --}}
    <form wire:submit.prevent="save" class="space-y-6">

        {{-- Data Obat --}}
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-3">Data Obat</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Kode Obat</label>
                    <input type="text" wire:model="kode_obat" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Nama Obat</label>
                    <input type="text" wire:model="nama_obat" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Pabrik</label>
                    <input type="text" wire:model="pabrik" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Golongan</label>
                    <input type="text" wire:model="golongan" class="w-full p-2 border rounded">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium">Komposisi</label>
                    <textarea wire:model="komposisi" class="w-full p-2 border rounded"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Generik</label>
                    <input type="checkbox" wire:model="generik" class="ml-2">
                </div>
            </div>
        </div>

        {{-- Kemasan --}}
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-3">Kemasan</h2>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium">Kemasan</label>
                    <input type="text" wire:model="kemasan" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Satuan</label>
                    <input type="text" wire:model="satuan" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Isi Obat</label>
                    <input type="text" wire:model="isi_obat" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Dosis</label>
                    <input type="text" wire:model="dosis" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Sediaan</label>
                    <input type="text" wire:model="sediaan" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Barcode</label>
                    <input type="text" wire:model="barcode" class="w-full p-2 border rounded">
                </div>
            </div>
        </div>

        {{-- Harga --}}
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-3">Harga</h2>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium">HNA</label>
                    <input type="number" step="0.01" wire:model="harga_hna" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">PPN</label>
                    <input type="number" step="0.01" wire:model="harga_ppn" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">HJA</label>
                    <input type="number" step="0.01" wire:model="hja" class="w-full p-2 border rounded">
                </div>
            </div>
        </div>

        {{-- Lainnya --}}
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-3">Lainnya</h2>
            <div class="grid grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium">Kreditur</label>
                    <input type="text" wire:model="kreditur" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Min Stok</label>
                    <input type="number" wire:model="min_stok" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Prekursor</label>
                    <input type="checkbox" wire:model="prekursor" class="ml-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Psikotropika</label>
                    <input type="checkbox" wire:model="psikotropika" class="ml-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Resep</label>
                    <input type="checkbox" wire:model="resep" class="ml-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Aktif</label>
                    <input type="checkbox" wire:model="active" class="ml-2">
                </div>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>

    {{-- Tabel Produk --}}
    <div class="mt-10 bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-3">Daftar Produk</h2>
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border px-3 py-2">Kode</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">Golongan</th>
                    <th class="border px-3 py-2">HJA</th>
                    <th class="border px-3 py-2">Stok Min</th>
                    <th class="border px-3 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <td class="border px-3 py-1">{{ $item->kode_obat }}</td>
                        <td class="border px-3 py-1">{{ $item->nama_obat }}</td>
                        <td class="border px-3 py-1">{{ $item->golongan }}</td>
                        <td class="border px-3 py-1">{{ number_format($item->hja, 0, ',', '.') }}</td>
                        <td class="border px-3 py-1">{{ $item->min_stok }}</td>
                        <td class="border px-3 py-1">
                            @if ($item->active)
                                <span class="text-green-600 font-medium">Aktif</span>
                            @else
                                <span class="text-red-600 font-medium">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
