<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet de se déconnecter
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
?>
<?php
require_once "../includes/functions.php";
session_start();
// On détruit la session :'(
session_destroy();
// On redirge sur la page d'accueil
redirect('accueil.php');
?>
