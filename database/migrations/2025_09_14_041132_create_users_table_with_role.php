<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Jika tabel users belum ada, buat tabel baru
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('role')->default('user'); // admin, user
                $table->string('phone')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        } else {
            // Jika tabel users sudah ada, tambahkan kolom role
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'role')) {
                    $table->string('role')->default('user')->after('email');
                }
                if (!Schema::hasColumn('users', 'phone')) {
                    $table->string('phone')->nullable()->after('role');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
