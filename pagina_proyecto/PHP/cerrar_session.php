<?php 
    session_start();

    $varsession = $_SESSION["usuario"];
    if ($varsession == NULL || $varsession == '') {
        header("Location: ../PHP/inicio-sesion.php");
        die(); // Detén la ejecución del script actual   
    }

    session_destroy();
    header("Location: ../HTML/index.html");
?>