<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subsystems', function (Blueprint $table) {
            $table->id();
            $table->string('name_en'); // اسم النظام الفرعي بالإنجليزي
            $table->string('name_ar'); // اسم النظام الفرعي بالعربي
            $table->string('api_key')->unique(); // مفتاح الربط والأمان الخاص بالنظام الثاني
            $table->string('base_url')->nullable(); // رابط النظام الثاني
            $table->string('status', 20)->default('active'); // حالة النظام الفرعي
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subsystems');
    }
};