<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductForm extends Component
{
    public $kode_obat, $nama_obat, $pabrik, $golongan, $komposisi, $generik = false;
    public $kemasan, $satuan, $isi_obat, $dosis, $sediaan, $barcode;
    public $harga_hna, $harga_ppn, $hja;
    public $kreditur, $min_stok, $stok = 0;
    public $prekursor = false, $psikotropika = false, $resep = false, $active = true;

    public $products = [];

    protected $rules = [
        'nama_obat'    => 'required|string|max:255',
        'pabrik'       => 'nullable|string|max:255',
        'golongan'     => 'nullable|string|max:255',
        'satuan'       => 'nullable|string|max:50',
        'generik'      => 'boolean',
        'prekursor'    => 'boolean',
        'psikotropika' => 'boolean',
        'resep'        => 'boolean',
        'hja'          => 'required|numeric',
        'active'       => 'boolean',
        'stok'         => 'nullable|integer|min:0', // ✅ tidak wajib, minimal 0
    ];

    public function mount()
    {
        $this->products = Product::all();
        $this->kode_obat = $this->generateKode();
    }
    private function generateKode()
    {
        // Ambil kode terakhir dari database
        $lastProduct = Product::orderBy('id', 'desc')->first();

        if (!$lastProduct) {
            return "OBT-00001";
        }

        // Ambil angka terakhir dari kode
        $lastKode = $lastProduct->kode_obat;
        $lastNumber = intval(substr($lastKode, 4)); // ambil angka setelah OBT-

        $newNumber = $lastNumber + 1;
        return "OBT-" . str_pad($newNumber, 5, "0", STR_PAD_LEFT);
    }


    public function save()
    {
        try {
            $this->validate();
            Product::create([
                'kode_obat'  => $this->generateKode(), // AUTO
                'nama_obat'    => $this->nama_obat,
                'pabrik'       => $this->pabrik,
                'golongan'     => $this->golongan,
                'satuan'       => $this->satuan,
                'generik'      => $this->generik,
                'prekursor'    => $this->prekursor,
                'psikotropika' => $this->psikotropika,
                'resep'        => $this->resep,
                'hja'          => $this->hja,
                'active'       => $this->active,
                'stok'         => $this->stok ?? 0, // ✅ kalau kosong tetap 0
            ]);

            session()->flash('success', '✅ Produk berhasil disimpan.');

            $this->resetForm();
            $this->products = Product::all();
            $this->kode_obat = $this->generateKode();
        } catch (\Throwable $e) {
            session()->flash('error', '❌ Gagal menyimpan produk: ' . $e->getMessage());
        }
    }

    private function resetForm()
    {
        $this->kode_obat   = $this->generateKode();
        $this->nama_obat = '';
        $this->pabrik = '';
        $this->golongan = '';
        $this->komposisi = '';
        $this->kemasan = '';
        $this->satuan = '';
        $this->isi_obat = '';
        $this->dosis = '';
        $this->sediaan = '';
        $this->barcode = '';
        $this->harga_hna = 0;
        $this->harga_ppn = 0;
        $this->prekursor = false;
        $this->psikotropika = false;
        $this->satuan = '';
        $this->generik = false;
        $this->prekursor = false;
        $this->psikotropika = false;
        $this->resep = false;
        $this->hja = 0;
        $this->active = true;
        $this->kreditur = '';
        $this->min_stok = 0;
        $this->stok = 0; // ✅ reset stok ke 0 lagi
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}
