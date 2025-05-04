@extends('layouts.app')
@section('title', 'Consultores')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')
    <style>
        
    </style>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('content')
    <div class="p-3 d-flex flex-column">
        <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
            <h5 class="border rounded-top text-white text-center pt-2 pb-2" style="background-color: #337AB7;">Consultores</h5>

            <div class="row pe-3 mt-3">
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn text-white" style="background-color:#337AB7" data-bs-toggle="modal" data-bs-target="#modalCrearConsultor">Crear Consultor</button>
                </div>
            </div>

            {{-- INICIO Modal CREAR CONSULTOR --}}
            <div class="modal fade" id="modalCrearConsultor" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content border-0 p-3">
                        <x-form
                            action="{{route('consultores.store')}}"
                            method="POST"
                            class="mt-0"
                            id="formCrearConsultor"
                            autocomplete="off"
                        >
                            <div class="rounded-top text-white text-center"
                                style="background-color: #337AB7; border: solid 1px #337AB7;">
                                <h5 class="fw-bold" style="margin-top: 0.3rem; margin-bottom: 0.3rem;">Crear Consultor</h5>
                            </div>

                            <div class="modal-body p-0 m-0" style="border: solid 1px #337AB7;">
                                <div class="row p-2">
                                    <div class="col-12 col-md-3 mt-3">
                                        <x-input
                                            name="clave_consultor_global"
                                            type="text"
                                            label="Clave Global"
                                            id="clave_consultor_global"
                                            autocomplete="given-name"
                                            required
                                        />
                                    </div>

                                    <div class="col-12 col-md-9 mt-3">
                                        <x-input
                                            name="consultor"
                                            type="text"
                                            label="Consultor"
                                            id="consultor"
                                            class="text-lowercase text-capitalize"
                                            autocomplete="given-name"
                                            required
                                        />
                                    </div>

                                    <div class="col-12 mt-3">
                                        <x-input
                                            name="gerente_comercial"
                                            type="text"
                                            label="Gerente Comercial"
                                            id="gerente_comercial"
                                            class="text-lowercase text-capitalize"
                                            autocomplete="given-name"
                                            required
                                        />
                                    </div>

                                    <div class="col-12 mt-3">
                                        <x-input
                                            name="lider_comercial"
                                            type="text"
                                            label="Lider Comercial"
                                            id="lider_comercial"
                                            class="text-lowercase text-capitalize"
                                            autocomplete="given-name"
                                            required
                                        />
                                    </div>

                                    <div class="col-12 col-md-6 mt-3 mb-4">
                                        <x-input
                                            name="equipo_informes"
                                            type="text"
                                            label="Equipo Informes"
                                            id="equipo_informes"
                                            class="text-lowercase text-capitalize"
                                            autocomplete="given-name"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer d-block mt-0 border border-0 p-0">
                                <!-- Contenedor para el GIF -->
                                <div id="loadingIndicatorStore" class="loadingIndicator">
                                    <img src="{{ asset('img/loading.gif') }}" alt="Procesando...">
                                </div>

                                <div class="d-flex justify-content-center mt-4">
                                    <button type="button" id="btn_cancelar_consultor" class="btn btn-secondary me-3" data-bs-dismiss="modal">
                                        <i class="fa fa-times"></i> Cancelar
                                    </button>

                                    <button type="submit" id="btn_crear_consultor" class="btn btn-success">
                                        <i class="fa-regular fa-floppy-disk"></i> Crear
                                    </button>
                                </div>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
            {{-- FINAL Modal CREAR CONSULTOR --}}

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="col-12 p-3" id="">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100 mb-0" id="tbl_consultores"
                        aria-describedby="consultores">
                        <thead>
                            <tr class="header-table text-center">
                                {{-- <th>Id Consultor</th> --}}
                                <th>Clave Consultor Global</th>
                                <th>Nombre Consultor</th>
                                <th>Gerente Comercial</th>
                                <th>Lider Comercial</th>
                                <th>Equipo Informes</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        {{-- ============================== --}}
                        <tbody>
                            @php
                                // dd($usuariosIndex);
                            @endphp
                            @foreach ($consultoresIndex as $consultor)
                                <tr class="text-center">
                                    {{-- <td>{{$consultor->id_consultor}}</td> --}}
                                    <td>{{$consultor->clave_consultor_global}}</td>
                                    <td>{{$consultor->consultor}}</td>
                                    <td>{{$consultor->gerente_comercial}}</td>
                                    <td>{{$consultor->lider_comercial}}</td>
                                    <td>{{$consultor->equipo_informes}}</td>
                                    <td>{{$consultor->estado}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEditarConsultor_{{$consultor->id_consultor}}">
                                            <i class="fa-solid fa-pencil"></i> Editar
                                        </button>
                                    </td>

                                    {{-- ====================================================== --}}
                                    {{-- ====================================================== --}}

                                    {{-- INICIO Modal EDITAR CONSULTOR --}}
                                    {{-- <div class="modal fade" id="modalEditarConsultor_{{$consultor->id_consultor}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content border-0 p-2">
                                                <x-form
                                                    action="{{route('consultores.update', $consultor->id_consultor)}}"
                                                    method="PUT"
                                                    class="mt-2"
                                                    id="formEditarConsultor_{{$consultor->id_consultor}}"
                                                    autocomplete="off">

                                                    <x-input name="id_consultor" type="hidden" value="{{$consultor->id_consultor}}" id="id_consultor_{{$consultor->id_consultor}}" autocomplete="given-name" />

                                                    <div class="rounded-top text-white text-center"
                                                        style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                        <h5 class="fw-bold" style="margin-top: 0.3rem; margin-bottom: 0.3rem;">Editar Consultor</h5>
                                                    </div>

                                                    <div class="modal-body p-0 m-0" style="border: solid 1px #337AB7;">
                                                        <div class="row m-0">
                                                            <div class="col-12 col-md-3 mt-3">
                                                                <x-input
                                                                    name="clave_consultor_global"
                                                                    type="text"
                                                                    label="Clave Global"
                                                                    value="{{$consultor->clave_consultor_global}}"
                                                                    id="clave_consultor_global_{{$consultor->id_consultor}}"
                                                                    autocomplete="given-name"
                                                                    required
                                                                />
                                                            </div>

                                                            <div class="col-12 col-md-9 mt-3">
                                                                <x-input
                                                                    name="consultor"
                                                                    type="text"
                                                                    label="Consultor"
                                                                    value="{{$consultor->consultor}}"
                                                                    id="consultor_{{$consultor->id_consultor}}"
                                                                    class="text-lowercase text-capitalize"
                                                                    autocomplete="given-name"
                                                                    required
                                                                />
                                                            </div>

                                                            <div class="col-12 mt-3">
                                                                <x-input
                                                                    name="gerente_comercial"
                                                                    type="text"
                                                                    label="Gerente Comercial"
                                                                    value="{{$consultor->gerente_comercial}}"
                                                                    id="gerente_comercial_{{$consultor->id_consultor}}"
                                                                    class="text-lowercase text-capitalize"
                                                                    autocomplete="given-name"
                                                                    required
                                                                />
                                                            </div>

                                                            <div class="col-12 mt-3">
                                                                <x-input
                                                                    name="lider_comercial"
                                                                    type="text"
                                                                    label="Lider Comercial"
                                                                    value="{{$consultor->lider_comercial}}"
                                                                    id="lider_comercial_{{$consultor->id_consultor}}"
                                                                    class="text-lowercase text-capitalize"
                                                                    autocomplete="given-name"
                                                                    required
                                                                />
                                                            </div>

                                                            <div class="col-12 col-md-6 mt-3 mb-3">
                                                                <x-input
                                                                    name="equipo_informes"
                                                                    type="text"
                                                                    label="Equipo Informes"
                                                                    value="{{$consultor->equipo_informes}}"
                                                                    id="equipo_informes_{{$consultor->id_consultor}}"
                                                                    class="text-lowercase text-capitalize"
                                                                    autocomplete="given-name"
                                                                    required
                                                                />
                                                            </div>

                                                            <div class="col-12 col-md-6 mt-3 mb-3">
                                                                <x-select
                                                                    name="id_estado"
                                                                    label="Estado"
                                                                    id="idEstado_{{$consultor->id_consultor}}"
                                                                    autocomplete="organization-title"
                                                                    required
                                                                >
                                                                    <option value="">Seleccionar...</option>
                                                                    @foreach($estados_gral as $key => $value)
                                                                        <option value="{{$key}}" {{(isset($consultor) && $consultor->id_estado == $key) ? 'selected' : ''}}>
                                                                            {{$value}}
                                                                        </option>
                                                                    @endforeach
                                                                </x-select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer d-block mt-0 border border-0">
                                                        <div id="loadingIndicatorEditConsultor_{{$consultor->id_consultor}}" class="loadingIndicator">
                                                            <img src="{{ asset('img/loading.gif') }}" alt="Procesando...">
                                                        </div>

                                                        <div class="d-flex justify-content-center mt-3">
                                                            <button type="button" id="btn_cancelar_consultor_{{ $consultor->id_consultor }}"
                                                                class="btn btn-secondary me-3" data-bs-dismiss="modal">
                                                                <i class="fa fa-times"></i> Cancelar
                                                            </button>

                                                            <button type="submit" id="btn_editar_consultor_{{$consultor->id_consultor}}"
                                                                class="btn btn-success" title="Editar">
                                                                <i class="fa-regular fa-floppy-disk"></i> Editar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </x-form>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- FINAL Modal EDITAR CONSULTOR --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> {{-- FIN div_campos_usuarios --}}
        </div> {{-- FIN div_crear_usuario --}}
    </div>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script>
        $(document).ready(function() {
            // INICIO DataTable Lista Consultores
            $("#tbl_consultores").DataTable({
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '📥 Exportar Excel',
                        className: 'waves-effect waves-light btn btn-sm btn-success rounded-pill',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function (xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row:first c', sheet).attr('s', '42');
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '📄 Exportar PDF',
                        className: 'waves-effect waves-light btn btn-sm btn-danger rounded-pill',
                        exportOptions: {
                            columns: ':visible'
                        },
                        orientation: 'landscape',
                        pageSize: 'letter',
                        title: 'Listado de Consultores'
                    }
                ],
                language: {
                    url: "{{ asset('DataTable1.13.6/es-ES.json') }}"
                },
                pageLength: 10,
                lengthMenu: [
                    [10, 20, 30, -1],
                    [10, 20, 30, "Todos"]
                ],
                scrollX: true,
                bSort: true,
                stripe: true,
                responsive: true,
                infoEmpty: "No hay registros disponibles",
                order: [[1, 'asc']]  // Indicar la columna predeterminada contando desde 0
            });
            // CIERRE DataTable Lista Consultores

            // ===========================================================================================

            // formCrearConsultor Submit para cargar gif en el submit
            $(document).on("submit", "form[id^='formCrearConsultor']", function(e) {
                e.preventDefault(); // Evita el envío si hay errores

                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorStore']");

                // Dessactivar Botones
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");

                const claveConsultorGlobal = '#clave_consultor_global';
                const consultor = '#consultor';
                const gerenteComercial = '#gerente_comercial';
                const liderComercial = '#lider_comercial';
                const equipoInformes = '#equipo_informes';

                $(claveConsultorGlobal).prop("readonly", true).addClass("bg-secondary-subtle");
                $(consultor).prop("readonly", true).addClass("bg-secondary-subtle");
                $(gerenteComercial).prop("readonly", true).addClass("bg-secondary-subtle");
                $(liderComercial).prop("readonly", true).addClass("bg-secondary-subtle");
                $(equipoInformes).prop("readonly", true).addClass("bg-secondary-subtle");
                
                // Mostrar Spinner
                loadingIndicator.show();

                // Enviar formulario manualmente
                this.submit();
            });

            // ===========================================================================================

            // Cargar el select2 cuando el modal está abierto
            $(document).on('shown.bs.modal', "div[id^='modalEditarConsultor_']", function () {
                $(this).find('.select2').select2({
                    dropdownParent: $(this),
                    allowClear: false,
                    width: '100%'
                });
            }); // FIN shown.bs.modal->modalEditarConsultor_

            // ===========================================================================================

            // Validaciones editar Consultor al submit
            $(document).on("submit", "form[id^='formEditarConsultor_']", function(e) {
                const form = $(this);
                const formId = form.attr('id');
                const id = formId.split('_')[1];

                // Capturar dinámicamente spinner y btns
                const submitButton = $(`#btn_editar_consultor_${id}`);
                const cancelButton = $(`#btn_cancelar_consultor_${id}`);
                const loadingIndicator = $(`#loadingIndicatorEditConsultor_${id}`);

                // Bloquear botones
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>"
                );
                    
                // Capturo campos
                const claveConsultorGlobal = $(`#clave_consultor_global_${id}`);
                const consultor = $(`#consultor_${id}`);
                const gerenteComercial = $(`#gerente_comercial_${id}`);
                const liderComercial = $(`#lider_comercial_${id}`);
                const equipoInformes = $(`#equipo_informes_${id}`);
                const idEstado = $(`#idEstado_${id}`);

                claveConsultorGlobal.prop("readonly", true).addClass("bg-secondary-subtle");
                consultor.prop("readonly", true).addClass("bg-secondary-subtle");
                gerenteComercial.prop("readonly", true).addClass("bg-secondary-subtle");
                liderComercial.prop("readonly", true).addClass("bg-secondary-subtle");
                equipoInformes.prop("readonly", true).addClass("bg-secondary-subtle");

                $(idEstado)
                    .prop("disabled", true)
                    .addClass("bg-secondary-subtle")
                    .each(function() {
                        // Agregamos un input hidden para enviar el valor
                        $('<input>').attr({
                            type: 'hidden',
                            name: $(this).attr('name'),
                            value: $(this).val()
                        }).appendTo(form);
                    });

                loadingIndicator.show();
            }); // FIN submit.formEditarConsultor_
        }); // FIN document.ready
    </script>
@stop
