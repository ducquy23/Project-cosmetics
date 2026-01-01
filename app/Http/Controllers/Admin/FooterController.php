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
            'contact_title' => 'nullable|string|max:255',
            'address_label' => 'nullable|string|max:255',
            'email_label' => 'nullable|string|max:255',
            'hotline_label' => 'nullable|string|max:255',
            'opening_hours_label' => 'nullable|string|max:255',
            'newsletter_description' => 'nullable|string',
            'map_embed_code' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'google_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'payment_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'payment_images' => 'nullable|array',
            'payment_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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

            // Xử lý upload payment_images (nhiều ảnh)
            if ($request->hasFile('payment_images')) {
                $paymentImages = [];
                foreach ($request->file('payment_images') as $file) {
                    $imageName = $file->hashName();
                    $res = $file->storeAs('footer', $imageName, 'public');
                    if ($res) {
                        $paymentImages[] = 'footer/' . $imageName;
                    }
                }
                // Lấy danh sách ảnh cũ và merge với ảnh mới
                $oldImages = json_decode($footerSettings->payment_images ?? '[]', true);
                $data['payment_images'] = json_encode(array_merge($oldImages, $paymentImages));
            } else {
                unset($data['payment_images']);
            }

            $footerSettings->update($data);
            DB::commit();

            return redirect()->route('footer.index')->with('success', 'Cập nhật cài đặt footer thành công!');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function removePaymentImage(Request $request)
    {
        $request->validate([
            'image' => 'required|string'
        ]);

        try {
            $footerSettings = FooterSettings::getSettings();
            $paymentImages = json_decode($footerSettings->payment_images ?? '[]', true);
            
            // Xóa file
            $imagePath = $request->input('image');
            if (file_exists(public_path('storage/' . $imagePath))) {
                unlink(public_path('storage/' . $imagePath));
            }
            
            // Xóa khỏi array
            $paymentImages = array_filter($paymentImages, function($img) use ($imagePath) {
                return $img !== $imagePath;
            });
            
            $footerSettings->payment_images = json_encode(array_values($paymentImages));
            $footerSettings->save();
            
            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}



