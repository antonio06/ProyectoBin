<?php

session_start();
require_once '../../twig/lib/Twig/Autoloader.php';
require_once '../../../Model/BinDb.php';
require_once '../../../Model/Persona.php';

if ($_SESSION['logeado'] == "Si") {
    if (isset($_POST['codigo_persona'])) {
        $codigo_persona = $_POST['codigo_persona'];
        if (!empty($codigo_persona)) {
            $aRespuesta = ['estado' => Persona::delete($codigo_persona)];
            echo json_encode($aRespuesta);
        }
    }
}else {
    header("Location: /Controller/partePublica/actividades.php");
}