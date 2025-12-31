<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    public function index()
    {
        $seoSettings = SeoSettings::getSettings();
        return view('admin.seo.index', compact('seoSettings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'google_analytics_id' => 'nullable|string|max:255',
            'google_search_console' => 'nullable|string|max:255',
            'facebook_pixel' => 'nullable|string',
            'custom_head_code' => 'nullable|string',
            'custom_body_code' => 'nullable|string',
            'robots_txt' => 'nullable|string',
            'enable_sitemap' => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            $seoSettings = SeoSettings::getSettings();

            // Xử lý upload og_image
            if ($request->hasFile('og_image')) {
                if ($seoSettings->og_image && file_exists(public_path('storage/' . $seoSettings->og_image))) {
                    unlink(public_path('storage/' . $seoSettings->og_image));
                }
                $imageName = $request->file('og_image')->hashName();
                $res = $request->file('og_image')->storeAs('seo', $imageName, 'public');
                if ($res) {
                    $data['og_image'] = 'seo/' . $imageName;
                }
            } else {
                unset($data['og_image']);
            }

            $seoSettings->update($data);
            DB::commit();

            return redirect()->route('seo.index')->with('success', 'Cập nhật cài đặt SEO thành công!');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}
