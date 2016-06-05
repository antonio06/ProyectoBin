<?php

session_start();
require_once '../twig/lib/Twig/Autoloader.php';
require_once '../../Model/BinDb.php';
require_once '../../Model/Persona.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../../View/partePublica');
$twig = new Twig_Environment($loader);
if ($_SESSION['logeado'] == "Si") {
    $persona = Persona::getPersonaByCodigo($_SESSION['codigo'], NULL);
    //$perfilesUsuarios = Persona::getPerfiles_usuariosPersona();
    $perfil = Persona::getPerfilByCodigo($_SESSION['codigo']);
    $sexo = Persona::getSexoPersona();
    $perfil_usuario = Persona::getPerfil_usuarioByEmail($_SESSION['email']);
    echo $twig->render('miPerfil.html.twig', ["persona" => $persona,
        "perfil_usuario" => $perfil_usuario,
        "perfil" => $perfil, "sexo" => $sexo, "email" => $_SESSION['email']]);
}else{
    header("Location: actividades.php");
}

