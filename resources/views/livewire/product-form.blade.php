<div x-data="{
    moveNext() {
        const focusable = [...$el.querySelectorAll('[data-enter]')].filter(el => !el.disabled && !el.readOnly);
        const i = focusable.indexOf(document.activeElement);
        if (i > -1 && i < focusable.length - 1) {
            focusable[i + 1].focus();
        } else {
            // terakhir -> Simpan
            $refs.btnSimpan.click();
        }
    }
}" x-init="$nextTick(() => { $refs.nama_obat.focus() })" @focus-nama.window="$nextTick(() => { $refs.nama_obat.focus() })"
    @keydown.enter.prevent="moveNext()" class="p-6 bg-gray-50 min-h-screen space-y-6">
    <h1 class="text-2xl font-bold">Master Produk</h1>

    {{-- Pesan Notifikasi --}}
    <div>
        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-2">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded-lg mb-2">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded-lg mb-2">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- ==== FORM ==== --}}
    <form wire:submit.prevent="save" class="space-y-6">

        {{-- Data Obat --}}
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-3">Data Obat</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Kode Obat</label>
                    <input type="text" wire:model="kode_obat" readonly data-enter
                        class="w-full p-2 border rounded bg-gray-100 text-gray-600">
                    @error('kode_obat')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Nama Obat</label>
                    <input type="text" wire:model="nama_obat" x-ref="nama_obat" data-enter
                        class="w-full p-2 border rounded">
                    @error('nama_obat')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Pabrik</label>
                    <input type="text" wire:model="pabrik" data-enter class="w-full p-2 border rounded">
                </div>

                <div>
                    <label class="block text-sm font-medium">Golongan</label>
                    <input type="text" wire:model="golongan" data-enter class="w-full p-2 border rounded">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium">Komposisi</label>
                    <textarea wire:model="komposisi" data-enter class="w-full p-2 border rounded"></textarea>
                </div>

                <div class="flex items-center gap-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="generik" class="rounded" data-enter class="h-4 w-4">
                        <span>Generik</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Informasi Kemasan --}}
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-3">Informasi Kemasan</h2>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium">Kemasan</label>
                    <input type="text" wire:model="kemasan" data-enter class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Satuan</label>
                    <input type="text" wire:model="satuan" data-enter class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Isi Obat</label>
                    <input type="text" wire:model="isi_obat" data-enter class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Dosis</label>
                    <input type="text" wire:model="dosis" data-enter class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Sediaan</label>
                    <input type="text" wire:model="sediaan" data-enter class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Barcode</label>
                    <input type="text" wire:model="barcode" data-enter class="w-full p-2 border rounded">
                </div>
            </div>
        </div>

        {{-- Harga --}}
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-3">Harga</h2>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium">Harga HNA</label>
                    <input type="number" step="0.01" wire:model="harga_hna" data-enter
                        class="w-full p-2 border rounded text-right">
                </div>
                <div>
                    <label class="block text-sm font-medium">Harga PPN</label>
                    <input type="number" step="0.01" wire:model="harga_ppn" data-enter
                        class="w-full p-2 border rounded text-right">
                </div>
                <div>
                    <label class="block text-sm font-medium">Harga Jual Akhir (HJA)</label>
                    <input type="number" step="0.01" wire:model="hja" data-enter
                        class="w-full p-2 border rounded text-right">
                    @error('hja')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Pengaturan & Stok --}}
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-3">Pengaturan & Stok</h2>
            <div class="grid grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium">Kreditur</label>
                    <input type="text" wire:model="kreditur" data-enter class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Min Stok</label>
                    <input type="number" wire:model="min_stok" data-enter class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" wire:model="stok" data-enter value="0"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                <label class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="prekursor" data-enter class="rounded">
                    <span>Prekursor</span>
                </label>

                <label class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="psikotropika" data-enter class="rounded">
                    <span>Psikotropika</span>
                </label>

                <label class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="resep" data-enter class="rounded">
                    <span>Resep</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="active" data-enter class="h-4 w-4">
                    <span class="text-sm">Aktif</span>
                </label>
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end">
            <button type="submit" x-ref="btnSimpan"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>

        {{-- Pesan sukses --}}
        @if (session()->has('message'))
            <div class="p-2 bg-green-200 text-green-800 rounded">
                {{ session('message') }}
            </div>
        @endif
    </form>

    {{-- ==== TABEL PRODUK ==== --}}
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-3">Daftar Produk</h2>
        <table class="w-full border-collapse border text-sm">
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
                @forelse ($products as $item)
                    <tr>
                        <td class="border px-3 py-1">{{ $item->kode_obat }}</td>
                        <td class="border px-3 py-1">{{ $item->nama_obat }}</td>
                        <td class="border px-3 py-1">{{ $item->golongan }}</td>
                        <td class="border px-3 py-1 text-right">{{ number_format($item->hja, 0, ',', '.') }}</td>
                        <td class="border px-3 py-1">{{ $item->min_stok }}</td>
                        <td class="border px-3 py-1">
                            @if ($item->active)
                                <span class="text-green-600 font-medium">Aktif</span>
                            @else
                                <span class="text-red-600 font-medium">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
