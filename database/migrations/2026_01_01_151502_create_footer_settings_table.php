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
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            
            // Company Information
            $table->string('company_name')->nullable()->comment('Tên công ty');
            $table->string('company_logo')->nullable()->comment('Logo công ty');
            $table->text('company_description')->nullable()->comment('Mô tả công ty');
            
            // Navigation Links (JSON format)
            $table->text('navigation_links')->nullable()->comment('Danh sách links điều hướng (JSON)');
            
            // Contact Information
            $table->text('address')->nullable()->comment('Địa chỉ');
            $table->string('email')->nullable()->comment('Email');
            $table->string('hotline')->nullable()->comment('Hotline');
            $table->text('opening_hours')->nullable()->comment('Giờ làm việc');
            
            // Newsletter
            $table->text('newsletter_description')->nullable()->comment('Mô tả newsletter');
            
            // Social Media Links
            $table->string('facebook_url')->nullable()->comment('Link Facebook');
            $table->string('twitter_url')->nullable()->comment('Link Twitter');
            $table->string('google_url')->nullable()->comment('Link Google');
            $table->string('instagram_url')->nullable()->comment('Link Instagram');
            
            // Payment Methods
            $table->string('payment_image')->nullable()->comment('Hình ảnh phương thức thanh toán');
            
            // Copyright
            $table->text('copyright_text')->nullable()->comment('Text bản quyền');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
