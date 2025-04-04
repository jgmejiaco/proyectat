<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    class="form-control {{ $errors->has($name) ? 'border-red-500' : '' }}"
    placeholder="{{ $placeholder ?? '' }}"
    value="{{ old($name, $value ?? '') }}"
    @if($autocomplete ?? false)
        autocomplete="{{ $autocomplete }}" {{-- // NOSONAR: Valor WCAG válido --}}
    @endif
    {{ $attributes }}
>
