<?php

session_start();
require_once '../../twig/lib/Twig/Autoloader.php';
require_once '../../../Model/BinDb.php';
require_once '../../../Model/Actividad.php';
require_once '../../../Model/Persona.php';

if ($_SESSION['logeado'] == "Si") {
    $respuesta = ["estado" => "error", "errores" => []];
    $id = $_POST['id'];
    $codigo_persona = $_POST['codigo_persona'];

//    if (!Persona::findCodigoPersona($codigo_persona)) {
//        $respuesta["errores"][] = "La persona no pertenece a la lista.";
//    }
    
    $codigo_actividad = $_POST['codigo_actividad'];

    if (!Actividad::findCodigoActividad($codigo_actividad)) {
        $respuesta["errores"][] = "El titulo no pertenece a la lista de actividades.";
    }

    $codigo_perfil = $_POST['codigo_perfil'];

    if (!Actividad::findCodigoPerfil($codigo_perfil)) {
        $respuesta["errores"][] = "El perfil no pertenece a la lista de perfiles.";
    }

    if (Actividad::comprobarPerfilActividad($codigo_persona, $codigo_actividad, $codigo_perfil)) {
        $respuesta["errores"][] = "Esta persona ya está participando en la actividad.";
    } else {
        if ($participante = Actividad::updateParticipa($id, $codigo_persona, $codigo_actividad, $codigo_perfil)) {
            $respuesta["estado"] = "success";
            $respuesta["mensaje"] = "Participante modificado con éxito.";
        }else{
            $respuesta["errores"][] = "No se pudo modificar el registro en la base datos";
        }
    }




    echo json_encode($respuesta);
} else {
    header("Location: /Controller/partePublica/actividades.php");
}

