<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'afficher une page 404 
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
?>
<?php 
require_once("includes/functions.php");
require_once("includes/head.php"); 
require_once('includes/header.php');

$alert = choixAlert('url_non_valide');

require_once('includes/alert.php'); 
require_once('includes/footer.php'); ?>