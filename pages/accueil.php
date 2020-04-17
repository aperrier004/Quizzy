<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Page d'acueil du site
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

// Recupere tous les questionnaires
$questR = getDb()->query('select * from questionnaire order by questR_id desc');
?>

<!doctype html>
<html lang="fr">

<?php
$pageTitle = "Accueil";
require_once "../includes/fragments/head.php";
?>

<body>
    <?php require_once "../includes/fragments/header.php"; ?>
    <div class="container">

        <div class="contenu contenuHome d-flex flex-row justify-content-between flex-nowrap">
            <div id="centenuHomeGauche" class="w-65">

                <div class="jumbotron shadow-sm">
                    <h1 class="display-4">Bienvenue sur Quizzy</h1>
                    <p class="lead">Testez votre culture sur de nombreux thèmes et invitez vos amis à vous défier!</p>
                    <hr class="my-4">
                    <?php if (!isUserConnected()) { ?>
                        <p>Vous souhaitez jouer ? Alors connectez vous ! </p>
                        <p class="lead">
                            <a class="btn btn-warning btn-lg" href="tutoriel.php" role="button">Tutoriel</a>
                            <a class="btn btn-primary btn-lg" href="login.php" role="button">Connexion & Inscription</a>
                        </p>
                    <?php } else { ?>
                        <p class="lead">
                            <a class="btn bg-warning btn-lg" href="tutoriel.php" role="button">Tutoriel</a>
                            <?php if (estAdmin()) { ?>
                                <button id="ajouterbtn" class="btn btn-primary btn-lg" onclick="ajouterQuestionnaireModal()">Créer</button>
                            <?php } else { ?>
                                <a class="btn btn-primary btn-lg" href="liste_questR.php" role="button">Jouer !</a>
                            <?php } ?>
                        </p>
                    <?php } ?>
                </div>

                <div id="regles">
                    <h3>Règles du quizz</h3>
                    <p><strong>Etape 1 :</strong> choisir un questionnaire (faut t'inscrire déso).<br />
                        <strong>Etape 2 :</strong> Lire la premiere question.<br />
                        <strong>Etape 3 :</strong> Lire les réponses.<br />
                        <strong>Etape 4 :</strong> Selectionner la ou les réponses qui te semblent justes.<br />
                        <strong>Etape 5 :</strong> Reproduire les étapes 2,3 et 4 pour les questions suivantes.<br />
                        <strong>Etape 6 :</strong> Valider le questionnaire. <br />
                        <strong>Etape 7 :</strong> Regarder son score. <br />
                        <strong>Etape 8 :</strong> S'améliorer, sauf si t'as 100.

                    </p>
                </div>
            </div>
            <div id="contenuHomeDroite" class="w-30">
                <h3>Les derniers quizz ajoutés</h3>
                <ul class="list-unstyled">
                    <?php $i = 1; //Compteur
                    foreach ($questR as $questionnaire) { //Permet d'afficher les 5 questionnaires les plus récents
                        if ($i > 5) break; //On sort de la boucle pour arrêter d'afficher des questionnaires si on en a déjà 5
                    ?>
                        <li class="d-flex">
                            <img class="miniIlluQuestR align-self-center mr-3" alt=<?= $questionnaire['questR_nomImg'] ?> src=<?= $questionnaire['questR_URLImg'] ?>>
                            <div class="media-body">
                                <h4><a class="" href="questR.php?id=<?= $questionnaire['questR_id'] ?>"><?= tronquerString($questionnaire['questR_lib'], 50, " ") ?></a></h3>
                                    <p class=""><?= $questionnaire['questR_desc'] ?></p>
                            </div>
                        </li>
                        <hr />
                    <?php $i++;
                    } ?>
                </ul>
            </div>
        </div>
    </div>
    <?php require_once "../includes/fragments/footer.php"; ?>


    <?php require_once "../includes/scripts/scripts.php"; ?>
</body>

</html>