<div class="form-group d-flex flex-column mb-4">
    @if($label ?? false)
        <label for="{{ $name }}" class="" style="font-size: 15px">
            {{ $label }}
            @if($required ?? false)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    
    <select
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        class="form-select {{ $errors->has($name) ? 'is-invalid' : '' }}"
        {{ $attributes }}
    >
        {{ $slot }}
    </select>
    
    @error($name)
        <span class="text-danger text-xs">{{ $message }}</span>
    @enderror
</div>
