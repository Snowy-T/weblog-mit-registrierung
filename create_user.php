<?php
require_once 'includes/funktionen.inc.php';
session_start();

$benutzername = get_post_or_redirect("benutzername", "index.php");

foreach (get_users() as $existing_user => $_) {
  if ($benutzername == $existing_user) {
    header("Location: index.php");
    exit;
  }
}

$vorname = get_post_or_redirect("vorname", "index.php");
$nachname = get_post_or_redirect("nachname", "index.php");
$pw = get_post_or_redirect("passwort", "index.php");

add_user($benutzername, $vorname, $nachname, $pw);
logge_ein($benutzername);
header("Location: index.php");
