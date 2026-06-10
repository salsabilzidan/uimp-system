<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // إنشاء جدول الأدوار الأساسية
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->unique(); // اسم الدور بالإنجليزي
            $table->string('name_ar')->unique(); // اسم الدور بالعربي
            $table->timestamps();
        });

        // إنشاء جدول الربط بين المستخدم والدور
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('roles');
    }
};