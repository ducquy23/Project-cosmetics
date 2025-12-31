<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSettings extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'enable_sitemap' => 'boolean',
    ];

    /**
     * Lấy hoặc tạo SEO settings (chỉ có 1 record)
     */
    public static function getSettings()
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
