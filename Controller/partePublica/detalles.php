<?php

session_start();
//require_once '../twig/lib/Twig/Autoloader.php';
require_once '../../Model/BinDb.php';
require_once '../../Model/Actividad.php';
//Twig_Autoloader::register();
//$loader = new Twig_Loader_Filesystem(__DIR__ . '/../View/partePublica');
//$twig = new Twig_Environment($loader);

if (isset($_SESSION['logeado'])) {
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
    //echo $twig->render('detalle_formulario.html.twig', ["actividad" => $actividad, "email" => $_SESSION['email']]);
} else {
    if (isset($_GET['codigo_actividad'])) {
        $aRespuesta = NULL;
        $actividad = Actividad::getActividadByCodigo($_GET['codigo_actividad']);
        $_SESSION['codigo_actividad'] = $_GET['codigo_actividad'];
        if ($actividad) {
            $aRespuesta = [
                "actividad" => $actividad->toJSON(),
                    //"participa" => $actividad->comprobarEnActividad($_SESSION['codigo'])
            ];
        }
        echo json_encode($aRespuesta);
    }
}