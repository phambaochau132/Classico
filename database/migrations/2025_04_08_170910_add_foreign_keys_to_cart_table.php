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
        Schema::table('cart', function (Blueprint $table) {
            $table->foreign(['customer_id'], 'cart_ibfk_1')->references(['customer_id'])->on('customers')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['product_id'], 'cart_ibfk_2')->references(['product_id'])->on('products')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropForeign('cart_ibfk_1');
            $table->dropForeign('cart_ibfk_2');
        });
    }
};
