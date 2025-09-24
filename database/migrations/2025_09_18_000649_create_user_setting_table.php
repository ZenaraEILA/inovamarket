<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('notification_preferences')->nullable();
            $table->json('privacy_settings')->nullable();
            $table->string('theme')->default('light'); // light, dark
            $table->string('language')->default('id'); // id, en
            $table->string('currency')->default('IDR');
            $table->string('timezone')->default('Asia/Jakarta');
            $table->boolean('marketing_emails')->default(true);
            $table->boolean('order_notifications')->default(true);
            $table->boolean('security_alerts')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
