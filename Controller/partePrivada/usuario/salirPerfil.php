<?php
session_start();
if ($_SESSION['logeado'] == "Si") {

    session_destroy();
    header("Location: /Controller/partePublica/actividades.php");
}