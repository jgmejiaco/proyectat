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
            $('#fecha_radicado').focus();

            $('.select2').select2({
                allowClear: false,
                width: '100%'
            });
            
            // ===================================================================================
            // ===================================================================================

            $('#id_consultor').change(function() {
                let idConsultor = $(this).val();
                let consultor = $('#consultor').val('');
                console.log(idConsultor);

                $.ajax({
                    async: true,
                    url: "{{route('query_consultor')}}",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id_consultor': idConsultor
                    },
                    success: function (respuesta) {
                        console.log(respuesta);
                        console.log(respuesta.consultor);

                        consultor.val(respuesta.consultor);

                        if(respuesta == "error_exception") {
                            Swal.fire('Error!', 'No fue posible consultar el Consultor!', 'error');
                            return;
                        }
                    }
                });
            });

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

            // Abre el calendario desde el ícono
            $('.input-group-text').on('click', function (e) {
                const input = $(this).siblings('input[type="date"]');
                input.trigger('focus'); // Lanza el focus
                if (typeof input[0].showPicker === "function") {
                    input[0].showPicker(); // Intenta abrir el picker si está disponible
                }
            });
        }); // FIN document.readey
    </script>
@stop


