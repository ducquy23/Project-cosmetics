<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSettings;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $contactSettings = ContactSettings::getSettings();
        return view('admin.contact.index', compact('contactSettings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'emails' => 'nullable|string',
            'address' => 'nullable|string',
            'hotlines' => 'nullable|string',
            'map_iframe' => 'nullable|string',
            'intro_text' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $contactSettings = ContactSettings::getSettings();
            $contactSettings->update($data);
            DB::commit();

            return redirect()->route('contact.index')->with('success', 'Cập nhật cài đặt liên hệ thành công!');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function messages()
    {
        $messages = ContactMessage::orderByDesc('created_at')->paginate(15);
        return view('admin.contact.messages', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        // Đánh dấu là đã đọc nếu chưa đọc
        if ($message->status === 'new') {
            $message->update(['status' => 'read']);
        }
        return view('admin.contact.show', compact('message'));
    }

    public function updateStatus(ContactMessage $message, Request $request)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied'
        ]);

        $message->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('contact.messages')->with('success', 'Xóa tin nhắn thành công!');
    }
}

