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

                <x-form action="{{route('lineas_personales.store')}}" method="POST" class="mt-2" id="formCrearRadicado" autocomplete="off" >
                
                    @include('lineas_personales.fields_radicado')

                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}

                    <!-- Contenedor para el GIF -->
                    <div id="loadingIndicatorStore" class="loadingIndicator">
                        <img src="{{asset('img/loading.gif')}}" alt="Procesando...">
                    </div>

                    {{-- ========================================================= --}}
                    {{-- ========================================================= --}}

                    <div class="mt-5 mb-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success rounded-2">
                            <i class="fa-regular fa-floppy-disk"></i> Crear Radicado
                        </button>
                    </div>
                </x-form> {{-- FIN x-form --}}
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
            
            // ===================================================================================
            // ===================================================================================

            // formCrearUsuario para cargar gif en el submit
            $(document).on("submit", "form[id^='formCrearRadicado']", function(e) {
                e.preventDefault(); // Evita el envío si hay errores

                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorStore']"); // Busca el GIF del form actual

                // Mostrar Spinner, Dessactivar Botones
                loadingIndicator.show();
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");

                // Enviar formulario manualmente
                this.submit();
            });

            // ===================================================================================
            // ===================================================================================
        }); // FIN document.readey
    </script>
@stop


