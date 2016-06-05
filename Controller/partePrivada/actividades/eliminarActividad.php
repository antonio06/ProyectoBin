<?php

session_start();
require_once '../../twig/lib/Twig/Autoloader.php';
require_once '../../../Model/BinDb.php';
require_once '../../../Model/Actividad.php';

if ($_SESSION['logeado'] == "Si") {
    if (isset($_POST['codigo_actividad'])) {
        $codigo_actividad = $_POST['codigo_actividad'];
        if (!empty($codigo_actividad)) {
            $aRespuesta = ['estado' => Actividad::delete($codigo_actividad)];
            echo json_encode($aRespuesta);
        }
    }
} else {
    header("Location: /Controller/partePublica/actividades.php");
}
