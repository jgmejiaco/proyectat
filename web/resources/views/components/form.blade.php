<!-- resources/views/components/form.blade.php -->
@props([
    'method' => 'POST',
    'action' => '#',
    'id' => null,
    'class' => '',
])

@php
    $formMethod = strtoupper($method);
    $spoofMethod = in_array($formMethod, ['PUT', 'PATCH', 'DELETE']);
@endphp

<form
    method="{{ $spoofMethod ? 'POST' : $formMethod }}"
    action="{{ $action }}"
    id="{{ $id }}"
    class="{{ $class }}"
    autocomplete="off"
    {{ $attributes }}
>
    @if($formMethod !== 'GET')
        @csrf
        @if($spoofMethod)
            @method($formMethod)
        @endif
    @endif

    {{ $slot }}
</form>


{{-- <form
    action="{{ $action }}"
    method="{{ $method ?? 'POST' }}"
    class="{{ $class ?? '' }}"
    id="{{ $id ?? '' }}"
    autocomplete="off"
    {{ $attributes }}
>
    @if(strtoupper($method) !== 'GET')
        @csrf
        @if(strtoupper($method) === 'PUT' || strtoupper($method) === 'PATCH' || strtoupper($method) === 'DELETE')
            @method($method)
        @endif
    @endif
    
    {{ $slot }}
</form> --}}
