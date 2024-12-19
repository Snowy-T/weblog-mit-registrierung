<?php
    require_once 'includes/funktionen.inc.php';
    session_start();
    
    logge_aus();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
    <title>Weblog - Ausloggen</title>
</head>

<body>
    
    <div id="gesamt">
    
        <div id="kopf">
            <h1>Mein Weblog</h1>
        </div>
        
        <div id="inhalt">
            
            <p>
                Sie wurden ausgeloggt.<br />
                Besuchen Sie uns bald wieder.
            </p>
            
            <p>
                <a href="index.php" class="backlink">Zurück zur Hauptseite</a>
            </p>
            
        </div>
            
        <div id="menu">
            <?php require 'includes/loginformular.php'; ?>
        </div>
            
        <div id="fuss">
            Das ist das Ende
        </div>
            
    </div>

</body>
</html>


