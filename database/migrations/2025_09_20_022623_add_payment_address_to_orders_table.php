<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->default('balance'); // balance, transfer, ewallet
            $table->string('payment_provider')->nullable();
            $table->json('shipping_address')->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->string('payment_status')->default('pending'); // pending, paid, failed
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_provider',
                'shipping_address',
                'shipping_cost',
                'payment_status'
            ]);
        });
    }
};
