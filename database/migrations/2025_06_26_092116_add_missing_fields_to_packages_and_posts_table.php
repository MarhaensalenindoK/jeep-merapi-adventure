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
        // Add missing fields to packages table
        Schema::table('packages', function (Blueprint $table) {
            $table->text('description')->nullable()->after('slug'); // Short description
            $table->boolean('is_active')->default(true)->after('full_description'); // Active status
        });

        // Add missing fields to posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->text('excerpt')->nullable()->after('slug'); // Short excerpt
            $table->boolean('is_published')->default(false)->after('featured_image'); // Published status
        });

        // Add missing fields to package_categories table
        Schema::table('package_categories', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('description'); // Active status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['description', 'is_active']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['excerpt', 'is_published']);
        });

        // Don't drop is_active from package_categories if it doesn't exist yet
        if (Schema::hasColumn('package_categories', 'is_active')) {
            Schema::table('package_categories', function (Blueprint $table) {
                $table->dropColumn(['is_active']);
            });
        }
    }
};
