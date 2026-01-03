<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Post;
use App\Models\Banner;
use App\Models\ContactMessage;
use App\Models\HomepageSection;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function index(){
        // Load sản phẩm bán chạy từ HomepageSection nếu có, nếu không thì load từ Product
        $bestSellingSections = HomepageSection::where('type', 'best_selling')
            ->where('is_active', true)
            ->whereNotNull('product_id')
            ->with('product')
            ->orderBy('order')
            ->get();

        if ($bestSellingSections->isNotEmpty()) {
            $topSellingProducts = $bestSellingSections->map(function($section) {
                return $section->product;
            })->filter(function($product) {
                return $product !== null;
            })->values();
        } else {
            $topSellingProducts = Product::orderByDesc('sold')->get()->take(10);
        }

        $bestSellingContent = HomepageSection::where('type', 'best_selling_content')
            ->where('is_active', true)
            ->first();

        $discountSections = HomepageSection::where('type', 'discounted')
            ->where('is_active', true)
            ->with('product')
            ->orderBy('order')
            ->get();

        $discountSections = HomepageSection::where('type', 'discounted')
            ->where('is_active', true)
            ->whereNotNull('product_id')
            ->with('product')
            ->orderBy('order')
            ->get();

        if ($discountSections->isNotEmpty()) {
            $discountProducts = $discountSections->map(function($section) {
                return $section->product;
            })->filter(function($product) {
                return $product !== null;
            })->values();
        } else {
            $discountProducts = Product::where('discount', '>', 0)->orderByDesc('id')->limit(10)->get();
        }
        $newPosts = Post::orderByDesc('id')->limit(3)->get();
        $latestProducts = Product::orderByDesc('id')->limit(8)->get();
        $slides = Banner::where('type', 'slide')
                        ->where('status', 'active')
                        ->orderBy('order')
                        ->orderByDesc('id')
                        ->get();
        $categories = Category::whereNull('parent_id')->with('children')->get();

        $policyBlocks = HomepageSection::where('type', 'policy')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        if ($policyBlocks->isEmpty()) {
            $this->createDefaultPolicyBlocks();
            $policyBlocks = HomepageSection::where('type', 'policy')
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
        }

        $bannerSections = HomepageSection::where('type', 'banner')
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(2)
            ->get();

        if ($bannerSections->isEmpty()) {
            $this->createDefaultBannerSections();
            $bannerSections = HomepageSection::where('type', 'banner')
                ->where('is_active', true)
                ->orderBy('order')
                ->limit(2)
                ->get();
        }

        // Load banner bottom sections từ database (banner bottom - effect3, effect4)
        $bannerBottomSections = HomepageSection::where('type', 'banner_bottom')
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(2)
            ->get();

        // Load testimonials từ database
        $testimonials = HomepageSection::where('type', 'testimonial')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        // Load logo đối tác từ database
        $partnerLogos = HomepageSection::where('type', 'logo')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('frontend.index', compact('discountProducts','topSellingProducts', 'newPosts', 'latestProducts', 'slides', 'categories', 'policyBlocks', 'bannerSections', 'bannerBottomSections', 'bestSellingContent', 'testimonials', 'partnerLogos'));
    }

    public function shop(Request $request){
        $keyword = $request->input('keyword');

        $products = Product::when($keyword, function($query,$keyword){
            return $query->where('name','like',"%$keyword%");
        });

        $products = $this->filter($products, $request);
        $products = $this->sortBy($products, $request);
        $products = $products->paginate(12);
        $category = null;
        return view('frontend.shop', compact('products', 'category'));
    }

    public function product(Product $product){
        $relatedProducts = Product::where('category_id', $product->category_id)
                            ->where('id', '<>', $product->id)
                            ->limit(3)
                            ->get();
        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    public function getProductByCategory(Category $category, Request $request){
        // Route model binding sẽ tự động tìm category theo slug nhờ getRouteKeyName() trong Model
        if($category->children->count() != 0){
            $child_cate_ids = $category->children()->pluck('id');
            $products = Product::whereIn('category_id', $child_cate_ids);
        }
        else{
            $products = Product::where('category_id', $category->id);
        }
        $products = $this->filter($products, $request);
        $products = $this->sortBy($products, $request);
        $products = $products->paginate(12);

        return view('frontend.shop', compact('products', 'category'));
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

    public function search(Request $request){
        $keyword = $request->input('keyword', '');

        $products = collect();
        $posts = collect();

        if($keyword) {
            // Tìm sản phẩm
            $products = Product::with('images')
                ->where('name', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%")
                ->limit(12)
                ->get();

            // Tìm bài viết
            $posts = Post::where('title', 'like', "%$keyword%")
                ->orWhere('content', 'like', "%$keyword%")
                ->limit(6)
                ->get();
        }

        return view('frontend.search', compact('products', 'posts', 'keyword'));
    }

    public function submitContact(Request $request){
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'from' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ], [
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'message.required' => 'Vui lòng nhập nội dung.',
        ]);

        if (!empty($data['from'])) {
            $data['from'] = trim($data['from']);
            if (!filter_var($data['from'], FILTER_VALIDATE_EMAIL)) {
                return redirect()->route('contact')
                    ->withInput()
                    ->withErrors(['from' => 'Email không hợp lệ.']);
            }
        }

        try {
            ContactMessage::create([
                'name' => !empty($data['name']) ? trim($data['name']) : null,
                'email' => !empty($data['from']) ? trim($data['from']) : null,
                'phone' => trim($data['phone']),
                'message' => trim($data['message']),
                'status' => 'new'
            ]);

            return redirect()->route('contact')->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('contact')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại sau.');
        }
    }
}
