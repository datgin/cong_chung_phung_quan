@if ($label)
    <label for="{{ $id }}" class="form-label fw-semibold {{ $required ? 'required' : '' }}">
        {{ $label }}
    </label>

    @if ($tooltip)
        <i class="fa-solid fa-circle-info ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-title="{{ $tooltip }}"></i>
    @endif

@endif

@if ($type === 'password')
    <div class="position-relative">
@endif

<input type="{{ $type }}" id="{{ $id ?? $name }}" name="{{ $name }}"
    class="form-control {{ $class }}" placeholder="Nhập {{ strtolower($placeholder ?? $label) }}"
    value="{{ $value }}" @disabled($disabled)>

@if ($type === 'password')
    <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3" toggle="#password"
        style="cursor: pointer;">
        <i class="far fa-eye"></i>
    </span>
    </div>
@endif

<small class="text-danger error-message {{ $name }}"></small>
