@extends('app')

@section('content')
    <div class="container-xxl">
        <x-breadcrumb :breadcrumbs="[['label' => 'cấu hình chung']]" />

        <form id="myForm">
            <div class="row">
                <div class="col-md-9">
                    <x-card>
                        <div class="row gy-3">
                            <div class="col-md-12">
                                <div class="position-relative">
                                    <x-input label="Tiêu đề website" value="{{ $setting->title }}" name="title" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="position-relative">
                                    <x-input label="Tên công ty" value="{{ $setting->company }}" name="company" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative">
                                    <x-input label="Email" value="{{ $setting->email }}" name="email" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative">
                                    <x-input type="number" label="Đường dây nóng" value="{{ $setting->hotline }}"
                                        name="hotline" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="position-relative">
                                    <x-input label="Địa chỉ" value="{{ $setting->address }}" name="address" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="position-relative">
                                    <x-input label="Bản quyền website" value="{{ $setting->copyright }}" name="copyright" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="position-relative">
                                    <x-input label="Thời gian làm việc" value="{{ $setting->working_time }}"
                                        name="working_time" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="position-relative">
                                    <x-textarea label="Bản đồ" :value="$setting->map" name="map" rows="4" />
                                </div>
                            </div>
                        </div>
                    </x-card>

                    <x-card title="Liên kết & Mạng xã hội">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <div class="position-relative">
                                    <x-input label="Số điện thoai Zalo" value="{{ $setting->url_zalo }}" name="url_zalo" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative">
                                    <x-input label="Messenger URL" value="{{ $setting->url_messenger }}"
                                        name="url_messenger" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative">
                                    <x-input label="Facebook URL" value="{{ $setting->url_facebook }}"
                                        name="url_facebook" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative">
                                    <x-input label="Twitter URL" value="{{ $setting->url_twitter }}" name="url_twitter" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative">
                                    <x-input label="Youtube URL" value="{{ $setting->url_youtobe }}" name="url_youtobe" />
                                </div>
                            </div>
                        </div>
                    </x-card>

                    <x-card title="Chèn mã script">
                        <div class="mb-3 position-relative">
                            <x-textarea name="script_head" value="{{ $setting->script_head }}" label="Mã trong thẻ <head>"
                                rows="4" />
                        </div>

                        <div class="mb-3 position-relative">
                            <x-textarea name="script_body" value="{{ $setting->script_body }}" label="Mã ngay sau <body>"
                                rows="4" />
                        </div>

                        <div class="mb-3 position-relative">
                            <x-textarea name="script_footer" value="{{ $setting->script_footer }}" label="Mã trước </body>"
                                rows="4" />
                        </div>
                    </x-card>


                    <x-card title="Tối ưu hóa công cụ tìm kiếm">
                        <div class="seo-preview" v-pre="">
                            <p class="default-seo-description">
                                Thiết lập tiêu đề và mô tả meta để trang web của bạn dễ dàng được phát hiện trên
                                các công cụ tìm kiếm như Google
                            </p>

                            <div class="existed-seo-meta d-none">

                                <h4 class="page-title-seo text-truncate">
                                    -
                                </h4>

                                <div class="page-url-seo">
                                    <p>-</p>
                                </div>

                                <div>
                                    @php
                                        $date = now();
                                    @endphp

                                    <span style="color: #70757a;">
                                        {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}
                                    </span>
                                    -
                                    <span class="page-description-seo"></span>

                                </div>
                            </div>
                        </div>

                        <div class="seo-edit-section">
                            <hr class="my-3">

                            <div class="mb-3 position-relative">
                                <x-input name="meta_title" value="" label="Tiêu đề SEO" />
                            </div>

                            <div class="mb-3 position-relative">
                                <x-textarea name="meta_description" value="" label="Mô tả SEO" />
                            </div>
                        </div>
                    </x-card>
                </div>

                <div class="col-md-3">

                    <x-card title="Xuất bản">
                        <x-submit />
                    </x-card>

                    <x-card title="Logo">
                        <x-media name="logo" :selected="showImage(absoluteUrl: $setting->logo, isEmptyPath: true)" />
                    </x-card>

                    <x-card title="Favicon">
                        <x-media name="favicon" :selected="showImage(absoluteUrl: $setting->favicon, isEmptyPath: true)" />
                    </x-card>

                    <x-card title="Banner">
                        <x-media name="banner" :selected="showImage(absoluteUrl: $setting->banner, isEmptyPath: true)" />
                        <x-input class="my-2" :value="$setting->alt_banner" name="alt_banner"
                            placeholder="Mô tả ngắn cho hình ảnh (alt)" />
                        <x-input name="link_banner" :value="$setting->link_banner" placeholder="Nhập đường dẫn chuyển hướng" />
                    </x-card>

                </div>
            </div>
        </form>
    </div>
    <x-media-popup />
@endsection


@push('script')
    <script src="{{ asset('global/js/media.js') }}"></script>

    <script>
        $(function() {

            const elements = [{
                    id: '#title',
                    maxLenght: 200
                },
                {
                    id: '#company',
                    maxLenght: 200
                },
                {
                    id: '#email',
                    maxLenght: 200
                },
                {
                    id: '#hotline',
                    maxLenght: 20
                },
                {
                    id: '#address',
                    maxLenght: 250
                },
                {
                    id: '#copyright',
                    maxLenght: 250
                },
                {
                    id: '#url_zalo',
                    maxLenght: 200
                },
                {
                    id: '#url_messenger',
                    maxLenght: 200
                },
                {
                    id: '#url_facebook',
                    maxLenght: 200
                },
                {
                    id: '#url_twitter',
                    maxLenght: 200
                },
                {
                    id: '#url_youtobe',
                    maxLenght: 200
                },
                {
                    id: '#meta_title',
                    maxLenght: 250
                },
                {
                    id: '#meta_description',
                    maxLenght: 250
                }
            ]

            elements.forEach(function(item) {
                updateCharCount(item.id, item.maxLenght)
            })

            submitForm('#myForm', function(res, form, submitAction) {

                if (submitAction === 'save') {
                    datgin.success(res.message)
                    return;
                }

                window.location.href = '/admin';
            });

        })
    </script>
@endpush
