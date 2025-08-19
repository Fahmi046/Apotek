<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat')->unique();
            $table->string('nama_obat');
            $table->string('pabrik')->nullable();
            $table->string('golongan')->nullable();
            $table->string('komposisi')->nullable();
            $table->boolean('generik')->default(false);

            $table->string('kemasan')->nullable();
            $table->string('satuan')->nullable();
            $table->string('isi_obat')->nullable();
            $table->string('dosis')->nullable();
            $table->string('sediaan')->nullable();
            $table->string('barcode')->nullable();

            $table->decimal('harga_hna', 15, 2)->nullable();
            $table->decimal('harga_ppn', 15, 2)->nullable();
            $table->decimal('hja', 15, 2)->nullable();

            $table->string('kreditur')->nullable();
            $table->integer('min_stok')->default(0);
            $table->boolean('prekursor')->default(false);
            $table->boolean('psikotropika')->default(false);
            $table->boolean('resep')->default(false);
            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
