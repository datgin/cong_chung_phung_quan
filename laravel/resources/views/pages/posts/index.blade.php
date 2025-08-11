@extends('app')

@section('content')
    <div class="container-xxl">
        <x-breadcrumb :breadcrumbs="[['label' => 'bài viết']]" />

        <x-page-header title="Danh sách bài viết">
            <a href="/admin/posts/create" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> TẠO MỚI BÀI VIẾT
            </a>
        </x-page-header>

        <x-table fileName="post" />
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            const api = "/admin/posts"
            dataTables(api)

            initBulkAction('Post')

            handleDestroy('Post')
        })
    </script>
@endpush
