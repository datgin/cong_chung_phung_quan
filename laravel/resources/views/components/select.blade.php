@if ($label)
    <label for="{{ $id }}" class="form-label fw-medium {{ $required ? 'required' : '' }}">
        {{ $label }}
    </label>
@endif

<select name="{{ $multiple ? "{$name}[]" : $name }}" id="{{ $id ?? $name }}" class="form-control"
    {{ $multiple ? 'multiple' : '' }}>
    @unless ($multiple)
        <option value="">-- Chọn {{ strtolower($placeholder ?? $label) }} --</option>
    @endunless
    @foreach ($options as $key => $text)
        <option value="{{ $key }}"
            @if ($multiple && is_array($value) && in_array($key, $value)) selected
            @elseif (!$multiple && $value == $key) selected @endif>
            {{ $text }}
        </option>
    @endforeach
</select>

<small class="text-danger error-message {{ $name }}"></small>

@push('script')
    <script>
        $(function() {
            const $element = $('#{{ $id }}');
            if ($element.length) {
                new Choices($element[0], {
                    removeItemButton: {{ $multiple ? 'true' : 'false' }},
                    placeholder: true,
                    placeholderValue: 'Chọn {{ strtolower($placeholder ?? $label) }}',
                    shouldSort: false,
                    searchEnabled: true,
                    itemSelectText: ''
                });
            }
        });
    </script>
@endpush
