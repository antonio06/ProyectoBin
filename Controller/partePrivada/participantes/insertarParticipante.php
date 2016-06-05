<?php

session_start();
require_once '../../twig/lib/Twig/Autoloader.php';
require_once '../../../Model/BinDb.php';
require_once '../../../Model/Actividad.php';
require_once '../../../Model/Persona.php';

if ($_SESSION['logeado'] == "Si") {
    $respuesta = ["estado" => "error", "errores" => []];
    $codigo_persona = $_POST['nombre'];

    if (!Persona::findCodigoPersona($codigo_persona)) {
        $respuesta["errores"][] = "La persona no pertenece a la lista.";
    }

    $codigo_actividad = $_POST['titulo'];

    if (!Actividad::findCodigoActividad($codigo_actividad)) {
        $respuesta["errores"][] = "El titulo no pertenece a la lista de actividades.";
    }

    $codigo_perfil = $_POST['perfil'];

    if (!Actividad::findCodigoPerfil($codigo_perfil)) {
        $respuesta["errores"][] = "El perfil no pertenece a la lista de perfiles.";
    }

    if (Actividad::comprobarPerfilActividad($codigo_persona, $codigo_actividad, $codigo_perfil)) {
        $respuesta["errores"][] = "Esta persona ya está participando en la actividad.";
    } else {
        if ($participante = Actividad::insertParticipante($codigo_persona, $codigo_actividad, $codigo_perfil)) {
            $respuesta["estado"] = "success";
            $respuesta["mensaje"] = "Participante registrado con éxito.";
        }else{
            $respuesta["errores"][] = "No se pudo insertar el registro en la base datos";
        }
    }




    echo json_encode($respuesta);
} else {
    header("Location: /Controller/partePublica/actividades.php");
}