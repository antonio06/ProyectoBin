<?php

session_start();
require_once '../../twig/lib/Twig/Autoloader.php';
require_once '../../../Model/BinDb.php';
require_once '../../../Model/Actividad.php';
require_once '../../../Model/Persona.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../../../View/partePrivada/');
$twig = new Twig_Environment($loader);

if ($_SESSION['logeado'] == "Si") {
    $limite = 2;
    $numeroPaginas = Actividad::getNumeroPaginas($limite);
    $listaDescriptores = Actividad::getDescriptoresActividad();
    $listaEstados = Actividad::getEstadosActividad();
    $arrayNumeros = [];
    $listaIVA = Actividad::getIvaActividad();
    $auxi = 0;
    for ($i = 1; $i <= $numeroPaginas; $i++) {
        if ($auxi <= $numeroPaginas) {
            $arrayNumeros[$auxi++] = $i;
        }
    }


    $totalPaginas = count($arrayNumeros);


    if (!isset($_GET['pagina'])) {

        $pagina = 1;
        if (isset($_SESSION['paginaActividades'])) {
            $pagina = $_SESSION['paginaActividades'];
        } else {
            $_SESSION['paginaActividades'] = $pagina;
        }
        $perfil_usuario = Persona::getPerfil_usuarioByEmail($_SESSION['email']);

        $actividades = Actividad::getActividadesByLimit(($pagina - 1) * $limite, $limite);
        if ($perfil_usuario == "Administrador") {


            $_SESSION['esAdministrador'] = "Si";
            echo $twig->render('actividades/gestionActividades.html.twig', ["actividades" => $actividades,
                "arrayNumeros" => crearIndicesPaginacion($pagina, $totalPaginas),
                "descriptores" => $listaDescriptores,
                "estados" => $listaEstados,
                "email" => $_SESSION['email'],
                "esAdministrador" => $_SESSION['esAdministrador'],
                "IVA" => $listaIVA,
                "pagina" => $pagina,
                "totalPaginas" => $totalPaginas
            ]);
        } else {
            echo $twig->render('actividades/gestionActividades.html.twig', ["actividades" => $actividades,
                "arrayNumeros" => crearIndicesPaginacion($pagina, $totalPaginas),
                "descriptores" => $listaDescriptores,
                "estados" => $listaEstados,
                "email" => $_SESSION['email'],
                "IVA" => $listaIVA,
                "pagina" => $pagina,
                "totalPaginas" => $totalPaginas
            ]);
        }
    } else {
        $pagina = $_GET['pagina'];
        if ($pagina > $numeroPaginas) {
            $pagina = $numeroPaginas;
        }
        $_SESSION['paginaActividades'] = $pagina;
        $perfil_usuario = Persona::getPerfil_usuarioByEmail($_SESSION['email']);
        $actividades = Actividad::getActividadesByLimit(($pagina - 1) * $limite, $limite);
        if ($perfil_usuario == "Administrador") {
            $_SESSION['esAdministrador'] = "Si";
            echo $twig->render('actividades/tablaActividades.html.twig', ["actividades" => $actividades,
                "arrayNumeros" => crearIndicesPaginacion($pagina, $totalPaginas),
                "descriptores" => $listaDescriptores,
                "estados" => $listaEstados,
                "email" => $_SESSION['email'],
                "esAdministrador" => $_SESSION['esAdministrador'],
                "IVA" => $listaIVA,
                "pagina" => $pagina,
                "totalPaginas" => $totalPaginas
            ]);
        } else {
            echo $twig->render('actividades/tablaActividades.html.twig', ["actividades" => $actividades,
                "arrayNumeros" => crearIndicesPaginacion($pagina, $totalPaginas),
                "descriptores" => $listaDescriptores,
                "estados" => $listaEstados,
                "email" => $_SESSION['email'],
                "IVA" => $listaIVA,
                "pagina" => $pagina,
                "totalPaginas" => $totalPaginas
            ]);
        }
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
