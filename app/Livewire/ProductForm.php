<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductForm extends Component
{
    public $kode_obat, $nama_obat, $pabrik, $golongan, $komposisi, $generik = false;
    public $kemasan, $satuan, $isi_obat, $dosis, $sediaan, $barcode;
    public $harga_hna, $harga_ppn, $hja;
    public $kreditur, $min_stok, $prekursor = false, $psikotropika = false, $resep = false, $active = true;

    public function save()
    {
        $this->validate([
            'kode_obat' => 'required|unique:products,kode_obat',
            'nama_obat' => 'required',
        ]);

        Product::create([
            'kode_obat'    => $this->kode_obat,
            'nama_obat'    => $this->nama_obat,
            'pabrik'       => $this->pabrik,
            'golongan'     => $this->golongan,
            'komposisi'    => $this->komposisi,
            'generik'      => $this->generik,
            'kemasan'      => $this->kemasan,
            'satuan'       => $this->satuan,
            'isi_obat'     => $this->isi_obat,
            'dosis'        => $this->dosis,
            'sediaan'      => $this->sediaan,
            'barcode'      => $this->barcode,
            'harga_hna'    => $this->harga_hna,
            'harga_ppn'    => $this->harga_ppn,
            'hja'          => $this->hja,
            'kreditur'     => $this->kreditur,
            'min_stok'     => $this->min_stok,
            'prekursor'    => $this->prekursor,
            'psikotropika' => $this->psikotropika,
            'resep'        => $this->resep,
            'active'       => $this->active,
        ]);

        session()->flash('message', 'Produk berhasil disimpan ✅');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.product-form', [
            'products' => Product::latest()->get()
        ]);
    }
}
