<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblog - Registrieren</title>
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="kopf">
        <h1>Mein Weblog</h1>
    </div>
    <main id="register-site">
        <form action="create_user.php" method="post">
            <label for="benutzername">benutzername</label>
            <input type="text" name="benutzername" id="benutzername" placeholder="benutzername" required autofocus>

            <label for="vorname">Vorname</label>
            <input type="text" name="vorname" id="vorname" placeholder="Vorname" required>

            <label for="nachname">Nachname</label>
            <input type="text" name="nachname" id="nachname" placeholder="Nachname" required>

            <label for="passwort">passwort</label>
            <input type="passwort" name="passwort" id="passwort" placeholder="passwort" required>

            <input type="submit" value="Ok">
        </form>
    </main>
</body>
</html>