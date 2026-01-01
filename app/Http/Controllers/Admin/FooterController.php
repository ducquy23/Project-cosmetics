<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FooterController extends Controller
{
    public function index()
    {
        $footerSettings = FooterSettings::getSettings();
        return view('admin.footer.index', compact('footerSettings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'company_description' => 'nullable|string',
            'navigation_links' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'hotline' => 'nullable|string|max:50',
            'opening_hours' => 'nullable|string',
            'newsletter_description' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'google_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'payment_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'copyright_text' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $footerSettings = FooterSettings::getSettings();

            // Xử lý upload company_logo
            if ($request->hasFile('company_logo')) {
                if ($footerSettings->company_logo && file_exists(public_path('storage/' . $footerSettings->company_logo))) {
                    unlink(public_path('storage/' . $footerSettings->company_logo));
                }
                $imageName = $request->file('company_logo')->hashName();
                $res = $request->file('company_logo')->storeAs('footer', $imageName, 'public');
                if ($res) {
                    $data['company_logo'] = 'footer/' . $imageName;
                }
            } else {
                unset($data['company_logo']);
            }

            // Xử lý upload payment_image
            if ($request->hasFile('payment_image')) {
                if ($footerSettings->payment_image && file_exists(public_path('storage/' . $footerSettings->payment_image))) {
                    unlink(public_path('storage/' . $footerSettings->payment_image));
                }
                $imageName = $request->file('payment_image')->hashName();
                $res = $request->file('payment_image')->storeAs('footer', $imageName, 'public');
                if ($res) {
                    $data['payment_image'] = 'footer/' . $imageName;
                }
            } else {
                unset($data['payment_image']);
            }

            $footerSettings->update($data);
            DB::commit();

            return redirect()->route('footer.index')->with('success', 'Cập nhật cài đặt footer thành công!');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}

