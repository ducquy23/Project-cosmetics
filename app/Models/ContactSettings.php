<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSettings extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Lấy hoặc tạo Contact settings (chỉ có 1 record)
     */
    public static function getSettings()
    {
        return static::firstOrCreate(['id' => 1]);
    }
}

