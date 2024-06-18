<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="Assets/img/avatar.png" alt="Bootstrap" width="24" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuarios
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" aria-current="page" href="?page=login&modulo=usuarios">Inicio</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="dropdown-item" href="?page=registro&modulo=usuarios">Registrar Usuarios</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="dropdown-item" href="?page=listado_usuarios&modulo=usuarios">Listar Usuarios</a>
                        </li>
                        <hr class="dropdown-divider">
                        <li class="nav-item">
                        <span class="dropdown-item"><strong>Perfiles</strong></span>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item" href="?page=alta_perfiles&modulo=usuarios&submodulo=perfiles">Agregar Perfiles</a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item" href="?page=listado_perfiles&modulo=usuarios&submodulo=perfiles">Listar Perfiles</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=alta_producto&modulo=productos">Agregar Productos</a></li>
                        <li><a class="dropdown-item" href="?page=listado_producto&modulo=productos">Ver Productos</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="?page=alta_marca&modulo=productos">Agregar marca</a></li>
                        <li><a class="dropdown-item" href="?page=listado_marca&modulo=productos">Ver de Marcas</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="?page=alta_rubro&modulo=productos">Agregar rubro</a></li>
                        <li><a class="dropdown-item" href="?page=listado_rubro&modulo=productos">Ver de rubros</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Personas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=alta_persona&modulo=personas">Agregar Persona</a></li>
                        <li><a class="dropdown-item" href="?page=listado_persona&modulo=personas">Ver Personas</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="?page=alta_empleado&modulo=personas&submodulo=empleado">Agregar Empleado</a></li>
                        <li><a class="dropdown-item" href="?page=listado_empleado&modulo=personas&submodulo=empleado">Ver Empleado</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="?page=alta_proveedor&modulo=personas&submodulo=proveedor">Agregar Proveedores</a></li>
                        <li><a class="dropdown-item" href="?page=listado_proveedor&modulo=personas&submodulo=proveedor">Ver Proveedores</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="?page=alta_tipodocumento&modulo=personas&submodulo=documento">Agregar Tipo Documento</a></li>
                        <li><a class="dropdown-item" href="?page=listado_tipodocumento&modulo=personas&submodulo=documento">Ver Tipo Documentos</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="?page=alta_tipocontacto&modulo=personas&submodulo=contacto">Agregar Tipo Contacto</a></li>
                        <li><a class="dropdown-item" href="?page=listado_tipocontacto&modulo=personas&submodulo=contacto">Ver Tipo Contactos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tipo Egreso
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=alta_tipoegreso&modulo=caja&submodulo=egreso">Agregar Tipo Egreso</a></li>
                        <li><a class="dropdown-item" href="?page=listado_tipoegreso&modulo=caja&submodulo=egreso">Ver Tipo Egreso</a></li>
                        <li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=salida&modulo=usuarios">Cerra Sesion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>