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
                                <th class="bg-info-subtle">Creado por</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        {{-- ============================== --}}
                        <tbody>
                            @foreach ($lineasPersonalesIndex as $radicado)
                                <tr class="text-center">
                                    <td class="text-center align-content-center">{{$radicado->fecha_radicado}}</td>
                                    <td class="text-center align-content-center">{{$radicado->aseguradora}}</td>
                                    <td class="text-center align-content-center">{{$radicado->poliza_asistente}}</td>
                                    <td class="text-center align-content-center">{{$radicado->identificacion_tomador}}</td>
                                    <td class="text-center align-content-center">{{$radicado->tomador}}</td>
                                    <td class="text-center align-content-center">{{$radicado->producto}}</td>
                                    <td class="text-center align-content-center">{{$radicado->ramo}}</td>
                                    <td class="text-center align-content-center">{{$radicado->prima_anualizada}}</td>
                                    <td class="text-center align-content-center">{{$radicado->frecuencia}}</td>
                                    <td class="text-center align-content-center">{{$radicado->proceso}}</td>
                                    <td class="text-center align-content-center">{{$radicado->estado_inicial}}</td>
                                    <td class="text-center align-content-center">{{$radicado->fecha_emision}}</td>
                                    <td class="text-center align-content-center">{{$radicado->clave_consultor_global}}</td>
                                    <td class="text-center align-content-center">{{$radicado->consultor}}</td>
                                    <td class="text-center align-content-center">{{$radicado->gerente}}</td>
                                    <td class="text-center align-content-center">{{$radicado->estado_poliza}}</td>
                                    <td class="text-center align-content-center">{{$radicado->fecha_cancelacion}}</td>

                                    @if (isset($radicado->file_cedula) && !empty($radicado->file_cedula) && !is_null($radicado->file_cedula))
                                        <td class="text-center align-content-center bg-warning-subtle"><a href="storage/{{$radicado->file_cedula}}" target="_blank" class="text-decoration-none">Cédula</a></td>
                                    @else
                                        <td class="text-center align-content-center bg-warning-subtle"></td>
                                    @endif

                                    @if (isset($radicado->file_matricula) && !empty($radicado->file_matricula) && !is_null($radicado->file_matricula))
                                        <td class="text-center align-content-center bg-warning-subtle"><a href="storage/{{$radicado->file_matricula}}" target="_blank" class="text-decoration-none">Matrícula</a></td>
                                    @else
                                        <td class="text-center align-content-center bg-warning-subtle"></td>
                                    @endif

                                    @if (isset($radicado->file_asegurabilidad) && !empty($radicado->file_asegurabilidad) && !is_null($radicado->file_asegurabilidad))
                                        <td class="text-center align-content-center bg-warning-subtle"><a href="storage/{{$radicado->file_asegurabilidad}}" target="_blank" class="text-decoration-none">Solicitud Asegurabilidad</a></td>
                                    @else
                                        <td class="text-center align-content-center bg-warning-subtle"></td>
                                    @endif

                                    @if (isset($radicado->file_sarlaft) && !empty($radicado->file_sarlaft) && !is_null($radicado->file_sarlaft))
                                        <td class="text-center align-content-center bg-warning-subtle"><a href="storage/{{$radicado->file_sarlaft}}" target="_blank" class="text-decoration-none">Sarlaft</a></td>
                                    @else
                                        <td class="text-center align-content-center bg-warning-subtle"></td>
                                    @endif


                                    @if (isset($radicado->file_caratula_poliza) && !empty($radicado->file_caratula_poliza) && !is_null($radicado->file_caratula_poliza))
                                        <td class="text-center align-content-center bg-warning-subtle"><a href="storage/{{$radicado->file_caratula_poliza}}" target="_blank" class="text-decoration-none">Carátula Póliza</a></td>
                                    @else
                                        <td class="text-center align-content-center bg-warning-subtle"></td>
                                    @endif


                                    @if (isset($radicado->file_renovacion) && !empty($radicado->file_renovacion) && !is_null($radicado->file_renovacion))
                                        <td class="text-center align-content-center bg-warning-subtle"><a href="storage/{{$radicado->file_renovacion}}" target="_blank" class="text-decoration-none">Renovacion</a></td>
                                    @else
                                        <td class="text-center align-content-center bg-warning-subtle"></td>
                                    @endif


                                    @if (isset($radicado->file_otros) && !empty($radicado->file_otros) && !is_null($radicado->file_otros))
                                        <td class="text-center align-content-center bg-warning-subtle"><a href="storage/{{$radicado->file_otros}}" target="_blank" class="text-decoration-none">Otros</a></td>
                                    @else
                                        <td class="text-center align-content-center bg-warning-subtle"></td>
                                    @endif

                                    <td class="text-center align-content-center bg-info-subtle">{{$radicado->nombres_usuario}}</td>

                                    <td class="text-center align-content-center">
                                        <a href="{{route('lineas_personales.index', $radicado->id_lineas_personal)}}" role="button"
                                            class="btn btn-success">
                                            <i class="fa-solid fa-pencil"></i> Editar
                                        </a>
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
                        pageSize: 'letter',
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
                infoEmpty: "No hay registros disponibles",
                order: [[0, 'desc']]  // Indicar la columna predeterminada contando desde 0
            });
            // CIERRE DataTable Líneas Personales

            // ===========================================================================================
        }); // FIN document.ready
    </script>
@stop
