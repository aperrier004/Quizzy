<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'afficher un header sur la page
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */
?>
<?php require_once "../includes/functions.php" ?>
<?php require_once "../includes/modals/choixDifficulteModal.php"; ?>

<nav class="navbar navbar-expand-md bg-light navbar-light">
    <!-- Brand -->
    <a class="navbar-brand" href="accueil.php"><i class="fas fa-question-circle"></i> Quizzy</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar liens -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="tutoriel.php">Tutoriels</a>
            </li>
            <!-- Si Admin -->
            <?php if (estAdmin()) { ?>
                <li>
                    <a id="lienAjouterQuestR" class="nav-link">Ajouter un questionnaire</a>
                </li>
            <?php } ?>
            <!-- FIN SI ADMIN -->
            <li class="nav-item">
                <a class="nav-link" href="liste_questR.php">Liste des Quizz</a>
            </li>
            <!-- Dropdown-->
            <!-- Si Connecté -->
            <?php if (isUserConnected()) { ?>
                <li id="pseudoConnecte" class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> Bienvenue, <?= $_SESSION['pseudo'] ?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu p-1">
                        <li><a href="./profil.php"><i class="fas fa-user"></i> Compte</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a></li>
                    </ul>
                </li>
                <!-- FIN SI Connecté -->
            <?php } else { ?>
                <!-- Si PAS Connecté -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Vous n'êtes pas connecté
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="login.php"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
                    </div>
                </li>
                <!-- FIN SI PAS Connecté -->
            <?php } ?>
        </ul>
    </div>
</nav>