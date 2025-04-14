<div class="row m-0 p-0" id="">
    <x-input name="id_lineas_personal" type="hidden" value="{{ $radicado->id_lineas_personal ?? 1 }}" id="id_lineas_personal" autocomplete="id" required />

    <div class="col-12 col-md-2 mt-3">
        <x-input name="fecha_radicado" type="date" value="{{ $radicado->fecha_radicado ?? null }}" id="fecha_radicado" label="Fecha Radicado"  autocomplete="date" required />
    </div>

    <div class="col-12 col-md-3 mt-3">
        <x-select name="id_aseguradora" label="Aseguradora" id="id_aseguradora" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($aseguradoras as $key => $value)
                <option value="{{ $key }}" {{ ($radicado->id_aseguradora ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-3">
        <x-input name="poliza_asistente" type="text" value="{{ $radicado->poliza_asistente ?? null }}" id="poliza_asistente" label="Póliza Asistente"  autocomplete="off" required />
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-5 mt-3">
        <x-select name="id_tomador" label="Tomador" id="id_tomador" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($tomadores as $key => $value)
                <option value="{{ $key }}" {{ ($radicado->id_tomador ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-3 mt-5">
        <x-select name="id_producto" label="Producto" id="id_producto" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($productos as $key => $value)
                <option value="{{ $key }}" {{ ($radicado->id_producto ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-3 mt-5">
        <x-select name="id_ramo" label="Ramo" id="id_ramo" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($ramos as $key => $value)
                <option value="{{ $key }}" {{ ($radicado->id_ramo ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-input name="prima_anualizada" type="text" value="{{ $radicado->prima_anualizada ?? null }}" id="prima_anualizada" label="Prima Anualizada"  autocomplete="off" required />
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-select name="id_frecuencia" label="Frecuencia" id="id_frecuencia" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($frecuencias as $key => $value)
                <option value="{{ $key }}" {{ ($radicado->id_frecuencia ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-select name="id_estado" label="Proceso" id="id_estado" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($estados as $key => $value)
                <option value="{{ $key }}" {{ ($radicado->id_proceso ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-select name="id_estado_inicial" label="Estado Inicial" id="id_estado_inicial" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($estados as $key => $value)
                <option value="{{ $key }}" {{ ($radicado->id_estado_inicial ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-input name="fecha_emision" type="date" value="{{ $radicado->fecha_emision ?? null }}" id="fecha_emision" label="Fecha Emisión"  autocomplete="date" required />
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-select name="id_consultor" label="Consultor" id="id_consultor" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($consultores as $key => $value)
                <option value="{{ $key }}" {{ ($radicado->id_consultor ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-select name="id_gerente" label="Gerente" id="id_gerente" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($gerentes as $key => $value)
                <option value="{{ $key }}" {{ ($radicado->id_gerente ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
    </div>
        
    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-select name="id_estado_poliza" label="Estado Póliza" id="id_estado_poliza" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($estados as $key => $value)
                <option value="{{ $key }}" {{ ($radicado->id_estado_poliza ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
    </div>
    
    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-input name="fecha_cancelacion" type="date" value="{{ $radicado->fecha_cancelacion ?? null }}" id="fecha_cancelacion" label="Fecha Cancelación"  autocomplete="date" required />
    </div>
</div>
