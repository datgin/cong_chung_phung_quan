@extends('app')

@section('content')
    <div class="container-xxl">

        <x-breadcrumb :breadcrumbs="[['label' => 'câu hỏi thường gặp']]" />

        <x-page-header title="Danh sách câu hỏi thường gặp">
            <input type="email" id="mail_contact_receiver" name="mail_contact_receiver" value="{{ config('mail.contact') }}"
                class="form-control" style="width: 250px" required>
        </x-page-header>

        <x-table fileName="contact" />
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            const api = "/admin/contacts"
            dataTables(api, {
                isOperation: false,
                hasDateRange: true,
                hasCheckbox: false
            })

            $(document).on('keydown', '#mail_contact_receiver', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();

                    let email = $(this).val().trim();
                    if (!email) {
                        datgin.error("Vui lòng nhập Email!")
                        return;
                    }

                    $.ajax({
                        url: '/admin/contacts/update-mail-contact',
                        method: 'POST',
                        data: {
                            MAIL_CONTACT_RECEIVER: email,
                        },
                        success: function(res) {
                            datgin.success('Cập nhật thành công')
                        },
                        error: function(xhr) {
                            datgin.error('Có lỗi xảy ra khi cập nhật')
                        }
                    });
                }
            });
        })
    </script>
@endpush
