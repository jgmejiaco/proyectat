<!-- resources/views/components/input.blade.php -->
<div class="form-group">
    @if($label ?? false)
        <label for="{{ $id ?? $name }}" class="form-label" style="font-size: 15px">
            {{ $label }}
            @if($required ?? false)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        value="{{ old($name, $value ?? '') }}"
        @if($autocomplete ?? false)
            autocomplete="{{ $autocomplete }}"
        @endif
        @if($required ?? false) required @endif
        {{ $attributes }}
    >

    @error($name)
        <span class="invalid-feedback d-block text-xs">{{ $message }}</span>
    @enderror
</div>
