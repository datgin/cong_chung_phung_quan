<?php

namespace App\Http\Controllers;

use App\Models\Introduction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IntroductionController extends Controller
{
    public function form()
    {
        $introduction = Introduction::first();
        return view('pages.introductions.form', compact('introduction'));
    }

    public function save(Request $request)
    {
        $credentials = $this->validateRequest($request);

        return transaction(function () use ($credentials, $request) {

            $credentials['slug'] = Str::slug($credentials['title']);

            $introduction = Introduction::firstOrCreate([]);
            $introduction->update($credentials);

            return successResponse("Lưu thay đổi thành công.", isToastr: $request->input('submit_action') === 'save_exit');
        });
    }

    public function validateRequest($request)
    {
        return $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'nullable',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:400',
        ], __('request.messages'), [
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
            'meta_title' => 'Tiêu đề SEO',
            'meta_description' => 'Mô tả SEO',
        ]);
    }
}
