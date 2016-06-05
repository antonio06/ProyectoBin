<?php

session_start();
require_once '../../twig/lib/Twig/Autoloader.php';
require_once '../../../Model/BinDb.php';
require_once '../../../Model/Actividad.php';
require_once '../../../Model/Persona.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../../../View/partePrivada/');
$twig = new Twig_Environment($loader);
//$participantes = Actividad::getParticipantes();
if ($_SESSION['logeado'] == "Si") {
    $limite = 2;
    $numeroPaginas = Actividad::getNumeroPaginasParticipa($limite, $_SESSION['codigo']);
    $arrayNumeros = [];
    $auxi = 0;
    for ($i = 1; $i <= $numeroPaginas; $i++) {
        if ($auxi <= $numeroPaginas) {
            $arrayNumeros[$auxi++] = $i;
        }
    }

    $totalPaginas = count($arrayNumeros);

    if (!isset($_GET['pagina'])) {
        $pagina = 1;
        if (isset($_SESSION['paginaMisActividades'])) {
            $pagina = $_SESSION['paginaMisActividades'];
        } else {
            $_SESSION['paginaMisActividades'] = $pagina;
        }
        
        $participantes = Actividad::getParticipantesByLimit(($pagina - 1) * $limite, $limite, $_SESSION['codigo']);
        $perfil_usuario = Persona::getPerfil_usuarioByEmail($_SESSION['email']);
        echo $twig->render('usuario/misActividades.html.twig', [
            "participantes" => $participantes,
            "arrayNumeros" => crearIndicesPaginacion($pagina, $totalPaginas),
            "email" => $_SESSION['email'],
            "pagina" => $pagina,
            "totalPaginas" => $totalPaginas
            ]);
    } else {
        $pagina = $_GET['pagina'];
        $_SESSION['paginaMisActividades'] = $pagina;
        $perfil_usuario = Persona::getPerfil_usuarioByEmail($_SESSION['email']);
        $participantes = Actividad::getParticipantesByLimit(($pagina - 1) * $limite, $limite, $_SESSION['codigo']);
        echo $twig->render('usuario/tablaMisActividades.html.twig', [
            "participantes" => $participantes,
            "arrayNumeros" => crearIndicesPaginacion($pagina, $totalPaginas),
            "email" => $_SESSION['email'],
            "pagina" => $pagina,
            "totalPaginas" => $totalPaginas
        ]);
    }
} else {
    header("Location: /Controller/partePublica/actividades.php");
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
