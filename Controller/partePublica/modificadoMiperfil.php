<?php

session_start();
require_once '../twig/lib/Twig/Autoloader.php';
require_once '../../Model/BinDb.php';
require_once '../../Model/Persona.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(__DIR__ . '/../../View/partePublica');
$twig = new Twig_Environment($loader);

if ($_SESSION['logeado'] == "Si") {
    switch ($_POST['opcion']) {
        case "modificar":
            $foto = file_get_contents($_FILES['foto']['tmp_name']);

            /*
            * Para la foto en vez de utilizar el método de almacenarlo en un fichero,
            * modificamos el campo foto en la BBDD de string a longblod, luego en el php
            * sobre el $_FILES que nos devuelve el html le hacemos un file_get_contents,
            * que transformara el fichero a cadena a eso le hacemos un addslashes,
            * que añadirá barras sobre los caracteres y a eso un base64_encode para
            * codificarlo a base 64 
            * MIRAR DOCUMENTACIÓN OFICIAL DE PHP
            * addslashes:http://php.net/manual/es/function.addslashes.php
            * file_get_contents: http://php.net/manual/es/function.file-get-contents.php
            *  base64_encode: http://php.net/manual/es/function.base64-encode.php
            */
        $foto = addslashes(base64_encode($foto));
            $persona = new Persona($_SESSION['codigo'], $_POST['DNI'],
                    $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'],
                    $_POST['perfil'], $foto, $_POST['sexo'],
                    $_POST['fecha_nac'], $_POST['direccion'], $_POST['municipio'],
                    $_POST['provincia'], $_POST['pais'], $_POST['fecha_alta'],
                    $_POST['fecha_baja'], $_POST['n_Seguridad_Social'],
                    $_POST['n_Cuenta_Bancaria'], $_POST['email'], NULL,
                    $_POST['perfil_usuario'], $_POST['observaciones']);
            $persona->update();
            header('Location: actividades.php');
            break;
        case "cancelar":
            header('Location: actividades.php');
            break;
        default :
    }
}else{
    header("Location: actividades.php");
}
