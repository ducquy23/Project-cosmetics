<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    
    <!-- Trang chủ -->
    <url>
        <loc>{{$baseUrl}}</loc>
        <lastmod>{{date('Y-m-d')}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    
    <!-- Cửa hàng -->
    <url>
        <loc>{{$baseUrl}}/cua-hang</loc>
        <lastmod>{{date('Y-m-d')}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Blog -->
    <url>
        <loc>{{$baseUrl}}/bai-viet</loc>
        <lastmod>{{date('Y-m-d')}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Liên hệ -->
    <url>
        <loc>{{$baseUrl}}/lien-he</loc>
        <lastmod>{{date('Y-m-d')}}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    
    <!-- Danh mục -->
    @foreach($categories as $category)
    <url>
        <loc>{{$baseUrl}}/danh-muc/{{$category->slug}}</loc>
        <lastmod>{{$category->updated_at->format('Y-m-d')}}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
    
    <!-- Sản phẩm -->
    @foreach($products as $product)
    <url>
        <loc>{{$baseUrl}}/san-pham/{{$product->slug}}</loc>
        <lastmod>{{$product->updated_at->format('Y-m-d')}}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
    
    <!-- Bài viết -->
    @foreach($posts as $post)
    <url>
        <loc>{{$baseUrl}}/bai-viet/{{$post->slug}}</loc>
        <lastmod>{{$post->updated_at->format('Y-m-d')}}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
    
</urlset>

