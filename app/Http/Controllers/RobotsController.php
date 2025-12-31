<?php

namespace App\Http\Controllers;

use App\Models\SeoSettings;
use Illuminate\Http\Request;

class RobotsController extends Controller
{
    public function index()
    {
        $seoSettings = SeoSettings::getSettings();
        
        $robotsContent = $seoSettings->robots_txt;
        
        // Nếu không có nội dung tùy chỉnh, dùng mặc định
        if (empty($robotsContent)) {
            $robotsContent = "User-agent: *\n";
            $robotsContent .= "Allow: /\n";
            $robotsContent .= "Disallow: /admin/\n";
            $robotsContent .= "Disallow: /api/\n\n";
            $robotsContent .= "Sitemap: " . url('/sitemap.xml');
        }
        
        return response($robotsContent, 200)
            ->header('Content-Type', 'text/plain');
    }
}
