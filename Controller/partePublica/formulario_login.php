<?php
session_start();
// Cargamos la librería de twig y las clases de la base de datos de BindDB y 
// de la clase de actividad
require_once '../twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../../View/partePublica');
$twig = new Twig_Environment($loader);
if (isset($_SESSION['logeado'])) {
    echo $twig->render('formulario_login.html.twig', ["email" => $_SESSION['email']]);
}else{
    echo $twig->render('formulario_login.html.twig', []);
}
