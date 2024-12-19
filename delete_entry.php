<?php
    require_once "includes/funktionen.inc.php";
    session_start();

    if (!ist_eingeloggt()) {
        header("Location: index.php");
        exit;
    }

    $delete_idx = $_GET["delete_idx"];

    delete_eintrag($delete_idx);

    header("Location: index.php");
?>