<!-- resources/views/components/form.blade.php -->
<form
    action="{{ $action }}"
    method="{{ $method ?? 'POST' }}"
    class="{{ $class ?? '' }}"
    id="{{ $id ?? '' }}"
    autocomplete="off" {{-- NOSONAR: Formulario administrativo, no requiere autocompletado --}}
    {{ $attributes }}
>
    @if(strtoupper($method) !== 'GET')
        @csrf
        @if(strtoupper($method) === 'PUT' || strtoupper($method) === 'PATCH' || strtoupper($method) === 'DELETE')
            @method($method)
        @endif
    @endif
    
    {{ $slot }}
</form>
