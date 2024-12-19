<?php
require_once 'user.php';

    // $user = new User();
    // $user->setVorname("Max");
    // $user->setNachname("Mustermann");
    // $user->setBenutzername("maxmus");
    // $user->setPasswort("1234");

    // $user->speichere()


    $user = User::finde(6);
    var_dump($user->getEintraege());

?>