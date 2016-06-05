<?php

session_start();
require_once '../../../Model/BinDb.php';
require_once '../../../Model/Persona.php';

if ($_SESSION['logeado'] == "Si") {
    if (isset($_GET['codigo_persona'])) {
        $aRespuesta = NULL;
        $persona = Persona::getPersonaByCodigo($_GET['codigo_persona'], TRUE);
        if ($persona) {
            $aRespuesta = [
                "persona" => $persona->toArray()
            ];
        }
        echo json_encode($aRespuesta);
    }
} else {
    header("Location: /partePublica/actividades.php");
}
