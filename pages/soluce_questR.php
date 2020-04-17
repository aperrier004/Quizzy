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

// sécurité de la page, vérifier que l'on est connecté et que l'on donne un id, sinon on redirige sur login
if (isUserConnected() && $_GET['id'] != "") {
    // Pour savoir si l'on doit donner la correction dans jouerQuestionModal
    $correction = 1;

    // Récupère l'id du questionnaire
    $questR_id = $_GET['id'];

    // Recup les questions
    $questions = recupererQuestParQuestR($questR_id);

    // Recupere les données du questR
    $questR = recupererQuestRParId($questR_id);

    //appelle la fonction pour corriger
    $resultats = corriger($questR_id,$questions);
    
    // Recup les questions
    $quests = recupererQuestParQuestR($questR_id);

    // Recup le pseudo du meilleur joueur
    $pseudoMeilleurJoueur = recupPseudoParId($resultats[1]['util_id']);

} else {
    redirect("login.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php require_once("../includes/fragments/head.php"); ?>

<body onload="couleurScore()">
    <?php
    $pageTitle = $questR['questR_lib'];
    require_once('../includes/fragments/header.php'); ?>
    <div class="container">

        <div class="contenu">
            <h1 class="text-uppercase"><?= $questR['questR_lib'] ?> <span class="difficulteQuiz"><?= afficheDifficulte($questR['questR_difficulte']) ?></span> </h1>
            <img alt="<?= $questR['questR_nomImg'] ?>" class="w-75 mx-auto d-block questRImagePrez" src="<?= $questR['questR_URLImg'] ?>" title="<?= $questR['questR_lib'] ?>" />

            <!-- bloc score fin de partie -->
            <div id="scoreFinPartie" class="bg-light p-4 mt-4 w-75 mx-auto shadow">
                <div id="headScore" class="text-center">
                    <h3><span id="pourcentageReussite" class=""><span id="valeurScore"><?= $resultats[0]['score'] ?></span>%</span> de bonnes réponses</h3>
                    <span class="blockquote-footer">« <?= $resultats[0]['phraseScore'] ?> »</span>
                </div>
                <div id="recapScore" class="pl-3 mt-3">
                    <!-- Score joueur -->
                    <h5>Récapitulatif</h5>
                    <div id="recapPartie" class="pl-3 mb-3">
                        <div class="row"><strong class="col-sm-3">Durée : </strong><span class="col-sm-2"><?= $resultats[0]['tpsTotal'] ?></span></div>
                        <div class="row"><strong class="col-sm-3">Nombre d'erreurs :</strong><span class="col-sm-2"><?= $resultats[0]['nbRepFausseCochée'] ?></span></div>
                    </div>
                    <!-- fin Score joueur -->
                    <!-- Meilleur Score -->
                    <h5>Meilleur score</h5>
                    <div id="recapMeilleurScore" class="pl-3">
                        <div class="row"><strong class="col-sm-3">Pseudo : </strong><span class="col-sm-2"><?= $pseudoMeilleurJoueur ?></span></div>
                        <div class="row"><strong class="col-sm-3">Pourcentage de réussite</strong><span class="col-sm-2"><?= $resultats[1]['real_score'] ?>%</span></div>
                        <div class="row"><strong class="col-sm-3">Durée : </strong><span class="col-sm-2"><?= $resultats[1]['real_tpsTotal'] ?></span></div>
                    </div>
                    <!-- fin meilleur score -->
                </div>
            </div>
            <!-- fin bloc score fin de partie -->
            <!-- bouton retou liste questionnaires -->
            <div class="row mt-4">
                <div class="col text-right">
                    <a href="./liste_questR.php" class="btn btn-primary"><i class="fas fa-arrow-right"></i> Retour à la liste des questionnaires</a>
                </div>
            </div>
            <!-- fin bouton retour liste questionnaires -->



            <!-- recap quizz et solutions -->
            <div class="bg-light p-4 mt-4 w-75 mx-auto shadow">
                <?php require_once "../includes/modals/jouerQuestionModal.php"; ?>

                <div class="row">
                    <div class="col text-right">
                        <a href="./liste_questR.php" class="btn btn-primary"><i class="fas fa-arrow-right"></i> Retour à la liste des questionnaires</a>
                    </div>
                </div>
            </div>

            <!-- fin recap quizz et solutions -->
        </div>

    </div>
    <?php require_once('../includes/fragments/footer.php'); ?>
    <?php require_once('../includes/scripts/scripts.php'); ?> <script src="js/script.js"></script>

</body>

</html>