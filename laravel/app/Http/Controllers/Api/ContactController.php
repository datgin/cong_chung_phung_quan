<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactSubmitted;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|max:250',
            'phone' => [
                'required',
                'regex:/^(0|\+84)(\d{9})$/'
            ],
            'email' => "required|email|max:250",
            'message' => 'nullable'
        ]);

        return transaction(function () use ($credentials, $request) {

            $ip = $request->ip();

            $recentContact = Contact::where('ip_address', $ip)
                ->where('created_at', '>=', now()->subMinutes(5))
                ->first();

            if ($recentContact) {
                return errorResponse('Bạn chỉ có thể gửi liên hệ lại sau 5 phút!', 429);
            }

            $credentials['ip_address'] = $ip;

            Contact::create($credentials);

            Mail::to(config('mail.contact'))
                ->queue(new ContactSubmitted($credentials));

            return successResponse(message: "Gửi yêu cầu thông công. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.", data: $credentials);
        });
    }
}
