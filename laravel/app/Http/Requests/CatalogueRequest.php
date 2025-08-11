<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogueRequest extends FormRequest
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
        $id = $this->route('catalogue')->id ?? null;

        return [
            'name'              => "required|string|max:250|unique:catalogues,name,{$id}",
            'slug'              => "nullable|string|max:250|unique:catalogues,slug,{$id}",
            'published'         => 'required|in:0,1',
            'is_slider'         => 'nullable',
            'slider_title'      => 'nullable|string|max:100',
            'position'          => 'required|numeric|min:0',
            'meta_title'        => 'nullable|string|max:250',
            'meta_description'  => 'nullable|string|max:400'
        ];
    }

    public function messages()
    {
        return __('request.messages');
    }

    public function attributes(): array
    {
        return [
            'name'              => 'Tên danh mục',
            'slug'              => 'Slug',
            'published'         => 'Trạng thái',
            'position'          => 'Thứ tự hiển thị',
            'meta_title'        => 'Tiêu đề SEO',
            'meta_description'  => 'Mô tả SEOF'
        ];
    }
}
