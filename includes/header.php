<?php
if (!empty($_GET['page'])) {
    // Generar el breadcrumb basado en el módulo, submódulo y página actuales
    echo generarBreadcrumb(
        isset($_GET['modulo']) ? ucfirst($_GET['modulo']) : '',
        isset($_GET['submodulo']) ? ucfirst($_GET['submodulo']) : '',
        isset($_GET['page']) ? $_GET['page'] : ''
    );
}


?>