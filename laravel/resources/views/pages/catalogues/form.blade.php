@extends('app')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb :breadcrumbs="[['label' => 'danh mục', 'url' => '/admin/catalogues'], ['label' => $title]]" />

        <form id="myForm">
            @csrf

            @if ($catalogue)
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-md-12">
                                    <div class="position-relative">
                                        <x-input label="Tên danh mục" value="{{ optional($catalogue)->name }}" name="name"
                                            required />
                                    </div>
                                </div>

                                <div class="col-md-12 ">
                                    <div class="position-relative">
                                        <x-input label="Slug" value="{{ optional($catalogue)->slug }}" name="slug"
                                            tooltip="Nếu không nhập sẽ tự động lấy theo tên danh mục" />
                                    </div>
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
                                        $date = $catalogue?->created_at ?? now();
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
                                <x-input name="meta_title" value="{{ optional($catalogue)->meta_title }}"
                                    label="Tiêu đề SEO" />
                            </div>

                            <div class="mb-3 position-relative">
                                <x-textarea name="meta_description" value="{{ optional($catalogue)->meta_description }}"
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
                        <x-select value="{{ optional($catalogue)->published ?? 1 }}" name="published" :options="['1' => 'Hoạt động', '0' => 'Ngưng hoạt động']"
                            placeholder="trạng thái" />
                    </x-card>

                    <x-card title="Thứ tự hiển thị">
                        <x-input name="position" type="number" value="{{ optional($catalogue)->position ?? 1 }}"
                            placeholder="thứ tự" />
                    </x-card>

                    <x-card title="Tiêu đề slider">
                        <x-input name="slider_title" value="{{ optional($catalogue)->slider_title }}" placeholder="tiêu đề slider"/>
                    </x-card>

                    <x-card title="Dùng làm slider?">
                        <x-switch-checkbox name="is_slider" :checked="optional($catalogue)->is_slider ?? false" />
                    </x-card>

                </div>
            </div>

        </form>

    </div>
@endsection


@push('script')
    <script>
        $(function() {

            submitForm('#myForm', function(res, form, submitAction) {
                const isCreating = @json(!$catalogue);

                if (submitAction === 'save') {
                    if (isCreating) {
                        form.trigger('reset');
                        updateSeoPreview();
                    }
                    datgin.success(res.message)
                    return;
                }

                window.location.href = '/admin/catalogues';
            });

            updateCharCount('#name', 200)
            updateCharCount('#slug', 200)
            updateCharCount('#meta_title', 200)
            updateCharCount('#meta_description', 400)

            let slugInputTimer;
            $('#slug').on('input', function() {
                clearTimeout(slugInputTimer);

                const self = this;
                slugInputTimer = setTimeout(function() {
                    const slug = generateSlug(self);
                    $(self).val(slug);
                }, 200);
            });

            function updateSeoPreview() {
                const title = $('#meta_title').val().trim() || $('#name').val().trim();
                const slug = $('#slug').val().trim();
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


            // Sự kiện input cho các trường liên quan
            $('#meta_title, #meta_description, #slug, #name').on('input', function() {
                updateSeoPreview();
            });

            updateSeoPreview();
        })
    </script>
@endpush
