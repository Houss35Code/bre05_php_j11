<?php
require 'Warrior.php';
require 'Mage.php';

// Instancier un Character
$character = new Character();
$character->setName('Arthur');
$character->setLife(100);
// echo $character->introduce(); // ERREUR : introduce() est protected !

// Instancier un Warrior
$warrior = new Warrior(100, 'Ragnar', 50);
echo $warrior->present() . '<br>';

// Instancier un Mage
$mage = new Mage(80, 'Gandalf', 200);
echo $mage->present() . '<br>';