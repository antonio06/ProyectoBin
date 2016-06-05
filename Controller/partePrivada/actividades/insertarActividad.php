<?php

session_start();
require_once '../../twig/lib/Twig/Autoloader.php';
require_once '../../../Model/BinDb.php';
require_once '../../../Model/Actividad.php';

if ($_SESSION['logeado'] == "Si") {
    $respuesta = ["estado" => "error", "errores" => []];
    
    $titulo = trim($_POST['titulo']);
    if (empty($titulo)) {
        $respuesta["errores"][] = "El título no puede estar vacío.";
    }

    $estado = $_POST["estado"];
    $listaEstados = Actividad::getEstadosActividad();
    if (!in_array($estado, $listaEstados)) {
        $respuesta["errores"][] = "El estado no pertenece a la lista de estados.";
    }

    $iva = $_POST["IVA"];
    $listaIVA = Actividad::getIvaActividad();
    if (!in_array($iva, $listaIVA)) {
        $respuesta["errores"][] = "El IVA no pertenece a la lista de IVAs.";
    }

    $descriptor = $_POST["descriptor"];
    $listaDescriptores = Actividad::getDescriptoresActividad();
    if (!in_array($descriptor, $listaDescriptores)) {
        $respuesta["errores"][] = "El descriptor no pertenece a la lista de descriptores.";
    }

    if (empty($respuesta["errores"])) {
        $actividad = new Actividad("", $titulo, $estado, $_POST['coordinador'], $_POST['ponente'], $_POST['ubicacion'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['horario_inicio'], $_POST['horario_fin'], $_POST['n_Total_Horas'], $_POST['precio'], $iva, $descriptor, $_POST['observaciones']);
        if($actividad->insert()){
            $respuesta["estado"] = "success";
            $respuesta["mensaje"] = "Actividad registrada con éxito.";
        }
    }

    echo json_encode($respuesta);
} else {
    header("Location: /Controller/partePublica/actividades.php");
}