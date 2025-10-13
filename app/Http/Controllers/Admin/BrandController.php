<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Brand::query();
        if ($request->has('search')) {
            $search = $request->input('search') ?? '';
            $query->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            });
            $listBrand = $query->paginate(10);
        }
        $listBrand = $query->paginate(10);
        return view('admin.Brand.list', compact('listBrand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:brands,name|string'
        ],[
            'name.required' => 'Vui lòng nhập tên thương hiệu.'
        ]);
        DB::beginTransaction();
        try {
            Brand::create($data);
            DB::commit();
            return redirect()->route('brand.index');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $Brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);
        DB::beginTransaction();
        try {
            $brand->update($data);
            DB::commit();
            return redirect()->route('brand.index');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->back()->with('success', 'Xóa thành công!');
    }
}
