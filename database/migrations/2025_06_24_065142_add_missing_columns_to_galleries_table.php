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
        Schema::table('galleries', function (Blueprint $table) {
            // Tambah kolom title (ganti caption jadi title)
            $table->string('title')->after('id')->nullable();
            
            // Tambah kolom description
            $table->text('description')->nullable()->after('title');
            
            // Tambah kolom alt_text
            $table->string('alt_text')->nullable()->after('image_path');
            
            // Tambah kolom sort_order  
            $table->integer('sort_order')->default(0)->after('alt_text');
            
            // Tambah kolom is_featured
            $table->boolean('is_featured')->default(false)->after('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'description', 
                'alt_text',
                'sort_order',
                'is_featured'
            ]);
        });
    }
};
