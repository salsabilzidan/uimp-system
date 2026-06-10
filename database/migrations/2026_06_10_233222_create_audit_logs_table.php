<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            // يربط بالـ user اللي دار العملية (لو انحذف الحساب يقعد السجل وقيمته null)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('action'); // نوع الحركة: إضافة، تعديل، حذف
            $table->string('auditable_type'); // اسم الجدول أو الموديل المتأثر
            $table->unsignedBigInteger('auditable_id'); // رقم السجل اللي صار فيه التغيير
            $table->json('old_values')->nullable(); // البيانات القديمة قبل التعديل
            $table->json('new_values')->nullable(); // البيانات الجديدة بعد التعديل
            $table->string('ip_address', 45)->nullable(); // عنوان الـ IP لجهاز المستخدم
            $table->text('user_agent')->nullable(); // نوع المتصفح والجهاز
            $table->timestamp('created_at')->useCurrent(); // وقت العملية تلقائياً
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};