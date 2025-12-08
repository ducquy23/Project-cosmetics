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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->comment('Tiêu đề banner/slide');
            $table->string('image')->comment('Đường dẫn hình ảnh');
            $table->string('link')->nullable()->comment('Liên kết khi click vào banner');
            $table->enum('type', ['banner', 'slide'])->default('banner')->comment('Loại: banner hoặc slide');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Trạng thái');
            $table->string('position')->nullable()->comment('Vị trí hiển thị');
            $table->integer('order')->default(0)->comment('Thứ tự sắp xếp');
            $table->text('description')->nullable()->comment('Mô tả');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
