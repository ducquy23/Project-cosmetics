<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Post;

class ShopController extends Controller
{
    public function index(){
        $topSellingProducts = Product::orderByDesc('sold')->get()->take(10);
        $discountProducts = Product::where('discount', '>', 0)->orderByDesc('id')->limit(10)->get();
        $newPosts = Post::orderByDesc('id')->limit(3)->get();
        $latestProducts = Product::orderByDesc('id')->limit(8)->get();
        return view('frontend.index', compact('discountProducts','topSellingProducts', 'newPosts', 'latestProducts'));
    }

    public function shop(Request $request){
        $keyword = $request->input('keyword');
       
        $products = Product::when($keyword, function($query,$keyword){
            return $query->where('name','like',"%$keyword%");
        });
        
        $products = $this->filter($products, $request);
        $products = $this->sortBy($products, $request);
        $products = $products->paginate(12);
        return view('frontend.shop', compact('products'));
    }

    public function product(Product $product){
        $relatedProducts = Product::where('category_id', $product->category_id)
                            ->where('id', '<>', $product->id)
                            ->limit(3)
                            ->get();
        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    public function getProductByCategory(Category $category, Request $request){
        
        if($category->children->count() != 0){
            $child_cate_ids = $category->children()->pluck('id');
            $products = Product::whereIn('category_id', $child_cate_ids);
        }
        else{
            $products = Product::where('category_id',$category->id);
        }
        $products = $this->filter($products, $request);
        $products = $this->sortBy($products, $request);
        $products = $products->paginate(12);

        return view('frontend.shop',compact('products'));
    }

    // public function getProductByAuthor(Author $author, Request $request){
        
    //     $products = Product::where('author_id',$author->id);
    //     $products = $this->filter($products, $request);
    //     $products = $this->sortBy($products, $request);

    //     return view('frontend.shop',compact('products'));
    // }

    protected function filter($products, $request){
        
        /* Nơi sản xuất filter */
        $origins = $request->input('xuat_xu') ?? [];
        $arr_origins = array_keys($origins);

        $products = $products->when($arr_origins, function($query, $arr_origins){
            return $query->whereIn('origin_id', $arr_origins);
        });

        /* Thương hiệu filter */
        $brands = $request->input('thuong_hieu') ?? [];
        $arr_brands = array_keys($brands);

        $products = $products->when($arr_brands, function($query, $arr_brands){
            return $query->whereIn('brand_id', $arr_brands);
        });

        // $min_price = $request->input('min_price');
        // $max_price = $request->input('max_price');

        // $products = ($min_price != null && $max_price != null) 
        //             ? $products->whereBetween('price', [$min_price, $max_price]) : $products;

        return $products;
    }

    protected function sortBy($products,Request $request){
        $sortBy = $request->input('sort_by') ?? 'latest';
        
        switch ($sortBy) {
            case 'latest':
                $products = $products->orderByDesc('id');
                break;
            case 'oldest':
                $products = $products->orderBy('id');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-desending':
                $products = $products->orderByDesc('price');
                break;
            case 'discount':
                $products = $products->where('discount', '<>', 0)->orderByDesc('discount');
                break;
            default: $products = $products->orderByDesc('id');
        }

        // $products = $products->paginate(1);
        // $products->appends(['sort_by' => $sortBy , 'show' => $perPage]);

        return $products;
    }

    public function contact(){
        return view('frontend.contact');
    }
}
