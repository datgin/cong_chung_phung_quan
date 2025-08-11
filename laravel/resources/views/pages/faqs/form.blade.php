@extends('app')

@section('content')
    <div class="container-xxl">
        <x-breadcrumb :breadcrumbs="[['label' => 'văn bản pháp luật', 'url' => '/admin/faqs'], ['label' => $title]]" />

        <form id="myForm">
            @csrf

            @if ($faq)
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-md-12">
                                    <div class="position-relative">
                                        <x-input label="Tiêu đề bài biết" value="{{ optional($faq)->title }}" name="title"
                                            required />
                                    </div>
                                    <small class="mt-1">
                                        Liên kết tĩnh:
                                    </small>
                                    <span id="staticLink" class="text-primary fst-italic text-decoration-underline">
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <div class="position-relative">
                                        <x-textarea label="Mô tả ngắn" value="{{ optional($faq)->excerpt }}" name="excerpt"
                                            rows="4" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="content" class="form-label fw-medium">Nội dung</label>
                                    <textarea name="content" class="ckeditor" id="content">{!! optional($faq)->content !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                        $date = optional($faq)->created_at ?? now();
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
                                <x-input name="meta_title" value="{{ optional($faq)->meta_title }}" label="Tiêu đề SEO" />
                            </div>

                            <div class="mb-3 position-relative">
                                <x-textarea name="meta_description" value="{{ optional($faq)->meta_description }}"
                                    label="Mô tả SEO" />
                            </div>
                        </div>
                    </x-card>
                </div>

                <div class="col-md-3">

                    <x-card title="Xuất bản">
                        <x-submit />
                    </x-card>

                    <x-card title="Trạng thái">
                        <x-select :value="optional($faq)->published ?? 1" name="published" :options="['1' => 'Hoạt động', '0' => 'Ngưng hoạt động']" placeholder="trạng thái" />
                    </x-card>

                    <x-card title="Ảnh đại diện">
                        <x-media name="thumbnail" :selected="optional($faq)->thumbnail" />
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

            $('input[name="title"]').on('input', function() {
                const appUrl = "{{ config('app.url') }}/cau-hoi-thuong-gap";
                const slug = generateSlug($(this));
                $('#staticLink').text(`${appUrl}/${slug}`);
            }).trigger('input');

            updateCharCount('#title', 200)
            updateCharCount('#excerpt', 400)
            updateCharCount('#meta_title', 200)
            updateCharCount('#meta_description', 400)

            function updateSeoPreview() {
                const title = $('#meta_title').val().trim() || $('#title').val().trim();
                const slug = generateSlug($('#title'));
                const description = $('#meta_description').val().trim();

                // Nếu tất cả đều trống → quay về chế độ mặc định
                if (!title && !slug && !description) {
                    $('.default-seo-description').removeClass('d-none');
                    $('.existed-seo-meta').addClass('d-none');
                    return;
                }

                // Ngược lại: có nội dung
                $('.default-seo-description').addClass('d-none');
                $('.existed-seo-meta').removeClass('d-none');

                const fullUrl = slug ? `${window.location.origin}/${slug}` : '-';

                $('.page-title-seo').text(title || '-');
                $('.page-url-seo p').text(fullUrl);
                $('.page-description-seo').text(description);
            }

            submitForm('#myForm', function(res, form, submitAction) {
                const isCreating = @json(!$faq);

                if (submitAction === 'save') {
                    if (isCreating) {
                        form.trigger('reset');
                        $('input[name="title"]').trigger('input');
                        CKEDITOR.instances['content'].setData('');
                        updateSeoPreview();
                    }
                    datgin.success(res.message)
                    return;
                }

                window.location.href = '/admin/faqs';
            });


            // Sự kiện input cho các trường liên quan
            $('#meta_title, #meta_description, #title').on('input', function() {
                updateSeoPreview();
            });

            updateSeoPreview();
        })
    </script>
@endpush
