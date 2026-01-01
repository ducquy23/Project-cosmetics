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
        Schema::table('footer_settings', function (Blueprint $table) {
            // Contact labels
            $table->string('contact_title')->nullable()->after('opening_hours')->comment('Tiêu đề phần liên hệ');
            $table->string('address_label')->nullable()->after('contact_title')->comment('Nhãn địa chỉ');
            $table->string('email_label')->nullable()->after('address_label')->comment('Nhãn email');
            $table->string('hotline_label')->nullable()->after('email_label')->comment('Nhãn hotline');
            $table->string('opening_hours_label')->nullable()->after('hotline_label')->comment('Nhãn giờ làm việc');
            
            // Map embed code (thay newsletter)
            $table->text('map_embed_code')->nullable()->after('newsletter_description')->comment('Mã embed bản đồ');
            
            // Payment images (JSON để lưu nhiều ảnh)
            $table->text('payment_images')->nullable()->after('payment_image')->comment('Danh sách ảnh phương thức thanh toán (JSON)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('footer_settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_title',
                'address_label',
                'email_label',
                'hotline_label',
                'opening_hours_label',
                'map_embed_code',
                'payment_images'
            ]);
        });
    }
};
