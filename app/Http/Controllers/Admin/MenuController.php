<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::orderBy('order')->get();
        return view('admin.menu.index', compact('menuItems'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_visible' => 'nullable|boolean',
        ], [
            'name.required' => 'Tên menu không được để trống.',
        ]);

        $data['order'] = $data['order'] ?? MenuItem::max('order') + 1;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;

        MenuItem::create($data);

        return redirect()->route('menu.index')->with('success', 'Thêm menu thành công!');
    }

    public function edit(MenuItem $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, MenuItem $menu)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_visible' => 'nullable|boolean',
        ], [
            'name.required' => 'Tên menu không được để trống.',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;

        $menu->update($data);

        return redirect()->route('menu.index')->with('success', 'Cập nhật menu thành công!');
    }

    public function destroy(MenuItem $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Xóa menu thành công!');
    }
}
