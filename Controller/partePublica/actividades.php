<?php

session_start();
// Cargamos la librería de twig y las clases de la base de datos de BindDB y 
// de la clase de actividad
require_once '../twig/lib/Twig/Autoloader.php';
require_once '../../Model/BinDb.php';
require_once '../../Model/Actividad.php';
require_once '../../Model/Persona.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../../View/partePublica');
$twig = new Twig_Environment($loader);
$listaDescriptores = Actividad::getDescriptoresActividad();

$listaEstados = Actividad::getEstadosActividad();
$limite = 2;
$numeroPaginas = Actividad::getNumeroPaginas($limite);
$arrayNumeros = [];
$auxi = 0;

for ($i = 1; $i <= $numeroPaginas; $i++) {
    if ($auxi <= $numeroPaginas) {
        $arrayNumeros[$auxi++] = $i;
    }
}

$totalPaginas = count($arrayNumeros);

if (isset($_SESSION['logeado'])) {
    if (!isset($_GET['pagina'])) {
        $pagina = 1;
        if (isset($_SESSION['paginaActividades'])) {
            $pagina = $_SESSION['paginaActividades'];
        } else {
            $_SESSION['paginaActividades'] = $pagina;
        }
        $actividades = Actividad::getActividadesByLimit(($pagina - 1) * $limite, $limite);
        echo $twig->render('actividades.html.twig', [
            "actividades" => $actividades,
            "arrayNumeros" => crearIndicesPaginacion($pagina, $totalPaginas),
            "email" => $_SESSION['email'],
            "pagina" => $pagina,
            "totalPaginas" => $totalPaginas]);
    } else {
        $pagina = $_GET['pagina'];
        $_SESSION['paginaActividades'] = $pagina;
        $actividades = Actividad::getActividadesByLimit(($pagina - 1) * $limite, $limite);
        echo $twig->render('tablaActividades.html.twig', [
            "actividades" => $actividades,
            "arrayNumeros" => crearIndicesPaginacion($pagina, $totalPaginas),
            "email" => $_SESSION['email'],
            "pagina" => $pagina,
            "totalPaginas" => $totalPaginas
        ]);
    }
} else {
    if (!isset($_GET['pagina'])) {
        $pagina = 1;
        if (isset($_SESSION['paginaActividades'])) {
            $pagina = $_SESSION['paginaActividades'];
        } else {
            $_SESSION['paginaActividades'] = $pagina;
        }
        $actividades = Actividad::getActividadesByLimit(($pagina - 1) * $limite, $limite);
        echo $twig->render('actividades.html.twig', [
            "actividades" => $actividades,
            "arrayNumeros" => crearIndicesPaginacion($pagina, $totalPaginas),
            "pagina" => $pagina,
            "totalPaginas" => $totalPaginas
        ]);
    } else {
        $pagina = $_GET['pagina'];
        $_SESSION['paginaActividades'] = $pagina;
        $actividades = Actividad::getActividadesByLimit(($pagina - 1) * $limite, $limite);
        echo $twig->render('tablaActividades.html.twig', [
            "actividades" => $actividades,
            "arrayNumeros" => crearIndicesPaginacion($pagina, $totalPaginas),
            "pagina" => $pagina,
            "totalPaginas" => $totalPaginas
        ]);
    }
}

function crearIndicesPaginacion($pagina, $totalPaginas) {
    $arrayNumeros = [];
    $inicio = NULL;
    $fin = NULL;

    if ($totalPaginas == 1) {
        return [];
    }

    if ($totalPaginas <= 5) {
        // Mostrar de 1 a $totalPaginas
        $inicio = 1;
        $fin = $totalPaginas;
    } else {
        if ($pagina <= 3) {
            // Muestra los 5 primeros
            $inicio = 1;
            $fin = 5;
        } else if ($pagina > 3 && $pagina < $totalPaginas - 2) {
            // Rota los numeros dejando $pagina en el centro 
            $inicio = $pagina - 2;
            $fin = $pagina + 2;
        } else {
            // Muestra los 5 ultimos
            $inicio = $totalPaginas - 5 + 1;
            $fin = $totalPaginas;
        }
    }

    for ($i = $inicio; $i <= $fin; $i++) {
        $arrayNumeros[] = $i;
    }

    return $arrayNumeros;
}
