<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|string|email|max:255|exists:users,email',
                'password' => 'required|string|max:200',
            ],
            __('request.messages'),
            [
                'email' => 'Email',
                'password' => 'Mật khẩu',
            ]
        );

        return transaction(function () use ($credentials, $request) {
            $remember = $request->filled('remember');

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return successResponse('Đăng nhập thành công.');
            }

            return errorResponse('Mật khẩu không chính xác!', Response::HTTP_UNPROCESSABLE_ENTITY);
        });
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        session()->flash('success', 'Đăng xuất thành công.');
        return redirect()->route('admin.login');
    }
}
