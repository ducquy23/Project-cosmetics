<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthUserController extends Controller
{
    public function login(){
        return view('frontend.auth.login');
    }

    public function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Địa chỉ email không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);

        if (Auth::guard('web')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => 1
        ])){
            $request->session()->regenerate();
            
            toastr()->success('Đăng nhập thành công.');
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'status' => 'Thông tin đăng nhập được cung cấp không khớp hoặc tài khoản của bạn đã bị khóa.',
        ]);
    }

    public function register(){
        return view('frontend.auth.register');
    }

    public function registerPost(Request $request){
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'nullable|confirmed|min:6',
        ],[
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.unique' => 'Số điện thoại này đã được sử dụng.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);

        // Nếu không có password, tạo password mặc định
        if (empty($validated['password'])) {
            $validated['password'] = bcrypt(str()->random(12));
        } else {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user = User::create($validated);
        if($user){
            toastr()->success('Đăng ký tài khoản thành công.');
            return redirect()->route('login');
        }
        
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
 
        // $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function forgotPassword(){
        return view('frontend.auth.forgot-password');
    }

    public function forgotPasswordPost(Request $request){
        $request->validate(['email' => 'required|email'], ['email.required' => 'Vui lòng nhập địa chỉ email.']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        if($status === Password::RESET_LINK_SENT){
            toastr()->success('Vui lòng kiểm tra địa chỉ email của bạn.');
            return back();
        }else{
            return back()->withErrors(['email' => 'Địa chỉ email này chưa được đăng ký.']);
        }
    }

    public function resetPassword(string $token){
        return view('frontend.auth.reset-password', compact('token'));
    }

    public function resetPasswordPost(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ],[
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ]);
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        if($status === Password::PASSWORD_RESET){
            toastr()->success('Đặt lại mật khẩu thành công.');
            return redirect()->route('login');
        }else{
            return back()->withErrors(['email' => 'Địa chỉ email không hợp lệ.']);
        }
    }

    public function redirectToGoogle(){
        // TODO: Implement Google OAuth redirect
        // Cần cài đặt: composer require laravel/socialite
        // Và cấu hình trong config/services.php
        return redirect()->route('register')->with('info', 'Tính năng đăng ký bằng Gmail đang được phát triển. Vui lòng đăng ký bằng form.');
    }

    public function handleGoogleCallback(Request $request){
        // TODO: Implement Google OAuth callback
        return redirect()->route('register');
    }
}