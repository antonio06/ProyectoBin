<?php
session_start();
require_once '../twig/lib/Twig/Autoloader.php';
require_once '../../Model/BinDb.php';
require_once '../../Model/Persona.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../../View/partePrivada');
$twig = new Twig_Environment($loader);
if ($_SESSION['logeado'] == "Si"){
    //$_SESSION['codigo_persona'] = Persona::getCodigoByEmail($_SESSION['email']);
   echo $twig->render('panelPrincipal.html.twig', ["email" => $_SESSION['email']]);
}else {
    header("Location: ../partePublica/actividades.php");
}
