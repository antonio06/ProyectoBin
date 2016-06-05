<?php

session_start();
require_once '../twig/lib/Twig/Autoloader.php';
require_once '../../Model/BinDb.php';
require_once '../../Model/Actividad.php';

if ($_SESSION['logeado'] == "Si") {
    
    if (isset($_POST['id'])) {
        if (!empty($_POST['id'])) {
            $aRespuesta = ['estado' => Actividad::deleteParticipa($_POST['id'])];
            echo json_encode($aRespuesta);
        }
    }
}else {
    header("Location: /Controller/partePublica/actividades.php");
}
