<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type = 'about')
    {
        $page = Page::getPage($type);
        return view('admin.page.edit', compact('page', 'type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $type = 'about')
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'nullable|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $page = Page::getPage($type);
            
            // Tự động tạo slug nếu không có
            $slug = $request->slug;
            if (empty($slug)) {
                $slug = Str::slug($request->title);
            }
            
            $page->type = $type;
            $page->title = $request->title;
            $page->slug = $slug;
            $page->content = $request->content;
            $page->meta_title = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->meta_keywords = $request->meta_keywords;
            
            if($request->file('thumbnail')){
                // Xóa ảnh cũ nếu có
                if ($page->thumbnail && file_exists(public_path('storage/' . $page->thumbnail))) {
                    unlink(public_path('storage/' . $page->thumbnail));
                }
                $page->thumbnail = $this->saveImage($request->thumbnail);
            }
            
            $page->save();
            DB::commit();
            
            return redirect()->route('page.edit', $type)->with('success', 'Cập nhật trang thành công!');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->route('page.edit', $type)
                ->withInput()
                ->with('error', 'Có lỗi xảy ra khi cập nhật: ' . $e->getMessage());
        }
    }

    protected function saveImage($image){
        $imageName = $image->hashName();
        $res = $image->storeAs('pages', $imageName, 'public');
        if($res){
            $path = 'pages/'. $imageName;
        }
        return $path;
    }
}

