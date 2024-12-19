<?php

require_once 'db.inc.php';
require_once 'entity.php';
require_once 'user.php';

class Eintrag
{

    use Entity;

    private int $id = 0;
    private string $titel = "";
    private string $erstellt_am = "";
    private string $inhalt = "";
    private int $user_id = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitel(): string
    {
        return $this->titel;
    }

    public function getInhalt(): string
    {
        return $this->inhalt;
    }

    public function getErstellt_am(): string
    {
        return $this->erstellt_am;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitel(string $titel): void
    {
        $this->titel = $titel;
    }

    public function setInhalt(string $inhalt): void
    {
        $this->inhalt = $inhalt;
    }

    public function setErstellt_am(string $erstellt_am): void
    {
        $this->erstellt_am = $erstellt_am;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public static function findeAlle(): array
    {
        $query = "SELECT * FROM eintrag";
        $stmt = Db::getDB()->prepare($query);
        $stmt->execute();
        $eintraege = $stmt->fetchAll(PDO::FETCH_CLASS, 'Eintrag');
        return $eintraege;
    }

    public static function finde($id): Eintrag
    {
        $query = "SELECT * FROM eintrag WHERE id = ?";
        $stmt = Db::getDB()->prepare($query);
        $stmt->execute(array($id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Eintrag');
        return $stmt->fetch();
    }

    public function loesche(): void
    {
        $query = "DELETE FROM eintrag WHERE id = ?";
        $prestmt = DB::getDB()->prepare($query);
        $prestmt->execute(array($this->getId()));
        $prestmt->setFetchMode(PDO::FETCH_CLASS, 'Eintrag');
        $prestmt->fetch();
    }

    private function _update()
    {
        $query = "UPDATE eintrag
                SET titel = :titel, erstellt_am = :erstellt_am, inhalt = :inhalt, user_id = :user_id
                WHERE id = :id";

        $prestmt = DB::getDB()->prepare($query);
        $eintrag = $this->toArray(true);
        $prestmt->execute($eintrag);
    }

    private function _insert()
    {
        $query = "INSERT INTO eintrag(titel, erstellt_am, inhalt, user_id) 
                    VALUES (:titel, :erstellt_am, :inhalt, :user_id)";

        $prestmt = DB::getDB()->prepare($query);
        $eintrag = $this->toArray(false);
        $prestmt->execute($eintrag);
        $this->setId(DB::getDB()->lastInsertId());
    }

    public static function findeUserEintraege($user_id)
    {
        $query = "SELECT * FROM eintrag 
                WHERE user_id = ?";
        $stmt = Db::getDB()->prepare($query);
        $stmt->execute(array($user_id));
        $eintraege = $stmt->fetchAll(PDO::FETCH_CLASS, 'Eintrag');
        return $eintraege;
    }

    public function getUser() 
    {
        return User::finde($this->getUserId());
    }
}
