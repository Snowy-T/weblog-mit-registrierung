<?php
require_once 'entity/db.inc.php';
require_once 'entity/user.php';
require_once 'entity/eintrag.php';

function hole_eintraege($umgedreht = false) {
    $query = "SELECT e.id,e.titel,e.inhalt,e.erstellt_am,u.vorname,u.nachname,u.benutzername FROM eintrag e
        INNER JOIN user u ON u.id = e.user_id
        ORDER BY erstellt_am
    ";
    $erg = DB::getDB()->query($query);
    $eintraege = $erg->fetchAll();

    if ($umgedreht === true) {
        $eintraege = array_reverse($eintraege);
    }
    
    return $eintraege;
}

function get_eintrag($id) {
    $query = "SELECT * FROM eintrag WHERE id = ?";
    $prestmt = DB::getDB()->prepare($query);
    $prestmt->execute(array($id));
    $eintrag = $prestmt->fetch();
    return $eintrag;
}

function ist_eingeloggt() {
    $erg = false;
    if (isset($_SESSION['eingeloggt'])) {
        if (!empty($_SESSION['eingeloggt']))
            $erg = true;
    }
    return $erg;
}

function get_users() {
        $query = "SELECT * FROM user ";
    
        $erg = DB::getDB()->query($query);
        $users = $erg->fetchAll();
    
    return $users;
}

function add_user(String $benutzername, String $vorname, String $nachname, String $pw) {

    $passwort = password_hash($pw, PASSWORD_DEFAULT);

    $query = "INSERT INTO user(benutzername,vorname,nachname,passwort)
            VALUES('$benutzername','$vorname','$nachname','$passwort');
    ";

    DB::getDB()->query($query);
}

function logge_ein($benutzername) {
    $_SESSION['eingeloggt'] = $benutzername;
}

function logge_aus() {
    unset($_SESSION['eingeloggt']);
}

function get_post_or_redirect(String $item, String $redirect_location) {
    if (empty($_POST[$item])) {
        header("Location: $redirect_location");
        exit;
    }

    return $_POST[$item];
}

function login_Check($benutzername, $passwort){

    $query = "SELECT * FROM user
                WHERE benutzername = '$benutzername'
        ";

    $erg = DB::getDB()->query($query);
    $user = $erg->fetch();
    $passwortHash = $user['passwort'];

    if(password_verify($passwort, $passwortHash)){
        return $user;
    }else {
        return false;
    }
}

function delete_eintrag($id){

    $query = "DELETE FROM eintrag
    WHERE id = ?";
    $prestmt = DB::getDB()->prepare($query);
    $prestmt->execute(array($id));

}

function eintrag_hinzufugen($eintrag){

    $eintrag = new Eintrag($eintrag);
    $eintrag->setUserId(User::findeBenutzername($_SESSION['eingeloggt'])->getId());
    $eintrag->speichere();

}

function eintrag_aktualisieren($titel, $inhalt, $erstellt_am, $id){

    $eintrag = Eintrag::finde($id);
    $eintrag->setTitel($titel);
    $eintrag->setInhalt($inhalt);
    $eintrag->setErstellt_am($erstellt_am);
    $eintrag->speichere();

}

function get_userid($benutzername){
    $query = "SELECT id FROM user WHERE benutzername = '$benutzername'";

    $erg = DB::getDB()->query($query);
    $userid = $erg->fetch();

    return $userid['id'];
}
