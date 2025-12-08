<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function postType()
    {
        return $this->belongsTo(PostType::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => \Storage::url($value),
        );
    }

    public function shortContent($text, $limit = 100) {
        $text = strip_tags($text);
        $text = Str::limit($text, $limit); 

        $text = mb_substr($text, 0, mb_strrpos($text, ' '));

        return $text . '...';
    }
}
