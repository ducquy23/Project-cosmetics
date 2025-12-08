<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Banner::query();
        
        if ($request->has('search')) {
            $search = $request->input('search') ?? '';
            $query->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            });
        }
        
        $banners = $query->orderBy('order')->orderByDesc('id')->paginate(10);
        
        return view('admin.banner.list', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ], [
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'image.required' => 'Vui lòng chọn hình ảnh.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'link.url' => 'Liên kết không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'order.integer' => 'Thứ tự phải là số nguyên.',
            'order.min' => 'Thứ tự phải lớn hơn hoặc bằng 0.',
        ]);
        
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $data['image'] = $this->saveImage($request->file('image'));
            }
            
            $data['order'] = $data['order'] ?? 0;
            $data['type'] = 'slide'; // Config cứng: tất cả đều là slide
            
            Banner::create($data);
            DB::commit();
            
            return redirect()->route('banner.index')->with('success', 'Thêm banner/slide thành công!');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('admin.banner.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ], [
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'link.url' => 'Liên kết không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'order.integer' => 'Thứ tự phải là số nguyên.',
            'order.min' => 'Thứ tự phải lớn hơn hoặc bằng 0.',
        ]);
        
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                // Xóa hình ảnh cũ nếu có
                if ($banner->image && file_exists(public_path('storage/' . $banner->image))) {
                    unlink(public_path('storage/' . $banner->image));
                }
                $data['image'] = $this->saveImage($request->file('image'));
            } else {
                unset($data['image']);
            }
            
            $data['order'] = $data['order'] ?? $banner->order;
            $data['type'] = 'slide'; // Config cứng: tất cả đều là slide
            
            $banner->update($data);
            DB::commit();
            
            return redirect()->route('banner.index')->with('success', 'Cập nhật banner/slide thành công!');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        DB::beginTransaction();
        try {
            // Xóa hình ảnh nếu có
            if ($banner->image && file_exists(public_path('storage/' . $banner->image))) {
                unlink(public_path('storage/' . $banner->image));
            }
            
            $banner->delete();
            DB::commit();
            
            return redirect()->back()->with('success', 'Xóa banner/slide thành công!');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
    
    /**
     * Save image to storage
     */
    protected function saveImage($image)
    {
        $imageName = $image->hashName();
        $res = $image->storeAs('banners', $imageName, 'public');
        
        if ($res) {
            $path = 'banners/' . $imageName;
            return $path;
        }
        
        return null;
    }
}
