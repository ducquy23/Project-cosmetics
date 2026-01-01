<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSettings extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Lấy hoặc tạo Footer settings (chỉ có 1 record)
     */
    public static function getSettings()
    {
        return static::firstOrCreate(['id' => 1]);
    }
}

