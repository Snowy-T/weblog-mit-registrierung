<?php
require_once 'includes/funktionen.inc.php';
session_start();

/*
     * Wenn der benutzername nicht eingeloggt ist oder die Seite nicht
     * über POST aufgerufen, also das Formular nicht abgeschickt wurde, 
     * leite auf index.php um. 
     */
if ((! ist_eingeloggt()) || (empty($_POST))) {
  header('Location: index.php');
  exit;
}

// Erstelle einen neuen Eintrag im Format der anderen Einträge
$eintrag = array(
  'titel'       => trim($_POST['titel']),
  'erstellt_am' => date('Y-m-d H:i:s', time()),
  'inhalt'      => trim($_POST['inhalt']),
  'autor'       => $_SESSION['eingeloggt'],
);

$eintraege = hole_eintraege();
if (!isset($_REQUEST["edit_idx"])) {

  eintrag_hinzufugen($eintrag);

} else if (isset($_REQUEST["edit_idx"])) {
  $idx = $_REQUEST["edit_idx"];
  $title = $_POST["titel"];
  $inhalt = $_POST["inhalt"];
  $erstellt_am = date('Y-m-d H:i:s', time());

  $eintrag = get_eintrag($idx);
  eintrag_aktualisieren($title, $inhalt, $erstellt_am, $idx);
  $eintrag = get_eintrag($idx);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
  <title>Weblog - Eintrag speichern</title>
</head>

<body>

  <div id="gesamt">

    <div id="kopf">
      <h1>Mein Weblog</h1>
    </div>

    <div id="inhalt">

      <h3>Folgender Eintrag wurde erfolgreich gespeichert:</h3>
      <div class="zitat">
        <h1><?php echo htmlspecialchars($eintrag['titel']); ?></h1>
        <p>
          <?php echo nl2br(htmlspecialchars($eintrag['inhalt'])); ?>
        </p>
        <p>
          <a href="index.php" class="backlink">Zurück zur Hauptseite</a>
        </p>
      </div>
    </div>

    <div id="menu">
      <?php require 'includes/hauptmenu.php'; ?>
    </div>

    <div id="fuss">
      Das ist das Ende
    </div>

  </div>

</body>

</html>