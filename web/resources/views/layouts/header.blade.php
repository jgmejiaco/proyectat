<header class="m-0">
    <nav class="navbar navbar-expand-lg text-white" data-bs-theme="dark" style="background-color: #337AB7">
        <div class="row p-0 w-100 align-items-lg-center justify-content-between">
            <div class="logo-container col-3 col-md-3 text-center p-0">
                <a class="" href="{{route('inicio.index')}}">
                    <img src="{{asset('img/proyectat_logo.png')}}" alt="Logo" width="160" height="50" class="text-center">
                </a>
            </div>
            {{-- ========================================== --}}
            <div class="menu-container col-9 col-md-9 p-0">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>
                <div class="collapse d-lg-flex justify-content-lg-end" id="navbarNavDropdown">
                    <ul class="navbar-nav justify-content-between">
                        <li class="nav-item dropdown">
                            <a href="#" role="button" class="nav-link dropdown-toggle text-white fw-bold" data-bs-toggle="dropdown" aria-expanded="false">Informe Producción</a>
                            <ul class="dropdown-menu bg-white">
                                <li><a href="{{route('lineas_personales.index')}}" class="dropdown-item text-black hover-li">Líneas Personales</a></li>
                                <li><a href="{{route('lineas_personales.create')}}" class="dropdown-item text-black hover-li">Crear Radicado</a></li>
                            </ul>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown">
                            <a href="#" role="button" class="nav-link dropdown-toggle text-white fw-bold" data-bs-toggle="dropdown" aria-expanded="false">Auxiliares</a>
                            <ul class="dropdown-menu bg-white">
                                <li><a href="{{route('aseguradoras.index')}}" class="dropdown-item text-black hover-li">Aseguradoras</a></li>
                                <li><a href="{{route('consultores.index')}}" class="dropdown-item text-black hover-li">Consultores</a></li>
                                <li><a href="{{route('estados.index')}}" class="dropdown-item text-black hover-li">Estados</a></li>
                                <li><a href="{{route('frecuencias.index')}}" class="dropdown-item text-black hover-li">Frecuencias</a></li>
                                {{-- <li><a href="{{route('gerentes.index')}}" class="dropdown-item text-black hover-li">Gerentes</a></li> --}}
                                <li><a href="{{route('productos.index')}}" class="dropdown-item text-black hover-li">Productos</a></li>
                                <li><a href="{{route('ramos.index')}}" class="dropdown-item text-black hover-li">Ramos</a></li>
                                <li><a href="{{route('roles.index')}}" class="dropdown-item text-black hover-li">Roles</a></li>
                            </ul>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item">
                            <a href="{{route('usuarios.index')}}" title="Usuarios" class="nav-link text-white fw-bold">Usuarios</a>
                        </li>

                        {{-- ==================== --}}
                        
                        {{-- <li class="nav-item">
                            <a href="{{route('permisos.index')}}" title="Permisos" class="nav-link text-white fw-bold">Permisos</a>
                        </li> --}}

                        {{-- ==================== --}}

                        <li class="nav-item dropdown" data-bs-toggle="modal" data-bs-target="#modal_usuario">
                            <a  href="#" title="Usuario" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user fa-fw fa-1x"></i>
                            </a>

                            @if(session('sesion_iniciada'))
                                <ul class="dropdown-menu bg-white" style="right:0;left:auto">
                                    <li class="dropdown-item text-dark hover-li">
                                        <i class="fa fa-user fa-fw fa-1x"></i> {{$usuarioLogueado->rol}}
                                        <h6 class="text-danger">{{$usuarioLogueado->nombre_usuario}} {{$usuarioLogueado->apellido_usuario}}</h6>
                                    </li>

                                    <li class="dropdown-item text-dark hover-li">
                                        <i class="fa fa-sign-out fa-fw fa-1x"></i>
                                        <a href="{{route('logout')}}" class="" style="text-decoration: none;">Cerrar Sesión</a>
                                    </li>
                                </ul>
                            @else
                                <ul class="dropdown-menu bg-white" style="right:0;left:auto">
                                    <li class="dropdown-item text-dark hover-li">
                                        <i class="fa fa-sign-out fa-fw fa-1x"></i>
                                        <a href="{{route('logout')}}" class="" style="text-decoration: none;">Cerrar Sesión</a>
                                    </li>
                                </ul>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
