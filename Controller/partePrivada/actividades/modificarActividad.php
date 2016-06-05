<?php

session_start();
require_once '../../twig/lib/Twig/Autoloader.php';
require_once '../../../Model/BinDb.php';
require_once '../../../Model/Actividad.php';

if ($_SESSION['logeado'] == "Si") {
    if (isset($_POST['codigo_actividad'])) {
        // Validar los datos que se envían desde JavaScript
        $respuesta = ["estado" => "error", "errores" => []]; //, "valorEstado" => $_POST["estado"]];

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
            $actividad = new Actividad($_POST['codigo_actividad'], $titulo, $estado, $_POST['coordinador'], $_POST['ponente'], $_POST['ubicacion'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['horario_inicio'], $_POST['horario_fin'], $_POST['n_Total_Horas'], $_POST['precio'], $iva, $descriptor, $_POST['observaciones']);
            if ($consulta = $actividad->update()) {
                $respuesta["consulta"] = $consulta;
                $respuesta["estado"] = "success";
                $respuesta["mensaje"] = "Actividad modificada con éxito.";
            }
        }

        echo json_encode($respuesta);
    }
} else {
    header("Location: /Controller/partePublica/actividades.php");
}
