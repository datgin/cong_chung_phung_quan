@if ($label)
    <label for="{{ $id }}" class="form-label fw-medium {{ $required ? 'required' : '' }}">
        {{ $label }}
    </label>
@endif

<input type="text" name="{{ $name }}" id="{{ $id }}" class="form-control" value="{{ $value }}"
    placeholder="Chọn {{ strtolower($placeholder ?? $label) }}" autocomplete="off">

<small class="text-danger error-message {{ $name }}"></small>

@push('script')
    <script>
        $(function() {
            const isSingle = @json($single);
            const withTime = @json($withTime);
            const input = $('#{{ $id }}');

            input.daterangepicker({
                singleDatePicker: isSingle,
                timePicker: withTime,
                timePicker24Hour: withTime,
                timePickerIncrement: 5,
                autoUpdateInput: false,
                locale: {
                    format: withTime ? 'DD/MM/YYYY HH:mm' : 'DD/MM/YYYY',
                    cancelLabel: 'Hủy',
                    applyLabel: 'Áp dụng',
                    customRangeLabel: 'Tùy chọn',
                    daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    monthNames: [
                        'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                        'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ],
                    firstDay: 1
                }
            });

            input.on('apply.daterangepicker', function(ev, picker) {
                const format = withTime ? 'DD/MM/YYYY HH:mm' : 'DD/MM/YYYY';

                if (isSingle) {
                    $(this)
                        .val(picker.startDate.format(format))
                        .trigger('input');
                } else {
                    $(this)
                        .val(
                            picker.startDate.format(format) + ' - ' + picker.endDate.format(format)
                        )
                        .trigger('input');
                }
            });

            input.on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('').trigger('input');
            });
        });
    </script>
@endpush
