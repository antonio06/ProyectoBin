<?php

session_start();
require_once '../../../Model/BinDb.php';
require_once '../../../Model/Actividad.php';
if ($_SESSION['logeado'] == "Si") {
    if (isset($_GET['codigo_actividad'])) {
        $aRespuesta = NULL;
        $actividad = Actividad::getActividadByCodigo($_GET['codigo_actividad']);
        $_SESSION['codigo_actividad'] = $_GET['codigo_actividad'];
        if ($actividad) {
            $aRespuesta = [
                "actividad" => $actividad->toJSON(),
                "participa" => $actividad->comprobarEnActividad($_SESSION['codigo'])
            ];
        }
        echo json_encode($aRespuesta);
    }
} else {
    header("Location: /Controller/partePublica/actividades.php");
}