<?php

session_start();

require_once '../../../Model/BinDb.php';
require_once '../../../Model/Actividad.php';
require_once '../../../Model/Persona.php';

if ($_SESSION['logeado'] == "Si") {
    if (isset($_POST['codigo_actividad'])) {
        $codigo_persona = $_SESSION['codigo'];
        $codigo_actividad = $_POST['codigo_actividad'];
        $codigo_perfil = Actividad::getCodigoPerfil('participante');

        $miActividad = Actividad::insertParticipante($codigo_persona, $codigo_actividad, $codigo_perfil);
        $aRespuesta = ["estado" => FALSE];
        if ($miActividad) {
            $aRespuesta["estado"] = TRUE;
        }
        echo json_encode($aRespuesta);
    }
} else {
    header("Location: ../partePublica/actividades.php");
}