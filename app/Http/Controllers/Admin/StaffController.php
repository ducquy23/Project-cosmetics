<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class StaffController extends Controller
{
    public function index(Request $request){
        $name = $request->input('name') ?? '';

        $staffs = Admin::when($name, function($query, $name){
                $query->where('name', 'LIKE', "%$name%");
            })->orderByDesc('id')->paginate(10);
        return view('admin.staff.list', compact('staffs'));
    }

    public function create(){
        return view('admin.staff.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'role' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        $res = Admin::create($data);
        if($res){
            return redirect()->route('staff.index')->with('success', 'Thêm nhân viên mới thành công.');
        }
    }

    public function edit(Admin $staff){
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Admin $staff){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string|unique:admins,email,' . $staff->id,
            'role' => 'required',
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'nullable',
        ], [
            'name.required' => 'Vui lòng nhập tên nhân viên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'role.required' => 'Vui lòng chọn chức vụ.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);

        // Chỉ cập nhật mật khẩu nếu có nhập
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        
        unset($data['password_confirmation']);

        $staff->update($data);
        return redirect()->route('staff.index')->with('success', 'Cập nhật thông tin nhân viên thành công.');
    }

    public function destroy(Admin $staff){
        $staff->delete();
        return back()->with('success', 'Xóa nhân viên thành công.');
    }
}
