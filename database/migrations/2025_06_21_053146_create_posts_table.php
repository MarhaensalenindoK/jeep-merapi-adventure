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
        // Tabel untuk artikel blog
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
             // Menghubungkan ke penulis artikel (dari tabel users)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title'); // Judul Artikel
            $table->string('slug')->unique(); // Slug untuk URL artikel
            $table->longText('body'); // Isi lengkap artikel
            $table->string('featured_image')->nullable(); // Gambar utama artikel
            $table->timestamp('published_at')->nullable(); // Tanggal publikasi
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
        Schema::dropIfExists('posts');
    }
};
