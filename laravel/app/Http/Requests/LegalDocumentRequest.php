<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LegalDocumentRequest extends FormRequest
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
        $id = $this->route('legalDocument')->id ?? null;

        return [
            'title' => "required|max:250|unique:legal_documents,title,{$id}",
            'content' => 'nullable',
            'meta_title' => 'nullable|string|max:250',
            'meta_description' => 'nullable|string|max:400',
            'file' => ($id ? 'nullable' : 'required') . '|file|max:10240',
            'published' => 'required|in:0,1',
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
            'content' => 'Nội dung',
            'meta_title' => 'Thẻ tiêu đề (meta title)',
            'meta_description' => 'Thẻ mô tả (meta description)',
            'file' => 'Tài liệu đính kèm',
            'published' => 'Trạng thái',
        ];
    }
}
