<?php
session_start();
if ($_SESSION['logeado'] == "Si") {

    session_destroy();
    header("Location:../partePublica/actividades.php");
}