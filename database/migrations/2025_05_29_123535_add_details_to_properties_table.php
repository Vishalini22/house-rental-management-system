<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Modify the existing 'status' column to allow 'suspended'
            $table->enum('status', ['pending', 'approved', 'suspended'])->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Revert back to original enum
            $table->enum('status', ['pending', 'approved'])->default('pending')->change();
        });
    }
};
