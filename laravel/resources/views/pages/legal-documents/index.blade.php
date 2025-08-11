@extends('app')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb :breadcrumbs="[['label' => 'văn bản pháp luật']]" />

        <x-page-header title="Danh sách văn bản pháp luật">
            <a href="/admin/legal-documents/create" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> TẠO MỚI
            </a>
        </x-page-header>

        <x-table fileName="legal-document" />
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            const api = "/admin/legal-documents"
            dataTables(api)

            initBulkAction('LegalDocument')

            handleDestroy('LegalDocument')
        })
    </script>
@endpush
