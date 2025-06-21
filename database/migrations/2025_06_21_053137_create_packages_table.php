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
        // Tabel untuk setiap paket wisata (Short A, Short B, dll)
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel kategori. Jika kategori dihapus, paket terkait juga akan terhapus.
            $table->foreignId('package_category_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nama Paket: Short A
            $table->string('slug')->unique(); // Slug untuk URL: short-a
            $table->unsignedInteger('price'); // Harga dalam format angka: 400000
            $table->string('duration'); // Durasi: 1-1,5 JAM
            $table->text('routes'); // Rute yang dikunjungi, dipisahkan koma atau JSON
            $table->longText('full_description')->nullable(); // Deskripsi lengkap untuk halaman detail
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
