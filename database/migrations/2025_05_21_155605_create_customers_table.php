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
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('customer_id', true);
            $table->string('name', 100);
            $table->string('email', 100)->unique('email');
            $table->string('phone', 110)->nullable();
            $table->text('address')->nullable();
            $table->string('avatar')->default('1.png');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
