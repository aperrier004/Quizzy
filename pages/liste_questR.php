<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Page affichant tous les questionnaires présents en BD
 * Côté Admin il sera possible de les modifier et de les supprimer
 * Côté Joueur il sera possible de joueur aux questionnaires
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
$questR = getDb()->query('select * from questionnaire order by questR_id');

// Regarde si on supprime un questR
if (isset($_POST['suppr_id'])) {
    // On récupère l'id correspondant au questionnaire cible
    $id = $_POST['suppr_id'];
    // On le supprime et on récupère le potentiel message d'alerte
    $alert = supprimerQuestRParId($id);
}

?>

<!doctype html>
<html lang="fr">

<?php
$pageTitle = "Liste des questionnaires";
require_once "../includes/fragments/head.php";
?>

<body onload="supprimerQuestionnaireModal()">
    <?php require_once "../includes/fragments/header.php"; ?>

    <div class="container">
        <?php require_once "../includes/fragments/header.php"; ?>
        <?php require_once('../includes/fragments/alert.php'); ?>

        <div class="contenu">
            <h2 class="mb-3">La liste des Quizz</h2>
            <!-- SI ADMIN -->
            <?php if (estAdmin()) { ?>
                <div class="d-flex flex-row-reverse mb-5">
                    <button id="ajouterbtn" class="btn btn-primary" onclick="ajouterQuestionnaireModal()">Ajouter un questionnaire</button>
                </div>
            <?php } ?>
            <!-- FIN SI ADMIN -->

            <!-- Liste des questionnaires -->
            <div id="listeDesQuestionnaires" class="d-flex flex-row justify-content-between flex-wrap">

                <!-- Un questionnaire -->
                <?php foreach ($questR as $questionnaire) { ?>
                    <div class="card mb-4 shadow" id="<?= $questionnaire['questR_id'] ?>">
                        <img class="card-img-top" src=<?= $questionnaire['questR_URLImg'] ?> alt=<?= $questionnaire['questR_nomImg'] ?>>
                        <div class="card-body questionnaireMini">
                            <!-- Difficulté -->
                            <span class="difficulteQuiz text-right "><?= afficheDifficulte($questionnaire['questR_difficulte']) ?></span>
                            <!-- Thème -->
                            <span class="themeQuiz text-right text-uppercase"><?= recupThemeParId($questionnaire['theme_id']) ?></span>
                            <!-- Titre du quizz -->
                            <h4 class="card-title"><?= tronquerString($questionnaire['questR_lib'],50," ") ?></h4>

                            <!-- Description du quizz -->
                            <p class="card-text questDescr"><?= $questionnaire['questR_desc'] ?></p>
                            <!-- SI JOUEUR -->
                            <?php if (!estAdmin()) { ?>
                                <a href=<?= lienPourJouer($questionnaire['questR_id']) ?> class="btn btn-primary btnJouer">Jouer</a>
                            <?php } ?>
                            <!-- FIN SI JOUEUR -->
                            <!-- SI ADMIN -->
                            <?php if (estAdmin()) { ?>
                                <div class="d-flex flex-row justify-content-between">
                                    <button class="btn btn-secondary supprbtn" name="btnSuppr">Supprimer</button>
                                    <a href="modifier_questR.php?id=<?= $questionnaire['questR_id'] ?>" class="btn btn-primary">Modifier</a>
                                </div>

                                <?php require_once "../includes/modals/supprModal.php"; ?>
                            <?php } ?>
                            <!-- FIN SI ADMIN -->
                        </div>
                    </div>
                <?php } ?>
                <!-- FIN un questionnaire -->
            </div>
            <!-- FIN Liste des questionnaires -->
        </div>


    </div>
    <?php require_once "../includes/fragments/footer.php"; ?>
    <?php require_once "../includes/scripts/scripts.php"; ?>


</body>

</html>

<script>
    $(document).ready(function() {

        //affiche la boite de dialogue demandant la confirmation de la suppression du questionnaire et et prépare ladite suppresion
        $('.supprbtn').click(function() {
            $('#supprmodal').modal('show'); //fait apparaitre la boite de dialogue pour confirmer la suppression
            card = $(this).closest('.card'); // recupere toute la card
            idQuestionnaire = card.attr('id'); // recupere l'ID de la card
            $('#suppr_id').val(idQuestionnaire);

        });
    });
</script>