<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Post;
use App\Models\SeoSettings;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $seoSettings = SeoSettings::getSettings();
        
        if (!$seoSettings->enable_sitemap) {
            abort(404);
        }

        $products = Product::orderBy('updated_at', 'desc')->get();
        $categories = Category::orderBy('updated_at', 'desc')->get();
        $posts = Post::orderBy('updated_at', 'desc')->get();

        return response()->view('sitemap.index', [
            'products' => $products,
            'categories' => $categories,
            'posts' => $posts,
            'baseUrl' => url('/'),
        ])->header('Content-Type', 'text/xml');
    }
}
