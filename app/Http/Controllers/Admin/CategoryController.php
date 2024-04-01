<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $parent_cates = Category::where('parent_id', 0)->get();
        view()->share('parent_cates', $parent_cates);
    }

    public function index(Request $request)
    {
        $query = Category::query();
        if ($request->has('search')) {
            $search = $request->input('search') ?? '';
            $query->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            });
            $listCategory = $query->paginate(10);

        }
        $listCategory = $query->paginate(10);
        return view('admin.category.list',compact('listCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories,name|string',
            'parent_id' => 'required|integer',
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'parent_id.required' => 'Vui lòng nhập chọn danh mục cha.',
        ]);
        DB::beginTransaction();
        try {
            Category::create($data);
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Thêm thành công!');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'parent_id' => 'required|integer',
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'parent_id.required' => 'Vui lòng nhập chọn danh mục cha.',
        ]);
        DB::beginTransaction();
        try {
            $category->update($data);
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Xóa thành công!');
    }
}
