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
        Schema::table('contact_messages', function (Blueprint $table) {
            // Cho phép name và email nullable
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            // Đảm bảo phone là NOT NULL
            $table->string('phone')->nullable(false)->change();
            // message đã là NOT NULL, không cần thay đổi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            // Revert lại
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('phone')->nullable()->change();
        });
    }
};
