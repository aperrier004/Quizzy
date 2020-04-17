<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Page par défaut du site, permet de rediriger vers l'accueil
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
?>
<?php
//session_start();
require_once "includes/functions.php";

redirect("pages/accueil.php");
?>