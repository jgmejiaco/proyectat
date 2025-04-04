<style>
    /* Cambia el color de fondo del li al pasar el ratón sobre él */
    /* .hover-li:hover {
      background-color: #337AB7;
    } */
</style>

<header class="topbar m-0">
    <nav class="navbar navbar-expand-lg m-0 text-white" data-bs-theme="dark" style="background-color: #337AB7">
        <div class="row p-0 w-100 align-items-lg-center justify-content-between">
            <div class="logo-container col-4 col-md-2 text-center">
                <a class="w-100" href="/home">
                    <img src="{{asset('img/proyectat_logo.png')}}" alt="Logo" width="160" height="50" class="text-center">
                </a>
            </div>
            {{-- ========================================== --}}
            <div class="menu-container col-4 col-md-8">
                <div class="collapse d-lg-flex justify-content-lg-end" id="navbarNavDropdown">
                    <ul class="navbar-nav justify-content-between">
                        <li class="nav-item dropdown">
                            <a href="#" title="Notificaciones" class="nav-link text-white" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-users"></i>
                            </a>
                            <ul class="dropdown-menu bg-white" style="right:0;left:auto">
                                <li class="nav-item">
                                    <a href="{{route('usuarios.index')}}" class="dropdown-item text-dark hover-li"><i class="fa-solid fa-users"></i> Ver Usuarios</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="dropdown-item text-dark hover-li"><i class="fa-solid fa-user-plus"></i> Crear Usuario</a>
                                </li>
                            </ul>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown">
                            <a href="#" title="Notificaciones" class="nav-link text-white" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell fa-1x"></i>
                                <span id="notificaciones_stock" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">0</span>
                            </a>
                            <ul class="dropdown-menu bg-white" style="right:0;left:auto">
                                <li class="nav-item">
                                    <a href="" class="dropdown-item text-dark hover-li"><i class="fas fa-cubes fa-fw"></i> Usuarios</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="dropdown-item text-dark hover-li"><i class="fas fa-money fa-fw"></i> Hay Préstamos a punto de vencer</a>
                                </li>
                            </ul>
                        </li>

                        {{-- ==================== --}}

                        <li class="nav-item dropdown" data-bs-toggle="modal" data-bs-target="#modal_usuario">
                            <a  href="#" title="Usuario" class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user fa-fw fa-1x"></i>
                            </a>

                            @if(session('sesion_iniciada'))
                                <ul class="dropdown-menu bg-white" style="right:0;left:auto">
                                    <li class="dropdown-item text-dark hover-li">
                                        <i class="fa fa-user fa-fw fa-1x"></i>SuperAdmin
                                        <h6 class="text-danger">Jenny</h6>
                                    </li>

                                    <li class="dropdown-item text-dark hover-li">
                                        <i class="fa fa-sign-out fa-fw fa-1x">
                                            <a href="" class="" style="text-decoration: none;">Cerrar Sesión</a>
                                        </i>
                                    </li>
                                </ul>
                            @else
                                <ul class="dropdown-menu bg-white" style="right:0;left:auto">
                                    <li class="dropdown-item text-dark hover-li">
                                        <i class="fa fa-sign-out fa-fw fa-1x">
                                            <a href="" class="" style="text-decoration: none;">Cerrar Sesión</a>
                                        </i>
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

{{-- ====================================================================== --}}
{{-- ====================================================================== --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        
    }); // FIN DOMContentLoaded
</script>

