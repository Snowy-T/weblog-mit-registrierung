<?php
require_once 'includes/funktionen.inc.php';
session_start();

// Prüfe alle benutzername, ob einer mit den übergebenen Daten übereinstimmt
$benutzername = trim($_POST['benutzername']);
$passwort = trim($_POST['passwort']);

$user = login_Check($benutzername,$passwort);

if($user != false){
  logge_ein($benutzername);
}

/*
     * Leite zu index.php um. Der Besucher wird entweder das Login-Formular
     * sehen, wenn die Daten falsch waren, oder das Hauptmenu, wenn der Login
     * erfolgreich war. 
     */
header('Location: index.php');
