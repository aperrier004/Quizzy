<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'afficher un head sur la page
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <title>Quizz <?php if (isset($pageTitle)) echo "- $pageTitle"; ?></title>
</head>