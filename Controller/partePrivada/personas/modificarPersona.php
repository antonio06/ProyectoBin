<?php

session_start();

require_once '../../../Model/BinDb.php';
require_once '../../../Model/Persona.php';
require_once '../../../Model/Actividad.php';

if ($_SESSION['logeado'] == "Si") {
    $respuesta = ["estado" => "error", "errores" => []];

    $DNI = trim($_POST['DNI']);
    if (empty($DNI)) {
        $respuesta["errores"][] = "El DNI no puede estar vacío.";
    }

    $nombre = trim($_POST['nombre']);
    if (empty($nombre)) {
        $respuesta["errores"][] = "El nombre no puede estar vacío.";
    }

    $apellido1 = trim($_POST['apellido1']);
    if (empty($apellido1)) {
        $respuesta["errores"][] = "El 1º apellido no puede estar vacío.";
    }

    $apellido2 = trim($_POST['apellido2']);
    if (empty($apellido1)) {
        $respuesta["errores"][] = "El 2º apellido no puede estar vacío.";
    }

    $perfil = $_POST['perfil'];
    if (!Actividad::findCodigoPerfil($perfil)) {
        $respuesta["errores"][] = "El perfil no pertenece a la lista de perfiles.";
    }

    $sexo = $_POST['sexo'];
    if (!Persona::findSexoPersona($sexo)) {
        $respuesta["errores"][] = "El sexo no pertenece a la lista de sexos.";
    }

    $fecha_nac = trim($_POST['fecha_nac']);
    if (empty($apellido1)) {
        $respuesta["errores"][] = "La fecha de nacimiento no puede estar vacía.";
    }

    $email = trim($_POST['email']);
    if (empty($apellido1)) {
        $respuesta["errores"][] = "El email  no puede estar vacío.";
    }

    $perfil_usuario = $_POST['perfil_usuario'];
    if (!Persona::findPerfil_usuario($perfil_usuario)) {
        $respuesta["errores"][] = "El perfil de usuario no pertenece a la lista de perfiles.";
    }
    
    if (empty($respuesta["errores"])) {
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
        $persona = new Persona($_POST['codigo_persona'], $_POST['DNI'],
                $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'],
                $perfil, $foto, $_POST['sexo'], $_POST['fecha_nac'],
                $_POST['direccion'], $_POST['municipio'], $_POST['provincia'],
                $_POST['pais'], $_POST['fecha_alta'], $_POST['fecha_baja'],
                $_POST['n_Seguridad_Social'], $_POST['n_Cuenta_Bancaria'],
                $_POST['email'], NULL, $_POST['perfil_usuario'], $_POST['observaciones']);
        if ($persona->update()){
            $respuesta["estado"] = "success";
            $respuesta["mensaje"] = "Persona modificada con éxito."; 
        }
        
    }
    echo json_encode($respuesta);
} else {
    header("Location: ../partePublica/actividades.php");
}
