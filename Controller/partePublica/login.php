<?php

session_start();
require_once '../../Model/BinDb.php';
require_once '../../Model/Persona.php';
$email = $_POST['email'];
$codigo = "";
$password = Persona::getPasswordByCodigo($codigo, $email);
$contrasenaIntroducida = $_POST['password'];
$perfil_usuario = Persona::getPerfil_usuarioByEmail($email);
$emailObtenido = Persona::getEmailByEmail($email);
//var_dump($perfil_usuario);
if ((password_verify($contrasenaIntroducida, $password)) && ($email == $emailObtenido)) {
    if (($perfil_usuario == "Administrador") || ($perfil_usuario == "Limitado")) {
        $_SESSION['email'] = $email;
        $_SESSION['logeado'] = "Si";
        $_SESSION['codigo'] = Persona::getCodigoByEmail($_SESSION['email']);
        header("Location: ../partePrivada/panelPrincipal.php");
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['logeado'] = "Si";
        $_SESSION['codigo'] = Persona::getCodigoByEmail($_SESSION['email']);
        header("Location: actividades.php");
    }
} else {
    header("Location: formulario_login.php");
}