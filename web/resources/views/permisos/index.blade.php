@extends('layouts.app')
@section('title', 'Permisos')

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
            <h4 class="border rounded-top text-white text-center pt-2 pb-2 text-uppercase" style="background-color: #337AB7;">Asignar Permiso</h4>

            <div class="d-flex p-3">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCrearPermiso">
                    <i class="fa-solid fa-unlock-keyhole"></i> Crear Permiso
                </button>

                <button type="button" class="btn btn-info ms-5" data-bs-toggle="modal" data-bs-target="#modalCrearRol">
                    <i class="fa-solid fa-user"></i> Crear Rol
                </button>
            </div>

            <x-form action="{{route('permisos.store')}}" method="POST" class="mt-0" id="formAsignarPermisos" autocomplete="off" >
                <div class="m-0 p-3">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <x-select name="id_usuario" label="Usuario" id="id_usuario" autocomplete="organization-title" required >
                                <option value="">Seleccionar...</option>
                                @foreach($usuarios as $key => $value)
                                    <option value="{{$key}}" {{(isset($usuario) && $usuario->id_usuario == $key) ? 'selected' : ''}}>
                                        {{$value}}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                
                        <div class="col-12 col-md-6 text-center">
                            <div id="loadingPermissions" class="aligned-middle d-none">
                                <img src="{{ asset('img/loading.gif') }}" alt="Procesando..." height="50" width="50">
                                <p class="mb-0"><strong>Procesando...</strong></p>
                            </div>
                        </div>
                    </div>
            
                    <div class="mt-5">
                        <h3 class="border rounded text-center pt-2 pb-2 m-0" style="background-color: #EEEEEE;">Listado de Permisos</h3>
                    </div>
        
                    <div class="mt-4 mb-4">
                        <h5 class="text-start">Seleccione los permisos que deseas asignar</h5>
                    </div>
        
                    <div class="col-12 pt-2">
                        {{-- Checkbox para seleccionar todos --}}
                        <div class="permiso-item" style="padding-bottom: 20px;">
                            <input type="checkbox" id="seleccionar_todos">
                            <label for="seleccionar_todos" class="pointer"><strong>Seleccionar/Quitar todos</strong></label>
                        </div>
        
                        <div class="permiso-grid" id="permisos-grid">
                            @foreach ($permisos as $permiso)
                                <div class="permiso-item">
                                    <input
                                        type="checkbox"
                                        class="permiso-checkbox"
                                        name="permisos[]"
                                        value="{{ $permiso->id }}"
                                        id="permiso_{{ $permiso->id }}"
                                        {{ in_array($permiso->id, $permisosAsignados ?? []) ? 'checked' : '' }}
                                    >
                                    <label for="permiso_{{ $permiso->id }}" class="pointer">{{ $permiso->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
            
                    <!-- Contenedor para el GIF -->
                    <div id="loadingIndicatorAsignarPermiso" class="loadingIndicator">
                        <img src="{{ asset('img/loading.gif') }}" alt="Procesando...">
                    </div>
            
                    {{-- ====================================================== --}}
            
                    <div class="mt-5 mb-2 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success rounded-2 me-3" id="btn_asignar_permisos">
                            <i class="fa-regular fa-floppy-disk"></i>
                            Asignar
                        </button>
                    </div>
                </div>
            </x-form>
        </div> {{-- FIN div_p-0 --}}
    </div> {{-- FIN div_p-3 d-flex flex-column --}}

    {{-- ====================================================== --}}
    {{-- ====================================================== --}}
    {{-- ====================================================== --}}

    {{-- INICIO Modal Crear Permisos --}}
    <div class="modal fade" id="modalCrearPermiso" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content border-0 p-3">
                <div class="rounded-top" style="border: solid 1px #337AB7;">
                    <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                        <h5 class="m-0 pt-1 pb-1 align-middle">Crear Permiso</h5>
                    </div>

                    <x-form action="{{route('crear_permiso')}}" method="POST" class="mt-2" id="formCrearPermiso" autocomplete="off">
                        <div class="modal-body p-0 m-0">
                            <div class="row m-0 pt-1 pb-4">
                                <div class="col-12 col-md-6">
                                    <x-input name="permission" type="text" label="Nombres Permiso" id="permission" autocomplete="given-name" required />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-block mt-0 border border-0 p-0 mb-3">
                            <!-- Contenedor para el GIF -->
                            <div id="loadingIndicatorCrearPermiso" class="loadingIndicator">
                                <img src="{{ asset('img/loading.gif') }}" alt="Procesando...">
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <button type="button" id="btn_cancelar_user" class="btn btn-secondary me-3" data-bs-dismiss="modal">
                                    <i class="fa fa-times"></i> Cancelar
                                </button>

                                <button type="submit" id="btn_crear_user" class="btn btn-success">
                                    <i class="fa-regular fa-floppy-disk"></i> Crear
                                </button>
                            </div>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
    {{-- FINAL Modal Crear Permisos --}}
    
    {{-- ====================================================== --}}
    {{-- ====================================================== --}}
    {{-- ====================================================== --}}

    {{-- INICIO Modal Crear ROL --}}
    <div class="modal fade" id="modalCrearRol" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content border-0 p-3">
                <div class="rounded-top" style="border: solid 1px #337AB7;">
                    <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                        <h5 class="m-0 pt-1 pb-1 align-middle">Crear Rol</h5>
                    </div>

                    <x-form action="{{route('crear_rol')}}" method="POST" class="mt-2" id="formCrearRol" autocomplete="off">
                        <div class="modal-body p-0 m-0">
                            <div class="row m-0 pt-1 pb-4">
                                <div class="col-12 col-md-6">
                                    <x-input name="rol" type="text" label="Nombre Rol" id="rol" autocomplete="given-name" required />
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-block mt-0 border border-0 p-0 mb-3">
                            <!-- Contenedor para el GIF -->
                            <div id="loadingIndicatorCrearRol" class="loadingIndicator">
                                <img src="{{ asset('img/loading.gif') }}" alt="Procesando...">
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <button type="button" id="btn_cancelar_rol" class="btn btn-secondary me-3" data-bs-dismiss="modal">
                                    <i class="fa fa-times"></i> Cancelar
                                </button>

                                <button type="submit" id="btn_crear_rol" class="btn btn-success">
                                    <i class="fa-regular fa-floppy-disk"></i> Crear
                                </button>
                            </div>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
    {{-- FINAL Modal Crear ROL --}}
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script>
        // Variable que se comparte desde el trait
        let permisosAsignados = @json($permisosAsignados);
        const permisos = @json($permisos);

        $(document).ready(function() {

            $("#id_usuario").change(function() {
                let idUsuario = $("#id_usuario").val();
                $('.permiso-checkbox').prop('checked', false);
                const submitButton = $("#btn_asignar_permisos");

                $.ajax({
                    url: "{{route('consultar_permisos_usuario')}}",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id_usuario': idUsuario
                    },
                    beforeSend: function()
                    {
                        $("#loadingPermissions").show('slow');
                        $("#loadingPermissions").removeClass('d-none');
                    
                        submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(response)
                    {
                        $("#loadingPermissions").hide('slow');
                        $("#loadingPermissions").addClass('d-none');
                        submitButton.prop("disabled", false).html("Guardar");

                        if(response == "error_exception") {
                            Swal.fire('Error!', 'Ha ocurrido un error consultando los permisos', 'error');
                            return;
                        }

                        // Si tiene permisos asignados, marcarlos
                        if (response.permisos.length > 0) {
                            let permisosAsignados = response.permisos.map(item => item.permission_id);

                            permisosAsignados.forEach(id =>
                            {
                                $('#permiso_' + id).prop('checked', true);
                            });
                        }
                    } // FIN success:
                }); // FIN $.ajax
            }); // FIN $("#id_usuario").change(function()

            // ===============================================================

            document.getElementById('seleccionar_todos').addEventListener('change', function () {
                const checkboxes = document.querySelectorAll('.permiso-checkbox');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });

            // ===============================================================

            $("#formAsignarPermisos").on("submit", function (e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorAsignarPermiso']"); // Busca el GIF del form actual
        
                // Dessactivar Botones
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                
                // Mostrar Spinner
                loadingIndicator.show();
            });

            // ===============================================================

            $("#formCrearPermiso").on("submit", function (e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorCrearPermiso']"); // Busca el GIF del form actual

                const permiso = $('#permission').prop("readonly", true);
        
                // Dessactivar Botones
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                
                // Mostrar Spinner
                loadingIndicator.show();
            });
            
            // ===============================================================

            $("#formCrearRol").on("submit", function (e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorCrearRol']"); // Busca el GIF del form actual

                const rol = $('#rol').prop("readonly", true);
        
                // Dessactivar Botones
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                
                // Mostrar Spinner
                loadingIndicator.show();
            });

            // ===============================================================

            
        }); // FIN document.ready
    </script>
@stop


