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
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            
            // Contact Information
            $table->text('emails')->nullable()->comment('Danh sách email (mỗi dòng một email)');
            $table->text('address')->nullable()->comment('Địa chỉ');
            $table->text('hotlines')->nullable()->comment('Danh sách hotline (mỗi dòng một số)');
            
            // Map
            $table->text('map_iframe')->nullable()->comment('Code iframe Google Maps');
            
            // Form Intro Text
            $table->text('intro_text')->nullable()->comment('Text giới thiệu trên form');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
    }
};
