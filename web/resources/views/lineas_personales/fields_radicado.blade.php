<div class="row m-0 p-0">
    <x-input name="id_lineas_personal" type="hidden" value="{{ $radicado->id_lineas_personal ?? 1 }}" id="id_lineas_personal" autocomplete="id" required />

    <div class="col-12 col-md-2 mt-3">
        <x-date-input
            name="fecha_radicado"
            id="fecha_radicado"
            label="Fecha Radicado"
            value="{{ $radicado->fecha_radicado ?? null }}"
            required
            icon="fa-calendar-days"
            addonClass="bg-primary text-white"
            wrapperClass="mb-3"
        />
        @error('fecha_radicado')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    <div class="col-12 col-md-3 mt-3">
        <x-select name="id_aseguradora" label="Aseguradora" id="id_aseguradora" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($aseguradoras as $key => $value)
                <option value="{{ $key }}" {{ old('id_aseguradora', $radicado->id_aseguradora ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
        @error('id_aseguradora')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-3">
        <x-input name="poliza_asistente" type="text" value="{{ $radicado->poliza_asistente ?? null }}" id="poliza_asistente" label="Póliza Asistente"  autocomplete="off" required />
        @error('poliza_asistente')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-3">
        <x-input name="identificacion_tomador" type="text" value="{{ $radicado->identificacion_tomador ?? null }}" id="identificacion_tomador" label="Id Tomador"  autocomplete="off" required />
        @error('identificacion_tomador')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-3 mt-3">
        <x-input name="tomador" type="text" value="{{ $radicado->tomador ?? null }}" id="tomador" label="Tomador"  autocomplete="off" class="text-capitaliz" required />
        @error('tomador')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-3 mt-5">
        <x-select name="id_producto" label="Producto" id="id_producto" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($productos as $key => $value)
                <option value="{{ $key }}" {{ old('id_producto', $radicado->id_producto ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
        @error('id_producto')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-3 mt-5">
        <x-input name="ramo" type="text" value="{{ $radicado->ramo ?? null }}" id="ramo" label="Ramo"  autocomplete="off" class="bg-secondary-subtle" readonly required />
    </div>

    {{-- ======================= --}}

    {{-- <div class="col-12 col-md-3 mt-5">
        <x-select name="id_ramo" label="Ramo" id="id_ramo" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($ramos as $key => $value)
                <option value="{{ $key }}" {{ old('id_ramo', $radicado->id_ramo ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
        @error('id_ramo')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div> --}}

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-input name="prima_anualizada" type="text" value="{{ $radicado->prima_anualizada ?? null }}" id="prima_anualizada" label="Prima Anualizada"  autocomplete="off" required />
        @error('prima_anualizada')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-select name="id_frecuencia" label="Frecuencia" id="id_frecuencia" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($frecuencias as $key => $value)
                <option value="{{ $key }}" {{ old('id_frecuencia', $radicado->id_frecuencia ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
        @error('id_frecuencia')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-select name="id_proceso" label="Proceso" id="id_proceso" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($estados as $key => $value)
                <option value="{{ $key }}" {{ old('id_proceso', $radicado->id_estado ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
        @error('id_estado')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-3 mt-5">
        <x-select name="id_estado_inicial" label="Estado Inicial" id="id_estado_inicial" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($estados as $key => $value)
                <option value="{{ $key }}" {{ old('id_estado_inicial', $radicado->id_estado_inicial ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
        @error('id_estado_inicial')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-date-input
            name="fecha_emision"
            id="fecha_emision"
            label="Fecha Emisión"
            value="{{ $radicado->fecha_emision ?? null }}"
            icon="fa-calendar-days"
            addonClass="bg-primary text-white"
            wrapperClass="mb-3"
        />
        @error('fecha_emision')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-select name="id_consultor" label="Clave Consultor" id="id_consultor" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($consultores as $key => $value)
                <option value="{{ $key }}" {{ old('id_consultor', $radicado->id_consultor ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
        @error('id_consultor')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-5 mt-5">
        <x-input name="consultor" type="text" value="{{ $radicado->consultor ?? null }}" id="consultor" label="Consultor"  autocomplete="off" class="bg-secondary-subtle" readonly required />
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-3 mt-5">
        <x-select name="id_gerente" label="Gerente" id="id_gerente" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($gerentes as $key => $value)
                <option value="{{ $key }}" {{ old('id_gerente', $radicado->id_gerente ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
        @error('id_gerente')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>
        
    {{-- ======================= --}}

    <div class="col-12 col-md-3 mt-5">
        <x-select name="id_estado_poliza" label="Estado Póliza" id="id_estado_poliza" autocomplete="organization-title" required>
            <option value="">Seleccionar...</option>
            @foreach($estados as $key => $value)
                <option value="{{ $key }}" {{ old('id_estado_poliza', $radicado->id_estado_poliza ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </x-select>
        @error('id_estado_poliza')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>
    
    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-date-input
            name="fecha_cancelacion"
            id="fecha_cancelacion"
            label="Fecha Cancelación"
            value="{{ $radicado->fecha_cancelacion ?? null }}"
            icon="fa-calendar-days"
            addonClass="bg-primary text-white"
            wrapperClass="mb-3"
        />
        @error('fecha_cancelacion')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-file-input
            name="file_cedula"
            label="Cédula"
            :link="isset($radicado['file_cedula']) ? env('FILESYSTEM_URL') . '/' . $radicado['file_cedula'] : null"
        />
        @error('file_cedula')
            <span class="invalid-feedback d-block text-xs">{{ $message }}</span>
            <small class="text-warning">⚠️ Debes seleccionar nuevamente el archivo.</small>
        @enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-file-input
            name="file_matricula"
            label="Matrícula"
            :link="isset($radicado['file_matricula']) ? env('FILESYSTEM_URL') . '/' . $radicado['file_matricula'] : null"
        />
        @error('file_matricula')
            <span class="invalid-feedback d-block text-xs">{{ $message }}</span>
            <small class="text-warning">⚠️ Debes seleccionar nuevamente el archivo.</small>
        @enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-file-input
            name="file_asegurabilidad"
            label="Asegurabilidad"
            :link="isset($radicado['file_asegurabilidad']) ? env('FILESYSTEM_URL') . '/' . $radicado['file_asegurabilidad'] : null"
        />
        @error('file_asegurabilidad')
            <span class="invalid-feedback d-block text-xs">{{ $message }}</span>
            <small class="text-warning">⚠️ Debes seleccionar nuevamente el archivo.</small>
        @enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-file-input
            name="file_sarlaft"
            label="Sarlaft"
            :link="isset($radicado['file_sarlaft']) ? env('FILESYSTEM_URL') . '/' . $radicado['file_sarlaft'] : null"
        />
        @error('file_sarlaft')
            <span class="invalid-feedback d-block text-xs">{{ $message }}</span>
            <small class="text-warning">⚠️ Debes seleccionar nuevamente el archivo.</small>
        @enderror
    </div>

    {{-- ======================= --}}

    <div class="col-12 col-md-2 mt-5">
        <x-file-input
            name="file_caratula_poliza"
            label="Crátula de Póliza"
            :link="isset($radicado['file_caratula_poliza']) ? env('FILESYSTEM_URL') . '/' . $radicado['file_caratula_poliza'] : null"
        />
        @error('file_caratula_poliza')
            <span class="invalid-feedback d-block text-xs">{{ $message }}</span>
            <small class="text-warning">⚠️ Debes seleccionar nuevamente el archivo.</small>
        @enderror
    </div>

    {{-- ======================= --}}
    
    <div class="col-12 col-md-2 mt-5">
        <x-file-input
            name="file_renovacion"
            label="Renovación"
            :link="isset($radicado['file_renovacion']) ? env('FILESYSTEM_URL') . '/' . $radicado['file_renovacion'] : null"
        />
        @error('file_renovacion')
            <span class="invalid-feedback d-block text-xs">{{ $message }}</span>
            <small class="text-warning">⚠️ Debes seleccionar nuevamente el archivo.</small>
        @enderror
    </div>

    {{-- ======================= --}}
    
    <div class="col-12 col-md-2 mt-5">
        <x-file-input
            name="file_otros"
            label="Otros"
            :link="isset($radicado['file_otros']) ? env('FILESYSTEM_URL') . '/' . $radicado['file_otros'] : null"
        />
        @error('file_otros')
            <span class="invalid-feedback d-block text-xs">{{ $message }}</span>
            <small class="text-warning">⚠️ Debes seleccionar nuevamente el archivo.</small>
        @enderror
    </div>
</div> {{-- FIN Div PPAL row m-0 p-0 --}}
