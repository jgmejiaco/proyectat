@extends('layouts.app')
@section('title', 'Crear Usuarios')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')

@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('content')
        <div class="p-3">
            <div class="d-flex justify-content-between pe-3 mt-3">
                <div class="">
                    <a href="{{route('usuarios.index')}}" class="btn text-white" style="background-color:#337AB7">Usuarios</a>
                </div>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            {{-- <x-form action="{{route('usuarios.store')}}" method="POT" class="mt-2" id="formCrearUsuario" autocomplete="off">
            
                @include('usuarios.fields_usuarios') --}}

                {{-- ========================================================= --}}
                {{-- ========================================================= --}}

                <!-- Contenedor para el GIF -->
                {{-- <div id="loadingIndicatorStore" class="loadingIndicator">
                    <img src="{{asset('img/loading.gif')}}" alt="Procesando...">
                </div> --}}

                {{-- ========================================================= --}}
                {{-- ========================================================= --}}

                {{-- <div class="mt-4 mb-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success rounded-2 me-3">
                        <i class="fa fa-floppy-o"></i>
                        Guardar
                    </button>

                    <button type="button" class="btn btn-danger rounded-2">
                        <i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                </div>
            </x-form> --}}
        </div>
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


