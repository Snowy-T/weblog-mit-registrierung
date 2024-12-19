<?php

require_once 'db.inc.php';
require_once 'entity.php';
require_once 'eintrag.php';

class User
{

    use Entity;

    private int $id = 0;
    private string $vorname = "";
    private string $nachname = "";
    private string $benutzername =  "";
    private string $passwort = "";

    public function getId(): int
    {
        return $this->id;
    }

    public function getVorname(): string
    {
        return $this->vorname;
    }

    public function getNachname(): string
    {
        return $this->nachname;
    }

    public function getBenutzername(): string
    {
        return $this->benutzername;
    }

    public function getPasswort(): string
    {
        return $this->passwort;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setVorname(string $vorname): void
    {
        $this->vorname = $vorname;
    }

    public function setNachname(string $nachname): void
    {
        $this->nachname = $nachname;
    }

    public function setBenutzername(string $benutzername): void
    {
        $this->benutzername = $benutzername;
    }

    public function setPasswort(string $passwort): void
    {
        $this->passwort = $passwort;
    }

    public static function findeAlle(): array
    {
        $query = "SELECT * FROM user";
        $erg = DB::getDB()->query($query);
        $erg->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $erg->fetchAll();
    }

    public static function finde($id): User
    {
        $query = "SELECT * FROM user WHERE id = ?";
        $prestmt = DB::getDB()->prepare($query);
        $prestmt->execute(array($id));
        $prestmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $prestmt->fetch();
    }

    public static function findeBenutzername($benutzername): User
    {
        $query = "SELECT * FROM user WHERE benutzername = ?";
        $prestmt = DB::getDB()->prepare($query);
        $prestmt->execute(array($benutzername));
        $prestmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $prestmt->fetch();
    }

    public function loesche(): void
    {
        $query = "DELETE FROM user WHERE id = ?";
        $prestmt = DB::getDB()->prepare($query);
        $prestmt->execute(array($this->getId()));
        $prestmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $prestmt->fetch();
    }



    private function _update()
    {
        $query = "UPDATE user
                SET vorname = :vorname, nachname = :nachname, benutzername = :benutzername, passwort = :passwort
                WHERE id = :id";
        $prestmt = DB::getDB()->prepare($query);
        $benutzer = $this->toArray(true);
        $benutzer['passwort'] = password_hash($this->getPasswort(), PASSWORD_DEFAULT);
        $prestmt->execute($benutzer);
    }

    private function _insert()
    {
        $query = "INSERT INTO user(vorname, nachname, benutzername, passwort) 
                    VALUES (:vorname, :nachname, :benutzername, :passwort)";

        $prestmt = DB::getDB()->prepare($query);
        $benutzer = $this->toArray(false);
        $benutzer['passwort'] = password_hash($this->getPasswort(), PASSWORD_DEFAULT);
        $prestmt->execute($benutzer);
        $this->setId(DB::getDB()->lastInsertId());
    }


    // Beziehungs Methoden

    public function getEintraege() 
    {
        return Eintrag::findeUserEintraege($this->getId());
    }
}