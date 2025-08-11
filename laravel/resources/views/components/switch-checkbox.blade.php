@props(['checked' => $checked, 'id' => $id])

<label class="switch" data-id="{{ $id }}">
    <input name="{{ $name }}" type="checkbox" value="1" @checked($checked)>
    <span class="slider round"></span>
</label>
