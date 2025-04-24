@extends('layouts.app')
@section('title', 'Líneas Personales')

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
            <h5 class="border rounded-top text-white text-center pt-2 pb-2" style="background-color: #337AB7;">Informe Producción Líneas Personales</h5>

            <div class="row pe-3 mt-3">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{route('lineas_personales.create')}}" class="btn text-white" style="background-color:#337AB7">Crear Radicado</a>
                </div>
            </div>

            <div class="col-12 p-3" id="">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100 mb-0" id="tbl_radicados" aria-describedby="radicados">
                        <thead>
                            <tr class="header-table text-center">
                                <th>Fecha Radicado</th>
                                <th>Aseguradora</th>
                                <th>Póliza Asistente</th>
                                <th>Identificación Tomador</th>
                                <th>Nombres Tomador</th>
                                <th>Producto</th>
                                <th>Ramo</th>
                                <th>Prima Anualizada</th>
                                <th>Frecuencia</th>
                                <th>Proceso</th>
                                <th>Estado Inicial</th>
                                <th>Fecha Emisión</th>
                                <th>Clave Consultor Global</th>
                                <th>Consultor</th>
                                <th>Gerente</th>
                                <th>Estado Póliza</th>
                                <th>Fecha Cancelación</th>
                                <th class="bg-warning-subtle">Cédula</th>
                                <th class="bg-warning-subtle">Matrícula</th>
                                <th class="bg-warning-subtle">Asegurabilidad</th>
                                <th class="bg-warning-subtle">Sarlaft</th>
                                <th class="bg-warning-subtle">Carátula Póliza</th>
                                <th class="bg-warning-subtle">Renvación</th>
                                <th class="bg-warning-subtle">Otros</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        {{-- ============================== --}}
                        <tbody>
                            @foreach ($lineasPersonalesIndex as $radicado)
                                <tr class="text-center">
                                    <td>{{$radicado->fecha_radicado}}</td>
                                    <td>{{$radicado->aseguradora}}</td>
                                    <td>{{$radicado->poliza_asistente}}</td>
                                    <td>{{$radicado->identificacion_tomador}}</td>
                                    <td>{{$radicado->tomador}}</td>
                                    <td>{{$radicado->producto}}</td>
                                    <td>{{$radicado->ramo}}</td>
                                    <td>{{$radicado->prima_anualizada}}</td>
                                    <td>{{$radicado->frecuencia}}</td>
                                    <td>{{$radicado->proceso}}</td>
                                    <td>{{$radicado->estado_inicial}}</td>
                                    <td>{{$radicado->fecha_emision}}</td>
                                    <td>{{$radicado->clave_consultor_global}}</td>
                                    <td>{{$radicado->consultor}}</td>
                                    <td>{{$radicado->gerente}}</td>
                                    <td>{{$radicado->estado_poliza}}</td>
                                    <td>{{$radicado->fecha_cancelacion}}</td>

                                    <td class="bg-warning-subtle">{{$radicado->file_cedula}}</td>
                                    <td class="bg-warning-subtle">{{$radicado->file_matricula}}</td>
                                    <td class="bg-warning-subtle">{{$radicado->file_asegurabilidad}}</td>
                                    <td class="bg-warning-subtle">{{$radicado->file_sarlaft}}</td>
                                    <td class="bg-warning-subtle">{{$radicado->file_caratula_poliza}}</td>
                                    <td class="bg-warning-subtle">{{$radicado->file_renovacion}}</td>
                                    <td class="bg-warning-subtle">{{$radicado->file_otros}}</td>

                                    <td>
                                        <button type="button" class="btn btn-success rounded-circle btn-circle"
                                            title="Editar" data-bs-toggle="modal"
                                            data-bs-target="#modalEditarUsuario_">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> {{-- FIN table-responsive --}}
            </div> {{-- FIN col-12 p-3 --}}
        </div> {{-- FIN div p-0 --}}
    </div>{{-- FIN p-3 d-flex flex-column --}}
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script>
        $(document).ready(function() {
            // INICIO DataTable Líneas Personales
            $("#tbl_radicados").DataTable({
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
                        pageSize: 'A4',
                        title: 'Listado de Usuarios'
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
                infoEmpty: "No hay registros disponibles"
            });
            // CIERRE DataTable Líneas Personales

            // ===========================================================================================
        }); // FIN document.ready
    </script>
@stop
