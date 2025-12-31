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
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable()->comment('Tên website');
            $table->text('meta_title')->nullable()->comment('Meta title mặc định');
            $table->text('meta_description')->nullable()->comment('Meta description mặc định');
            $table->text('meta_keywords')->nullable()->comment('Meta keywords');
            $table->string('og_image')->nullable()->comment('Hình ảnh Open Graph');
            $table->string('google_analytics_id')->nullable()->comment('Google Analytics ID');
            $table->string('google_search_console')->nullable()->comment('Google Search Console verification');
            $table->text('facebook_pixel')->nullable()->comment('Facebook Pixel code');
            $table->text('custom_head_code')->nullable()->comment('Code tùy chỉnh trong <head>');
            $table->text('custom_body_code')->nullable()->comment('Code tùy chỉnh trước </body>');
            $table->text('robots_txt')->nullable()->comment('Nội dung robots.txt');
            $table->boolean('enable_sitemap')->default(true)->comment('Bật sitemap');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
