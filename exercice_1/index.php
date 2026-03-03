<?php
require_once 'Reader.php';

// 1. Créer un lecteur et ajouter deux livres
$reader = new Reader('reader@test.fr', 'password123');
$favorites = $reader->addBookToFavorites('Harry Potter');
$favorites = $reader->addBookToFavorites('Le Seigneur des Anneaux');

// 2. Afficher la liste des favoris
echo 'Favoris après ajout :<br>';
var_dump($favorites);

// 3. Retirer un livre
$favorites = $reader->removeBookFromFavorites('Harry Potter');

// 4. Afficher la liste après suppression
echo '<br>Favoris après suppression :<br>';
var_dump($favorites);

// 5. Afficher email et mot de passe
echo '<br>Infos de connexion :<br>';
var_dump($reader->login());