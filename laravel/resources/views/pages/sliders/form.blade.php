@extends('app')

@section('content')
    <div class="container-xxl">
        <x-breadcrumb :breadcrumbs="[['label' => 'quản lý slider']]" />

        <form id="myForm">
            @csrf

            <div class="row">
                <div class="col-md-3">
                    <x-card title="Cấu hình cơ bản">
                        <div class="row gy-2">
                            <div class="col-md-12">
                                <x-input name="title" value="{{ optional($slider)->title }}" label="Tên slider" required />
                            </div>

                            <div class="col-md-12">
                                <x-input name="width" label="Chiều rộng (px)" value="{{ optional($slider)->width }}" />
                            </div>

                            <div class="col-md-12">
                                <x-input name="height" label="Chiều cao (px)" value="{{ optional($slider)->height }}" />
                            </div>

                            <div class="col-md-12">
                                <x-select name="effect" :options="[
                                    'fade' => 'Fade',
                                    'cube' => 'Cube',
                                    'coverflow' => 'Coverflow',
                                    'flip' => 'Flip',
                                    'cards' => 'Cards',
                                    'creative' => 'Creative',
                                ]" label="Hiệu ứng"
                                    value="{{ optional($slider)->effect }}" />
                            </div>

                            <div class="col-md-12">
                                <x-input type="number" name="slides_per_view" label="Số slide hiển thị"
                                    value="{{ optional($slider)->slides_per_view ?? 1 }}" />
                            </div>

                            <div class="col-md-12">
                                <x-input type="number" name="space_between" value="{{ optional($slider)->space_between }}"
                                    label="Khoảng cách giữa các slide (px)" value="0" />
                            </div>
                        </div>
                    </x-card>

                    <x-card title="Cấu hình nâng cao">
                        <div class="row gy-2">
                            <div class="col-md-12">
                                <label for="loop" class="form-label fw-semibold me-3">Vòng lặp</label>
                                <x-switch-checkbox name="loop" :checked="optional($slider)->loop" />
                            </div>

                            <div class="col-md-12">
                                <label for="autoplay" class="form-label fw-semibold me-3">Tự động chạy</label>
                                <x-switch-checkbox name="autoplay" :checked="optional($slider)->loop" />
                            </div>

                            <div class="col-md-12">
                                <label for="pagination" class="form-label fw-semibold me-3">Hiển thị nút chuyển
                                    trang</label>
                                <x-switch-checkbox name="pagination" :checked="optional($slider)->loop" />
                            </div>

                            <div class="col-md-12">
                                <label for="navigation" class="form-label fw-semibold me-3">Hiển thị nút điều hướng</label>
                                <x-switch-checkbox name="navigation" :checked="optional($slider)->loop" />
                            </div>

                            <div class="col-md-12">
                                <x-input type="number" name="autoplay_delay" label="Thời gian chờ (ms)" value="3000"
                                    value="{{ optional($slider)->autoplay_delay }}" />
                            </div>
                        </div>
                    </x-card>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 fw-semibold">Danh sách slides</h5>
                                <button id="btn-add-slider" type="button" class="btn btn-sm btn-primary">+ Thêm
                                    slide</button>
                            </div>
                        </div>

                        <div class="card-body list-slider">

                            <!-- Slide item -->
                            @if (!empty($slider) && !empty($slider->items))
                                @foreach ($slider->items as $i => $item)
                                    <div class="border rounded p-3 mb-3 slide-item position-relative">
                                        <div class="d-flex gap-3">
                                            <!-- Ảnh -->
                                            <div class="w-25">
                                                <x-media name="items[{{ $i }}][image]"
                                                    selected="{{ $item['image'] ?? '' }}" />
                                            </div>

                                            <div class="w-75">
                                                <div class="mb-2">
                                                    <x-textarea name="items[{{ $i }}][alt]" label="Mô tả"
                                                        value="{{ $item['alt'] ?? '' }}" />
                                                </div>
                                                <div class="mb-2">
                                                    <x-input name="items[{{ $i }}][url]"
                                                        label="Link chuyển hướng" value="{{ $item['url'] ?? '' }}" />
                                                </div>
                                            </div>

                                            <!-- Nút xóa -->
                                            <div class="position-absolute top-0 end-0">
                                                <button type="button"
                                                    class="btn btn-outline-danger btn-sm btn-remove-slide">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <!--End slide item -->

                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="submit"
                                    class="btn btn-primary btn-sm d-inline-flex align-items-center gap-2">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    <span>Lưu</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <x-media-popup />

    <template id="slide-template">
        <div class="border rounded p-3 mb-3 slide-item position-relative">
            <div class="d-flex gap-3">
                <!-- Ảnh -->
                <div class="w-25">
                    <x-media name="__NAME__[image]" />
                </div>

                <div class="w-75">
                    <div class="mb-2">
                        <x-textarea name="__NAME__[alt]" label="Mô tả" />
                    </div>
                    <div class="mb-2">
                        <x-input name="__NAME__[url]" label="Link chuyển hướng" />
                    </div>
                </div>

                <!-- Nút xóa -->
                <div class="position-absolute top-0 end-0">
                    <button type="button" class="btn btn-outline-danger btn-sm btn-remove-slide">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </template>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script src="{{ asset('global/js/media.js') }}"></script>
    <script>
        $(function() {

            new Sortable(document.querySelector('.list-slider'), {
                animation: 150, // hiệu ứng mượt khi kéo
                handle: '.slide-item', // phần tử được kéo
                onEnd: function() {
                    updateSlideIndexes(); // cập nhật lại name khi sắp xếp xong
                }
            });

            let slideIndex = $('.slide-item').length;

            // Hàm cập nhật lại index cho các slide còn lại
            function updateSlideIndexes() {
                $('.slide-item').each(function(i) {
                    $(this).find('[name]').each(function() {
                        let oldName = $(this).attr('name');
                        let newName = oldName.replace(/items\[\d+\]/, `items[${i}]`);
                        $(this).attr('name', newName);
                    });
                });
                slideIndex = $('.slide-item').length;
            }

            // Hàm thêm slide
            function generateUid(prefix = 'media_') {
                return prefix + Math.random().toString(36).substring(2, 10);
            }

            function addSlide() {
                let template = $('#slide-template').html();
                let newSlideHtml = template.replace(/__NAME__/g, `items[${slideIndex}]`);

                // Tạo map lưu oldUid -> newUid
                let uidMap = {};

                // Bắt tất cả data-uid trước, vì đây là nơi gốc của mỗi media
                newSlideHtml = newSlideHtml.replace(/data-uid="(media_[^"]+)"/g, function(match, oldUid) {
                    let newUid = generateUid();
                    uidMap[oldUid] = newUid;
                    return `data-uid="${newUid}"`;
                });

                // Thay toàn bộ id="oldUid..." và các id khác có cùng prefix
                newSlideHtml = newSlideHtml.replace(/id="(media_[^"]+)"/g, function(match, oldUid) {
                    let baseUid = oldUid.split('_')[0] + '_' + oldUid.split('_')[
                        1]; // lấy phần prefix chuẩn
                    if (uidMap[oldUid]) {
                        return `id="${uidMap[oldUid]}"`;
                    } else {
                        // Nếu chưa có trong map, tìm xem có uid gốc nào chứa trong oldUid
                        for (let original in uidMap) {
                            if (oldUid.startsWith(original)) {
                                return `id="${uidMap[original]}${oldUid.slice(original.length)}"`;
                            }
                        }
                    }
                    return match;
                });

                $('.card-body.list-slider').append(newSlideHtml);
                slideIndex++;
            }

            // Khi click "Thêm slide"
            $('#btn-add-slider').on('click', function() {
                addSlide();
            });

            // Xóa slide (nhưng phải còn ít nhất 1)
            $(document).on('click', '.btn-remove-slide', function() {
                if ($('.slide-item').length > 1) {
                    $(this).closest('.slide-item').remove();
                    updateSlideIndexes();
                } else {
                    datgin.warning('Phải có ít nhất 1 slide.');
                }
            });

            // Khi load trang, nếu chưa có slide thì thêm 1 mặc định
            if ($('.slide-item').length === 0) {
                addSlide();
            }

            submitForm('#myForm', function(res) {
                datgin.success(res.message)
            });
        })
    </script>
@endpush


@push('style')
    <style>
        textarea {
            max-height: 100px;
            overflow-y: auto
        }

        .card-footer {
            border-top: 1px solid var(--bs-card-border-color);
        }

        .slide-item:last-child {
            margin-bottom: 0 !important;
        }
    </style>
@endpush
