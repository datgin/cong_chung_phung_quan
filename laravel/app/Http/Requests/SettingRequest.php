<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title'            => 'nullable|string|max:255',
            'company'          => 'nullable|string|max:255',
            'email'            => 'nullable|email|max:255',
            'hotline' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^(\+84|0)[1-9][0-9]{8}$/'
            ],
            'address'          => 'nullable|string|max:500',

            'url_zalo' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^(\+84|0)[1-9][0-9]{8}$/',
            ],

            'url_messenger'    => 'nullable|url|max:255',
            'url_facebook'     => 'nullable|url|max:255',
            'url_twitter'      => 'nullable|url|max:255',
            'url_youtobe'      => 'nullable|url|max:255',

            'map'              => 'nullable|string',
            'banner'           => 'nullable|string|max:255',
            'alt_banner'       => 'nullable|string|max:255',
            'link_banner'      => 'nullable|url',
            'logo'             => 'nullable|string|max:255',
            'favicon'          => 'nullable|string|max:255',

            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',

            'copyright'        => 'nullable|string|max:500',

            'script_head'      => 'nullable|string',
            'script_body'      => 'nullable|string',
            'script_footer'    => 'nullable|string',
        ];
    }

    public function messages()
    {
        return __('request.messages');
    }

    public function attributes(): array
    {
        return [
            'title'            => 'tiêu đề website',
            'company'          => 'tên công ty',
            'email'            => 'email',
            'hotline'          => 'đường dây nóng',
            'address'          => 'địa chỉ',

            'url_zalo'         => 'liên kết Zalo',
            'url_messenger'    => 'liên kết Messenger',
            'url_facebook'     => 'liên kết Facebook',
            'url_twitter'      => 'liên kết Twitter',
            'url_youtobe'      => 'liên kết Youtube',

            'map'              => 'bản đồ',
            'banner'           => 'ảnh banner',
            'logo'             => 'logo',
            'favicon'          => 'favicon',

            'meta_title'       => 'tiêu đề SEO',
            'meta_description' => 'mô tả SEO',

            'copyright'        => 'bản quyền website',

            'script_head'      => 'mã script trong thẻ head',
            'script_body'      => 'mã script sau thẻ body',
            'script_footer'    => 'mã script trước thẻ đóng body',
        ];
    }
}
