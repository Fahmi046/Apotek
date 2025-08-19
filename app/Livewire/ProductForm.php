<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductForm extends Component
{
    public $kode_obat = 0;
    public $nama_obat;
    public $pabrik;
    public $golongan;
    public $satuan;
    public $hja;
    public $active = true;
    public $stok = 0; // ✅ default stok = 0

    public $generik = false;
    public $prekursor = false;
    public $psikotropika = false;
    public $resep = false;


    public $products = [];

    protected $rules = [
        'kode_obat'    => 'required|integer',
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
    }

    public function save()
    {
        try {
            $this->validate();

            Product::create([
                'kode_obat'    => $this->kode_obat,
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
        } catch (\Throwable $e) {
            session()->flash('error', '❌ Gagal menyimpan produk: ' . $e->getMessage());
        }
    }

    private function resetForm()
    {
        $this->kode_obat = 0;
        $this->nama_obat = '';
        $this->pabrik = '';
        $this->golongan = '';
        $this->satuan = '';
        $this->generik = false;
        $this->prekursor = false;
        $this->psikotropika = false;
        $this->resep = false;
        $this->hja = '';
        $this->active = true;
        $this->stok = 0; // ✅ reset stok ke 0 lagi
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}
