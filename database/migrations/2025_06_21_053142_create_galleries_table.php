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
        // Tabel untuk menyimpan semua foto galeri
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image_path'); // Path/URL ke file gambar
            $table->string('caption')->nullable(); // Judul/keterangan foto
            // Foto bisa spesifik untuk satu paket, atau umum (nullable)
            $table->foreignId('package_id')->nullable()->constrained()->onDelete('set null');
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
        Schema::dropIfExists('galleries');
    }
};
