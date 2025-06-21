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
        // Tabel untuk kategori paket (Short, Medium, Long)
        Schema::create('package_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nama Kategori: Short Trip
            $table->string('slug')->unique(); // Slug untuk URL: short-trip
            $table->string('image')->nullable(); // Gambar utama untuk kategori
            $table->text('description')->nullable(); // Deskripsi singkat kategori
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
        Schema::dropIfExists('package_categories');
    }
};
