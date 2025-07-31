<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('preferred_location')->nullable();
            $table->string('profile_photo')->nullable(); // Stores image path
            $table->string('status')->default('pending'); // for approval logic
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
