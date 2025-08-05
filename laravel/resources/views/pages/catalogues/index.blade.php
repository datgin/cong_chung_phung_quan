@extends('app')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb :breadcrumbs="[['label' => 'danh mục']]" />

        <x-page-header title="Danh sách danh mục">
            <a href="/admin/catalogues/create" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> TẠO MỚI DANH MỤC
            </a>
        </x-page-header>

        <x-table fileName="catalogue" />
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            const api = "/admin/catalogues"
            dataTables(api)

            initBulkAction('Catalogue')

            handleDestroy('Catalogue')
        })
    </script>
@endpush
