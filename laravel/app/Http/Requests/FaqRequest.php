<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('faq')->id ?? null;

        return [
            'title' => "required|max:250|unique:faqs,title,{$id}",
            'excerpt' => 'nullable|max:400',
            'content' => 'required',
            'thumbnail' => 'nullable|url',
            'meta_title' => 'nullable|max:250',
            'meta_description' => 'nullable|max:400',
            'published' => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return __('request.messages');
    }

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'excerpt' => 'Tóm tắt',
            'content' => 'Nội dung',
            'thumbnail' => 'Ảnh đại diện',
            'meta_title' => 'Tiêu đề meta',
            'meta_description' => 'Mô tả meta',
            'published' => 'Trạng thái đăng'
        ];
    }
}
