<!-- resources/views/components/input.blade.php -->
<div class="mb-4">
    {{-- Sección del Label (idéntica a la de x-select) --}}
    @if($label ?? false)
        <label for="{{ $id ?? $name }}" class="block text-gray-700 text-sm font-medium mb-1">
            {{ $label }}
            @if($required ?? false)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    {{-- Input (tu código actual) --}}
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        class="form-control {{ $errors->has($name) ? 'border-red-500' : '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        value="{{ old($name, $value ?? '') }}"
        @if($autocomplete ?? false)
            autocomplete="{{ $autocomplete }}" {{-- // NOSONAR --}}
        @endif
        @if($required ?? false) required @endif
        {{ $attributes }}
    >

    {{-- Mensaje de error --}}
    @error($name)
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>
