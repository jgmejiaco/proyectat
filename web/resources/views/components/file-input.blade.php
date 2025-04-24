<!-- resources/views/components/file-input.blade.php -->
@props([
    'name',
    'label' => '',
    'id' => $name,
    'value' => null,
    'link' => null,
    'required' => false,
])

<div class="form-group d-flex flex-column file-container">
    @if ($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif

    <div class="div-file">
        <input
            type="file"
            name="{{ $name }}"
            id="{{ $id }}"
            class="form-control file"
            onchange="displaySelectedFile('{{ $id }}', 'selected_{{ $id }}')"
            {{ $required ? 'required' : '' }}
        >
    </div>

    @if ($link)
        <a href="{{ $link }}" target="_blank" class="text-primary text-decoration-none mt-1">Ver archivo</a>
    @endif

    <span id="selected_{{ $id }}" class="text-danger hidden mt-1"></span>
</div>
