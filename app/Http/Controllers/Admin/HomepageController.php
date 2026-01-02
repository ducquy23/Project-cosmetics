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
        $sections = HomepageSection::byType($type)->ordered()->get();
        return view('admin.homepage.edit', compact('sections', 'type'));
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
                    if ($request->hasFile("sections.{$index}.image_file")) {
                        $file = $request->file("sections.{$index}.image_file");
                        $imagePath = $file->store('homepage', 'public');
                    }
                    
                    if (isset($sectionData['id']) && $sectionData['id']) {
                        // Update existing
                        $section = HomepageSection::find($sectionData['id']);
                        if ($section) {
                            // Xóa ảnh cũ nếu có ảnh mới
                            if ($imagePath && $section->image && $imagePath !== $section->image) {
                                Storage::disk('public')->delete($section->image);
                            }
                            
                            $section->update([
                                'title' => $sectionData['title'] ?? null,
                                'description' => $sectionData['description'] ?? null,
                                'icon' => $sectionData['icon'] ?? null,
                                'image' => $imagePath ?? $section->image,
                                'link' => $sectionData['link'] ?? null,
                                'order' => $index,
                                'is_active' => isset($sectionData['is_active']),
                                'is_visible' => isset($sectionData['is_visible']),
                            ]);
                        }
                    } else {
                        // Create new
                        if ($imagePath || !empty($sectionData['title'])) {
                            HomepageSection::create([
                                'type' => $type,
                                'title' => $sectionData['title'] ?? null,
                                'description' => $sectionData['description'] ?? null,
                                'icon' => $sectionData['icon'] ?? null,
                                'image' => $imagePath,
                                'link' => $sectionData['link'] ?? null,
                                'order' => $index,
                                'is_active' => isset($sectionData['is_active']),
                                'is_visible' => isset($sectionData['is_visible']),
                            ]);
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
