<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->has('search')) {
            $search = $request->input('search') ?? '';
            $query->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            });
            $users = $query->paginate(10);
        }
        $users = $query->paginate(10);

        return view('admin.user.list', compact('users'));
    }

    public function handleStatus(User $user)
    {
        $status = $user->status;
        if ($status === 1) {
            $user->status = 0;
        } else {
            $user->status = 1;
        }
        $user->save();
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Xóa khách hàng thành công.');
    }

}
