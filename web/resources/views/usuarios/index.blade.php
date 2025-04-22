@extends('layouts.app')
@section('title', 'Usuarios')

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
            <h5 class="border rounded-top text-white text-center pt-2 pb-2" style="background-color: #337AB7;">Usuarios</h5>

            <div class="row pe-3 mt-3">
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn text-white" style="background-color:#337AB7" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">Crear Usuario</button>
                </div>
            </div>

            {{-- INICIO Modal CREAR USUARIO --}}
            <div class="modal fade" id="modalCrearUsuario" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content border-0 p-3">
                        <x-form
                            action="{{route('usuarios.store')}}"
                            method="POST"
                            class="mt-0"
                            id="formCrearUsuario"
                            autocomplete="off"
                        >
                            <div class="rounded-top text-white text-center"
                                style="background-color: #337AB7; border: solid 1px #337AB7;">
                                <h5 class="fw-bold" style="margin-top: 0.3rem; margin-bottom: 0.3rem;">Crear Usuario</h5>
                            </div>

                            <div class="modal-body p-0 m-0" style="border: solid 1px #337AB7;">
                                <div class="row m-2">
                                    <div class="col-12 col-md-6">
                                        <x-input
                                            name="nombre_usuario"
                                            type="text"
                                            label="Nombres"
                                            id="nombre_usuario"
                                            autocomplete="given-name"
                                            required
                                        />
                                    </div>
                                    
                                    <div class="col-12 col-md-6">
                                        <x-input
                                            name="apellido_usuario"
                                            type="text"
                                            label="Apellidos"
                                            id="apellido_usuario"
                                            autocomplete="family-name"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="row m-2">
                                    <div class="col-12 col-md-6">
                                        <x-input
                                            name="correo"
                                            type="email"
                                            label="Correo"
                                            id="correo"
                                            autocomplete="email"
                                            required
                                        />
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <x-select
                                            name="id_rol"
                                            label="Rol"
                                            id="id_rol"
                                            autocomplete="organization-title"
                                            required
                                        >
                                            <option value="">Seleccionar...</option>
                                            @foreach($roles as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                </div>

                                <div class="row m-2">
                                    <div class="col-12 col-md-6">
                                        <x-input
                                            name="clave"
                                            type="password"
                                            label="Clave"
                                            id="clave"
                                            autocomplete="password"
                                            required
                                        />
                                    </div>
                                    
                                    <div class="col-12 col-md-6">
                                        <x-input
                                            name="confirmar_clave"
                                            type="password"
                                            label="Confirmar clave"
                                            id="confirmar_clave"
                                            autocomplete="password"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer d-block mt-0 border border-0 p-0">
                                <!-- Contenedor para el GIF -->
                                <div id="loadingIndicatorStore"
                                    class="loadingIndicator">
                                    <img src="{{ asset('img/loading.gif') }}" alt="Procesando...">
                                </div>

                                <div class="d-flex justify-content-center mt-5">
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
            {{-- FINAL Modal CREAR USUARIO --}}

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="col-12 p-3" id="">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100 mb-0" id="tbl_usuarios"
                        aria-describedby="users-usuarios">
                        <thead>
                            <tr class="header-table text-center">
                                {{-- <th>Id Usuario</th> --}}
                                <th>Nombres</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        {{-- ============================== --}}
                        <tbody>
                            @php
                                // dd($usuariosIndex);
                            @endphp
                            @foreach ($usuariosIndex as $usuario)
                                <tr class="text-center">
                                    {{-- <td>{{$usuario->id_usuario}}</td> --}}
                                    <td>{{$usuario->nombre_completo}}</td>
                                    <td>{{$usuario->usuario}}</td>
                                    <td>{{$usuario->correo}}</td>
                                    <td>{{$usuario->name}}</td>
                                    <td>{{$usuario->estado}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success rounded-circle btn-circle"
                                            title="Editar" data-bs-toggle="modal"
                                            data-bs-target="#modalEditarUsuario_{{$usuario->id_usuario}}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        {{-- ============================== --}}
                                        <button type="button" class="btn btn-warning rounded-circle btn-circle"
                                            title="Cambiar contraseña" data-bs-toggle="modal"
                                            data-bs-target="#modalCambiarClave_{{$usuario->id_usuario}}">
                                            <i class="fa fa-key"></i>
                                        </button>
                                        {{-- ============================== --}}
                                        <button class="btn btn-danger rounded-circle btn-circle" data-bs-toggle="modal"
                                            data-bs-target="#modalCambiarEstado_{{$usuario->id_usuario}}"
                                            title="Cambiar Estado">
                                            <i class="fa fa-solid fa-recycle"></i>
                                        </button>
                                    </td>

                                    {{-- ====================================================== --}}
                                    {{-- ====================================================== --}}

                                    {{-- INICIO Modal CAMBIAR CONTRASEÑA --}}
                                    <div class="modal fade" id="modalCambiarClave_{{$usuario->id_usuario}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content border-0 p-3">
                                                <x-form
                                                    action="{{route('cambiar_clave', $usuario->id_usuario)}}"
                                                    method="POST"
                                                    class="mt-2"
                                                    id="formCambiarClave_{{$usuario->id_usuario}}"
                                                    autocomplete="off"
                                                >
                                                    <div class="rounded-top" style="border: solid 1px #337AB7">
                                                        <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7">
                                                            <h5>Cambiar Contraseña de: {{$usuario->nombre_usuario}}</h5>
                                                        </div>

                                                        <input type="hidden" name="id_usuario" value="{{$usuario->id_usuario}}" required >

                                                        {{-- ====================================================== --}}
                                                        {{-- ====================================================== --}}

                                                        <div class="modal-body p-0 m-0">
                                                            <div class="row m-0 pt-4 pb-4">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <x-input name="nueva_clave" type="text" label="Nueva Contraseña" id="nueva_clave_{{$usuario->id_usuario}}" autocomplete="password" required />
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6">
                                                                    <div class="form-group d-flex flex-column">
                                                                        <x-input name="confirmar_clave" type="text" label="Confirmar Contraseña" id="confirmar_clave_{{$usuario->id_usuario}}" autocomplete="password" required />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <!-- Contenedor para el GIF -->
                                                    <div id="loadingIndicatorEditClave_{{$usuario->id_usuario}}" class="loadingIndicator">
                                                        <img src="{{ asset('img/loading.gif') }}" alt="Procesando...">
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="d-flex justify-content-center mt-2">
                                                        <button type="button" class="btn btn-secondary me-3" id="btn_cancelar_clave_{{$usuario->id_usuario}}" data-bs-dismiss="modal">
                                                            <i class="fa fa-times"></i> Cancelar
                                                        </button>

                                                        <button type="submit" title="Guardar Configuración" class="btn btn-success" id="btn_editar_clave_{{$usuario->id_usuario}}">
                                                            <i class="fa-regular fa-floppy-disk"></i> Modificar
                                                        </button>
                                                    </div>
                                                </x-form> {{-- FIN x-form --}}
                                            </div> {{-- FIN modal-content --}}
                                        </div> {{-- FIN modal-dialog --}}
                                    </div> {{-- FIN modal fade modal-gral --}}
                                    {{-- FINAL Modal CAMBIAR CONTRASEÑA --}}

                                    {{-- ====================================================== --}}
                                    {{-- ====================================================== --}}

                                    {{-- INICIO Modal EDITAR USUARIO --}}
                                    <div class="modal fade" id="modalEditarUsuario_{{$usuario->id_usuario}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content border-0 p-3">
                                                <x-form
                                                    action="{{route('usuarios.update', $usuario->id_usuario)}}"
                                                    method="PUT"
                                                    class="mt-2"
                                                    id="formEditarUsuario_{{$usuario->id_usuario}}"
                                                    autocomplete="off"
                                                >
                                                    <input type="hidden" name="id_usuario" value="{{$usuario->id_usuario}}" required>
                                                    
                                                    <div class="rounded-top text-white text-center"
                                                        style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                        <h5 class="fw-bold" style="margin-top: 0.3rem; margin-bottom: 0.3rem;">Editar Usuario</h5>
                                                    </div>

                                                    <div class="modal-body p-0 m-0" style="border: solid 1px #337AB7;">
                                                        <div class="row m-4">
                                                            <div class="col-12 col-md-6">
                                                                <x-input
                                                                    name="nombre_usuario"
                                                                    type="text"
                                                                    label="Nombres"
                                                                    value="{{$usuario->nombre_usuario}}"
                                                                    id="nombre_usuario"
                                                                    autocomplete="given-name"
                                                                    required
                                                                />
                                                            </div>
                                                            
                                                            <div class="col-12 col-md-6">
                                                                <x-input
                                                                    name="apellido_usuario"
                                                                    type="text"
                                                                    label="Apellidos"
                                                                    value="{{$usuario->apellido_usuario}}"
                                                                    id="apellido_usuario"
                                                                    autocomplete="family-name"
                                                                    required
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="row m-4">
                                                            <div class="col-12 col-md-6">
                                                                <x-input
                                                                    name="correo"
                                                                    type="email"
                                                                    label="Correo"
                                                                    value="{{$usuario->correo}}"
                                                                    id="correo"
                                                                    autocomplete="email"
                                                                    required
                                                                />
                                                            </div>

                                                            <div class="col-12 col-md-6">
                                                                <x-select
                                                                    name="id_rol"
                                                                    label="Rol"
                                                                    id="id_rol"
                                                                    autocomplete="organization-title"
                                                                    required
                                                                >
                                                                    <option value="">Seleccionar...</option>
                                                                    @foreach($roles as $key => $value)
                                                                        <option value="{{$key}}" {{(isset($usuario) && $usuario->id_rol == $key) ? 'selected' : ''}}>
                                                                            {{$value}}
                                                                        </option>
                                                                    @endforeach
                                                                </x-select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer d-block mt-0 border border-0">
                                                        <!-- Contenedor para el GIF -->
                                                        <div id="loadingIndicatorEditUser_{{$usuario->id_usuario}}"
                                                            class="loadingIndicator">
                                                            <img src="{{ asset('img/loading.gif') }}" alt="Procesando...">
                                                        </div>

                                                        <div class="d-flex justify-content-center mt-3">
                                                            <button type="button" id="btn_cancelar_user_{{ $usuario->id_usuario }}"
                                                                class="btn btn-secondary me-3" data-bs-dismiss="modal">
                                                                <i class="fa fa-times"></i> Cancelar
                                                            </button>

                                                            <button type="submit" id="btn_editar_user_{{$usuario->id_usuario}}"
                                                                class="btn btn-success" title="Editar">
                                                                <i class="fa-regular fa-floppy-disk"></i> Editar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </x-form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- FINAL Modal EDITAR USUARIO --}}

                                    {{-- ====================================================== --}}
                                    {{-- ====================================================== --}}

                                    {{-- INICIO Modal ESTADO USUARIO --}}
                                    <div class="modal fade" id="modalCambiarEstado_{{$usuario->id_usuario}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content border-0 p-3">
                                                <x-form
                                                    action="{{route('usuarios.destroy', $usuario->id_usuario)}}"
                                                    method="DELETE"
                                                    class="mt-0"
                                                    id="formCambiarEstado_{{$usuario->id_usuario}}"
                                                    autocomplete="off"
                                                >
                                                    <div class="rounded-top" style="border: solid 1px #337AB7;">
                                                        <div class="rounded-top text-white text-center"
                                                            style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                            <h5>Cambiar estado de: <br>
                                                                <span class="text-warning">{{$usuario->nombre_usuario}}</span>
                                                            </h5>
                                                        </div>

                                                        <div class="mt-4 mb-4 text-center">
                                                            <span class="text-danger fs-5">¿Realmente desea cambiar el estado de esta usuario?</span>
                                                        </div>

                                                        <input type="hidden" name="id_usuario" value="{{$usuario->id_usuario}}" required >
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <!-- Contenedor para el GIF -->
                                                    <div id="loadingIndicatorEstado_{{$usuario->id_usuario}}"
                                                        class="loadingIndicator">
                                                        <img src="{{ asset('img/loading.gif') }}" alt="Procesando...">
                                                    </div>

                                                    {{-- ====================================================== --}}
                                                    {{-- ====================================================== --}}

                                                    <div class="d-flex justify-content-center mt-3">
                                                        <button type="button" id="btn_cancelar_estado_{{$usuario->id_usuario}}"
                                                            class="btn btn-secondary me-3" data-bs-dismiss="modal">
                                                            <i class="fa fa-times"></i> Cancelar
                                                        </button>

                                                        <button type="submit" id="btn_cambiar_estado_{{$usuario->id_usuario}}"
                                                            class="btn btn-success">
                                                            <i class="fa-regular fa-floppy-disk"></i> Cambiar
                                                        </button>
                                                    </div>
                                                </x-form> {{-- FIN x-form --}}
                                            </div> {{-- FIN modal-content --}}
                                        </div> {{-- FIN modal-dialog --}}
                                    </div> {{-- FIN modal --}}
                                    {{-- FINAL Modal ESTADO USUARIO --}}
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
            // INICIO DataTable Lista Usuarios
            $("#tbl_usuarios").DataTable({
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
            // CIERRE DataTable Lista Usuarios

            // ===========================================================================================
        
            function validatePassword(claveValor) {
                let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&+\-/_¿¡#.,:;=~^(){}\[\]<>`|"'])[A-Za-z\d@$!%*?&+\-/_¿¡#.,:;=~^(){}\[\]<>`|"']{6,}$/;
                if (!regex.test(claveValor)) {
                    return "La contraseña debe tener al menos una letra mayúscula, una letra minúscula, un número, un carácter especial, y ser de al menos 6 caracteres.";
                }
                return null;
            }

            // ===========================================================================================

            // formCrearUsuario para cargar gif en el submit
            $(document).on("submit", "form[id^='formCrearUsuario']", function(e) {
                e.preventDefault(); // Evita el envío si hay errores

                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorStore']");

                // Identificar campos de nueva clave y confirmación
                const clave = '#clave';
                const confirmarClave = '#confirmar_clave';

                let claveValor = $(clave).val();
                let confirmarClaveValor = $(confirmarClave).val();

                console.log(claveValor);
                console.log(confirmarClaveValor);

                if (claveValor.trim() === '' || confirmarClaveValor.trim() === '') {
                    Swal.fire('Cuidado!', 'Ambos campos de contraseña deben estar diligenciados!', 'warning');
                    return;
                }

                if (claveValor !== confirmarClaveValor) {
                    Swal.fire('Error!', 'Las contraseñas no coinciden!', 'error');
                    return;
                }

                // Validación de la seguridad de la contraseña
                let errorMessage = validatePassword(claveValor.trim());

                if (errorMessage) {
                    Swal.fire('Error!', errorMessage, 'error');
                    return;
                }

                // Dessactivar Botones
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                
                // Mostrar Spinner
                loadingIndicator.show();

                // Enviar formulario manualmente
                this.submit();
            });

            // ===========================================================================================
            
            // Botón de submit de editar usuario
            $(document).on("submit", "form[id^='formEditarUsuario_']", function(e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar el indicador de carga dinámicamente
                const submitButton = $(`#btn_editar_user_${id}`);
                const cancelButton = $(`#btn_cancelar_user_${id}`);
                const loadingIndicator = $(`#loadingIndicatorEditUser_${id}`);

                // Lógica del botón
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html(
                    "Procesando... <i class='fa fa-spinner fa-spin'></i>"
                );

                // Mostrar Spinner
                loadingIndicator.show();
            });

            // ===========================================================================================

            // formCambiarClave para cargar gif en el submit
            $(document).on("submit", "form[id^='formCambiarClave_']", function(e) {
                e.preventDefault(); // Evita el envío si hay errores

                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Identificar campos de nueva clave y confirmación
                const nuevaClave = `#nueva_clave_${id}`;
                const confirmarClave = `#confirmar_clave_${id}`;

                let nuevaClaveValor = $(nuevaClave).val();
                let confirmarClaveValor = $(confirmarClave).val();

                if (nuevaClaveValor.trim() === '' || confirmarClaveValor.trim() === '') {
                    Swal.fire('Cuidado!', 'Ambos campos de contraseña deben estar diligenciados!', 'warning');
                    return;
                }

                if (nuevaClaveValor !== confirmarClaveValor) {
                    Swal.fire('Error!', 'Las contraseñas no coinciden!', 'error');
                    return;
                }

                // Validación de la seguridad de la contraseña
                let errorMessage = validatePassword(nuevaClaveValor);

                if (errorMessage) {
                    Swal.fire('Error!', errorMessage, 'error');
                    return;
                }

                // Deshabilitar campos
                $(nuevaClave).prop("readonly", true);
                $(confirmarClave).prop("readonly", true);

                // Capturar el indicador de carga y botones dinámicamente
                const submitButton = $(`#btn_editar_clave_${id}`);
                const cancelButton = $(`#btn_cancelar_clave_${id}`);
                const loadingIndicator = $(`#loadingIndicatorEditClave_${id}`);

                // Lógica del botón
                loadingIndicator.show();
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");

                // Enviar formulario manualmente
                this.submit();
            });

            // ===========================================================================================

             // Botón de submit de editar usuario
             $(document).on("submit", "form[id^='formCambiarEstado_']", function(e) {
                const form = $(this);
                const formId = form.attr('id'); // Obtenemos el ID del formulario
                const id = formId.split('_')[1]; // Obtener el ID del formulario desde el ID del formulario

                // Capturar spinner y btns dinámicamente
                const loadingIndicator = $(`#loadingIndicatorEstado_${id}`);
                const submitButton = $(`#btn_cambiar_estado_${id}`);
                const cancelButton = $(`#btn_cancelar_estado_${id}`);

                // Deshabilitar btns, cargar Spinner
                loadingIndicator.show();
                cancelButton.prop("disabled", true);
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
            });
        }); // FIN document.ready
    </script>
@stop
