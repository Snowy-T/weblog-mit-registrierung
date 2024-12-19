<?php
    require_once 'includes/funktionen.inc.php';
    session_start();
    
    // Nur ein eingeloggter benutzername darf neue Einträge posten. 
    if (!ist_eingeloggt()) {
    	header('Location: index.php');
    	exit;
    }

    $text = "";
    $title = "";
    $edit_idx = -1;
    $has_edited = false;
    if (isset($_GET["edit"])) {
        $edit_idx = $_GET["edit"];
        $entry = get_eintrag($edit_idx);
        $text = $entry["inhalt"];
        $title = $entry["titel"];
        $has_edited = true;
    }

?>
<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
    <title>Weblog - Neuen Eintrag schreiben</title>
</head>

<body>
    
    <div id="gesamt">
    
        <div id="kopf">
            <h1>Mein Weblog</h1>
        </div>
        
        <div id="inhalt">
            
            <h1>Schreiben Sie hier einen neuen Eintrag:</h1>
            
            <form action="speichere_eintrag.php" method="post">
                <?php
                    if ($has_edited) {
                ?>
                    <input type="hidden" name="edit_idx" value="<?= $edit_idx ?>">
                <?php
                    }
                ?>
                <p><input type="text" name="titel" id="titel" value="<?= $title ?>" /></p>
                <p><textarea name="inhalt" id="eintrag" cols="50" rows="10"><?= $text ?></textarea></p>
                <p><input type="submit" value="Eintragen" /></p>
            </form>
            
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