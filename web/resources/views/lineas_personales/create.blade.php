@extends('layouts.app')
@section('title', 'Crear Radicado')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')

@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('content')
    <div class="p-3 d-flex flex-column">
        <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
            <h5 class="border rounded-top text-white text-center pt-2 pb-2" style="background-color: #337AB7;">Crear Radicado Líneas Personales</h5>

            <div class="p-3">
                <div class="d-flex justify-content-end pe-3 mt-10">
                    <div class="">
                        <a href="{{route('lineas_personales.index')}}" class="btn text-white" style="background-color:#337AB7">Radicados</a>
                    </div>
                </div>

                {{-- =============================================================== --}}
                {{-- =============================================================== --}}

                {{-- {!! Form::open(['method' => 'POST', 'route' => ['usuarios.store'], 'class' => 'mt-2', 'autocomplete' => 'off', 'id' => 'formCrearUsuarios']) !!}
                    @csrf --}}
                
                    {{-- @include('usuarios.fields_usuarios') --}}

                    <h1>formulario</h1>

                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}

                    <!-- Contenedor para el GIF -->
                    <div id="loadingIndicatorStore" class="loadingIndicator">
                        <img src="{{asset('img/loading.gif')}}" alt="Procesando...">
                    </div>

                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}

                    <div class="mt-4 mb-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success rounded-2">
                            <i class="fa-regular fa-floppy-disk"></i> Crear Radicado
                        </button>
                    </div>
                {{-- {!! Form::close() !!} --}}
            </div>

        </div> {{-- FIN div p-0 --}}
    </div> {{-- p-3 d-flex flex-column --}}
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script>
        $( document ).ready(function() {
            // let idEstado = $('#id_estado').val();
            // console.log(idEstado);

            // if (idEstado == 1 || idEstado == '') {
            //     $('#div_fecha_terminacion_contrato').hide();
            //     $('#fecha_terminacion_contrato').removeAttr('required');
            // }

            // $('#id_estado').change(function () {
            //     let idEstado = $('#id_estado').val();
            //     console.log(idEstado);

            //     if (idEstado == 1) { // Activo
            //         $('#div_fecha_terminacion_contrato').hide();
            //         $('#fecha_terminacion_contrato').removeAttr('required');
            //     } else if (idEstado == 2) { // Inactivo
            //         $('#div_fecha_terminacion_contrato').show('slow');
            //         $('#fecha_terminacion_contrato').attr('required');
            //     } else { // Seleccionar...
            //         $('#div_fecha_terminacion_contrato').hide();
            //         $('#fecha_terminacion_contrato').removeAttr('required');
            //     }
            // });

            // ===================================================================================
            // ===================================================================================

            // formCrearUsuario para cargar gif en el submit
            $("form").on("submit", function (e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorStore']"); // Busca el GIF del form actual

                // Dessactivar Botones
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);
                
                // Mostrar Spinner
                loadingIndicator.show();
            });
        }); // FIN document.readey
    </script>
@stop


