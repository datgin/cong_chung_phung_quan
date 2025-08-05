@isset($urlEdit)
    <a class="btn btn-primary btn-sm btn-edit" data-id="{{ $row->id }}" href="{{ $urlEdit }}">
        <i class="fas fa-edit"></i>
    </a>
@endisset

@isset($urlDelete)
    <a class="btn btn-sm btn-danger btn-delete" data-id="{{ $row->id }}">
        <i class="fas fa-trash"></i>
    </a>
@endisset
