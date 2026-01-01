<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Post;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\BlogController;

class SlugController extends Controller
{
    public function index($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $shopController = new ShopController();
            return $shopController->product($product);
        }

        $post = Post::where('slug', $slug)->first();
        if ($post) {
            $blogController = new BlogController();
            return $blogController->blogDetail($post);
        }

        abort(404);
    }
}
