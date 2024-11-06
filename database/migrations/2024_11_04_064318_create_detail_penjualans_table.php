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
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("penjualanID");
            $table->unsignedBigInteger("produkID");
            $table->integer("JumlahProduk");
            $table->decimal("Subtotal", total:10, places:2);

            $table->foreign("penjualanID")->references("id")->on('penjualan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("produkID")->references("id")->on('produk')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
