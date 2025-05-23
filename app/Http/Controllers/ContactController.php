<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;

class ContactController extends Controller
{
    // Hiển thị form liên hệ
    public function showForm()
    {
        return view('contact');
    }

    // Xử lý gửi form
    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Lưu dữ liệu liên hệ
        ContactMessage::create($data);

        // Gửi mail đến admin (ví dụ gửi tới MAIL_FROM_ADDRESS)
        FacadesMail::to(config('mail.from.address'))->send(new ContactMail($data));

        return redirect()->back()->with('success', 'Gửi liên hệ thành công!');
    }
}
