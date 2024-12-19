<?php
    require_once 'includes/funktionen.inc.php';
    session_start();
    
    // In Blogs werden Einträge immer in umgekehrter Reihenfolge angezeigt
    $eintraege = Eintrag::findeAlle();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
        <title>Weblog - Einträge</title>
    </head>
    <body>
        <div id="gesamt">
            <div id="kopf">
                <h1>Mein Weblog</h1>
            </div>
            <div id="inhalt">
                
                <?php foreach ($eintraege as $idx => $e): ?>
                    <h1><?= htmlspecialchars($e->getTitel()); ?></h1>
                    <?= nl2br(htmlspecialchars($e->getInhalt())); ?>
                    
                    <p class="eintrag_unten">
                        <span>
                            geschrieben von
                            <?= $e->getUser()->getVorname(); ?>
                            <?= $e->getUser()->getNachname(); ?>
                            am <?= date('d.m.Y', strtotime($e->getErstellt_am())); ?>
                            um <?= date('H:i', strtotime($e->getErstellt_am())); ?>
                            <?php
                                if (ist_eingeloggt() && $_SESSION["eingeloggt"] === $e->getUser()->getBenutzername()) {
                            ?>
                                <a href="zeige_eintrag_formular.php?edit=<?= $e->getId() ?>">Edit</a>
                                <a href="delete_entry.php?delete_idx=<?= $e->getId()  ?>">Delete</a>
                            <?php
                                }
                            ?>
                        </span>
                    </p>
                <?php endforeach; ?>
            </div>
            <div id="menu">
                <?php
                    /**
                     * Zeige das Login-Formular, wenn der benutzername noch nicht eingeloggt ist,
                     * ansonsten das Hauptmenu.
                     */	 
                    if (ist_eingeloggt()) {
                        require 'includes/hauptmenu.php';
                    } else {
                        require 'includes/loginformular.php';
                    } 
                ?>
            </div>
            <div id="fuss">
                Das ist das Ende
            </div>
        </div>
    </body>
</html>