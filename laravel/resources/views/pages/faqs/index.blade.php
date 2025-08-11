@extends('app')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb :breadcrumbs="[['label' => 'câu hỏi thường gặp']]" />

        <x-page-header title="Danh sách câu hỏi thường gặp">
            <a href="/admin/faqs/create" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> THÊM MỚI CÂU HỎI
            </a>
        </x-page-header>

        <x-table fileName="faq" />
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            const api = "/admin/faqs"
            dataTables(api)

            initBulkAction('Faq')

            handleDestroy('Faq')
        })
    </script>
@endpush
