<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', 'max:255'],
            'width' => ['required', 'integer', 'min:1'],
            'height' => ['required', 'integer', 'min:1'],
            'effect' => ['required', 'in:slide,fade,flip,cube,coverflow,creative'],
            'slides_per_view' => ['required', 'numeric', 'min:1'],
            'space_between' => ['required', 'numeric', 'min:0'],
            'loop' => ['nullable'],
            'autoplay' => ['nullable'],
            'pagination' => ['nullable'],
            'navigation' => ['nullable'],
            'autoplay_delay' => ['required', 'integer', 'min:0'],

            // Validate items là array
            'items' => ['required', 'array', 'min:1'],

            // Validate từng phần tử trong items
            'items.*.image' => ['required', 'url'],
            'items.*.alt' => ['nullable', 'string', 'max:255'],
            'items.*.url' => ['nullable', 'url'],
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
            'width' => 'Chiều rộng',
            'height' => 'Chiều cao',
            'effect' => 'Hiệu ứng',
            'slides_per_view' => 'Số slide hiển thị',
            'space_between' => 'Khoảng cách giữa các slide',
            'loop' => 'Lặp lại',
            'autoplay' => 'Tự động chạy',
            'pagination' => 'Phân trang',
            'navigation' => 'Nút điều hướng',
            'autoplay_delay' => 'Thời gian chờ tự động chạy',
            'items' => 'Danh sách slide',
            'items.*.image' => 'Ảnh slide',
            'items.*.alt' => 'Mô tả ảnh',
            'items.*.url' => 'Liên kết chuyển hướng',
        ];
    }
}
