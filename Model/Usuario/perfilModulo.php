<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class PerfilModulo
{

    public function obtenerModulosPorPerfil($idPerfil)
{
    $conexion = new Conexion;
    $query = "SELECT modulos_idmodulos FROM perfiles_has_modulos WHERE perfiles_idperfiles = " . $idPerfil . " AND estado = 1";
    $resultado = $conexion->consultar($query);
    $modulosAsignados = [];

    while ($row = $resultado->fetch_assoc()) {
        $modulosAsignados[] = $row['modulos_idmodulos'];  // Guardar los IDs de los módulos asignados
    }

    return $modulosAsignados; // Devuelve el array de IDs de módulos
}


    


    public function guardarModulosPorPerfil($idPerfil, $modulos)
    {
        // Borrado logico de todos los modulos existentes en el perfil

        $conexion = new Conexion;
        $query = "UPDATE perfiles_has_modulos SET estado = 0 WHERE perfiles_idperfiles = " . $idPerfil;
        $conexion->actualizar($query);

        // Insertar los nuevos modulos
        foreach ($modulos as $modulos_id) {
            // Verficar si el modulo ya existe para el perfil

            $query = "SELECT COUNT(*) as count FROM perfiles_has_modulos WHERE perfiles_idperfiles = " .$idPerfil. " AND modulos_idmodulos =".$modulos_id;
            // echo $query;
            // exit();
            $resultado = $conexion->consultar($query);
            $row = $resultado->fetch_assoc();
            if($row['count'] > 0) {
                $query = "UPDATE perfiles_has_modulos SET estado = 1 WHERE perfiles_idperfiles = " .$idPerfil. " AND modulos_idmodulos =".$modulos_id;
                $conexion->actualizar($query);
            }else{
                $query = "INSERT INTO perfiles_has_modulos(perfiles_idperfiles, modulos_idmodulos) VALUES (" . $idPerfil . ", " . $modulos_id.")";
                // echo $query;
                // exit();
                $conexion->insertar($query);
            }


            
        }
    }
}
