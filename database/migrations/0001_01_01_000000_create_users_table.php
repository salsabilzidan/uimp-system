<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('preferred_language', 5)->default('ar'); // لغة الواجهة المفضلة
            $table->string('status', 20)->default('active'); // حالة الحساب (نشط/موقف)
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // الحذف الناعم لحماية البيانات
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};