<!-- resources/views/components/date-input.blade.php -->
@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => null,
    'required' => false,
    'placeholder' => '',
    'icon' => 'fa-calendar-days',
    'addonClass' => '',
    'wrapperClass' => '',
    'minDate' => null,
    'maxDate' => null,
])

<div class="form-group {{ $wrapperClass }}">
    @if($label)
        <label for="{{ $id ?? $name }}" class="form-label" style="font-size: 15px">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <div class="input-group" id="calendar_{{ $id ?? $name }}" style="cursor: pointer;">
        <input
            type="date"
            name="{{ $name }}"
            id="{{ $id ?? $name }}"
            class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }} {{ $attributes->get('class') }}"
            value="{{ old($name, $value ?? '') }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
            @if($minDate) min="{{ $minDate }}" @endif
            @if($maxDate) max="{{ $maxDate }}" @endif
            {{ $attributes->except(['class', 'type']) }}
        >
        <span class="input-group-text {{ $addonClass }}">
            <i class="fa {{ $icon }}"></i>
        </span>
    </div>

    @error($name)
        <span class="invalid-feedback d-block text-xs">{{ $message }}</span>
    @enderror
</div>
