<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index()
    {
        $sections = HomepageSection::ordered()->get()->groupBy('type');
        return view('admin.homepage.index', compact('sections'));
    }

    public function edit($type)
    {
        $sections = HomepageSection::byType($type)->with('product')->ordered()->get();
        
        // Load danh sách sản phẩm cho discounted hoặc best_selling
        $products = null;
        if ($type === 'discounted') {
            $products = \App\Models\Product::where('discount', '>', 0)
                ->orderBy('name')
                ->get();
        } elseif ($type === 'best_selling') {
            $products = \App\Models\Product::orderBy('name')
                ->get();
        }
        
        return view('admin.homepage.edit', compact('sections', 'type', 'products'));
    }

    public function update(Request $request, $type)
    {
        DB::beginTransaction();
        try {
            // Cập nhật hoặc tạo mới sections
            if ($request->has('sections')) {
                foreach ($request->sections as $index => $sectionData) {
                    $imagePath = $sectionData['image'] ?? null;
                    
                    // Xử lý upload ảnh mới
                    if ($request->hasFile("sections.$index.image_file")) {
                        $file = $request->file("sections.$index.image_file");
                        if ($file && $file->isValid()) {
                            $imagePath = $file->store('homepage', 'public');
                        }
                    }
                    
                    if (isset($sectionData['id']) && $sectionData['id']) {
                        // Update existing
                        $section = HomepageSection::find($sectionData['id']);
                        if ($section) {
                            // Xóa ảnh cũ nếu có ảnh mới
                            if ($imagePath && $section->image && $imagePath !== $section->image) {
                                Storage::disk('public')->delete($section->image);
                            }
                            
                            $updateData = [
                                'title' => $sectionData['title'] ?? null,
                                'description' => $sectionData['description'] ?? null,
                                'icon' => $sectionData['icon'] ?? null,
                                'image' => $imagePath ?? $section->image,
                                'link' => $sectionData['link'] ?? null,
                                'order' => $index,
                                'is_active' => isset($sectionData['is_active']),
                                'is_visible' => isset($sectionData['is_active']), // Dùng is_active cho is_visible
                            ];
                            
                            // Thêm product_id nếu type là discounted hoặc best_selling
                            if (($type === 'discounted' || $type === 'best_selling') && isset($sectionData['product_id'])) {
                                $updateData['product_id'] = $sectionData['product_id'] ?: null;
                            }
                            
                            // Xử lý settings nếu có
                            if (isset($sectionData['settings']) && is_array($sectionData['settings'])) {
                                $currentSettings = $section->settings ?? [];
                                $updateData['settings'] = array_merge($currentSettings, $sectionData['settings']);
                            }
                            
                            $section->update($updateData);
                        }
                    } else {
                        // Create new
                        if ($imagePath || !empty($sectionData['title']) || (($type === 'discounted' || $type === 'best_selling') && !empty($sectionData['product_id'])) || $type === 'best_selling_content' || $type === 'testimonial') {
                            $createData = [
                                'type' => $type,
                                'title' => $sectionData['title'] ?? null,
                                'description' => $sectionData['description'] ?? null,
                                'icon' => $sectionData['icon'] ?? null,
                                'image' => $imagePath,
                                'link' => $sectionData['link'] ?? null,
                                'order' => $index,
                                'is_active' => isset($sectionData['is_active']),
                                'is_visible' => isset($sectionData['is_active']), // Dùng is_active cho is_visible
                            ];
                            
                            // Thêm product_id nếu type là discounted hoặc best_selling
                            if (($type === 'discounted' || $type === 'best_selling') && isset($sectionData['product_id'])) {
                                $createData['product_id'] = $sectionData['product_id'] ?: null;
                            }
                            
                            // Xử lý settings nếu có
                            if (isset($sectionData['settings']) && is_array($sectionData['settings'])) {
                                $createData['settings'] = $sectionData['settings'];
                            }
                            
                            HomepageSection::create($createData);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.homepage.index')->with('success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('homepage', 'public');
            return response()->json(['path' => $path, 'url' => asset('storage/' . $path)]);
        }
        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
