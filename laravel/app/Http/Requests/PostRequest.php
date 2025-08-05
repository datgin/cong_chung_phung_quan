<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $id = $this->route('post')->id ?? null;

        return [
            'title' => "required|string|max:255|unique:posts,title,{$id}",
            'catalogue_id' => 'nullable|exists:catalogues,id',
            'excerpt' => 'nullable|string|max:400',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:250',
            'meta_description' => 'nullable|string|max:400',
            'published' => 'required|in:0,1',
            'published_at' => 'nullable|date_format:d/m/Y H:i|after_or_equal:today',
            'thumbnail' => 'required|string|url',
        ];
    }

    public function messages()
    {
        return __('request.messages');
    }

    public function attributes(): array
    {
        return [
            'title' => 'tiêu đề',
            'excerpt' => 'mô tả ngắn',
            'content' => 'nội dung',
            'meta_title' => 'meta title',
            'meta_description' => 'meta description',
            'published' => 'trạng thái hiển thị',
            'published_at' => 'thời gian xuất bản',
            'thumbnail' => 'ảnh đại diện',
        ];
    }
}
