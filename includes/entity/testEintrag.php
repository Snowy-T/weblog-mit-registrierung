<?php

require_once 'eintrag.php';

$eintrag = Eintrag::finde(1);
var_dump($eintrag->getUser());
?>