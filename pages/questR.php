<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Page d'affichage du questionnaire afin de pouvoir y jouer notamment
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

// sécurité de la page, vérifier que l'on est connecté  et que l'on donne bien un id de questR, sinon on redirige sur login
if (isUserConnected() && !estAdmin() && $_GET['id'] != "") {
    // Récupère l'id du questionnaire
    $questR_id = $_GET['id'];
    // Recupere les données du questR
    $questR = recupererQuestRParId($questR_id);

    $nbRepExacte = 0;

    // Recup les questions
    $quests = recupererQuestParQuestR($questR_id);


    // Si on a validé le questR
    if (isset($_POST['validerQuestRJoueur'])) {
        // On récupère la valeur du temps où le questR a été commencé
        $tpsDebut = $_POST['tpsDebut'];
        // On créé un objet Date
        $date = date_create();
        // On récupère la valeur timestamp de la date de fin 
        $tpsFin = date_timestamp_get($date);
        // On sauvegarde les réponses cochées par l'utilisateur
        sauvergarderSelection($_POST);

        // On récupère le nb de réponses exactes au questionnaire
        $nbRepExacte = $_POST['nbRepExacte'];

    } else {
        // Si on commence à jouer
        // On créé un objet date
        $date = date_create();
        // On passe en $_POST la valeur du timestamp servant pour le calcul de durée
        $_POST['tpsDebut'] = date_timestamp_get($date);
    }
} else {
    // Si on est Admin
    if (estAdmin()) {
        redirect("liste_questR.php");
    } else {
        // Si on est pas connecté
        redirect("login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php
$pageTitle = $questR['questR_lib'];
require_once "../includes/fragments/head.php";
?>

<body onload="prepareTimer()">
    <?php require_once('../includes/fragments/header.php'); ?>
    <div class="container">
        <?php if (isset($_POST['validerQuestRJoueur'])) { //Formulaire permettant de transmettre $_POST dans une page après un redirect, il est caché
        ?>
            <form id="myForm" action="soluce_questR.php?id=<?= $questR_id ?>&nbRepExacte=<?= $nbRepExacte ?>&tpsDebut=<?= $tpsDebut ?>&tpsFin=<?= $tpsFin ?>" method="post">
                <?php
                foreach ($_POST as $a => $b) {
                    echo '<input type="hidden" name="' . htmlentities($a) . '" value="' . htmlentities($b) . '">';
                }
                ?>
            </form>
            <script type="text/javascript">
                // On submit automatique le formulaire pour que lors de la redirection on ait les données
                document.getElementById('myForm').submit();
            </script>
        <?php } ?>

        <div class="contenu">
            <h1 class="text-uppercase"><?= $questR['questR_lib'] ?> <span class="difficulteQuiz"><?= afficheDifficulte($questR['questR_difficulte']) ?></span> </h1>
            <img alt="<?= $questR['questR_nomImg'] ?>" class="w-75 mx-auto d-block questRImagePrez" src="<?= $questR['questR_URLImg'] ?>" title="<?= $questR['questR_lib'] ?>" />

            <!-- Timer -->
            <div id="countdown" class="row bg-light border align-items-center flex-column border">
                <span>Temps restant :</span>
                <span id="tempsRestant"></span>
            </div>
            <!-- fin timer -->

            <form id=formulaireJeu action="questR.php?id=<?= $questR_id ?>" method="post" class="shadow bg-light p-4 mt-4 mb-4 form-horizontal w-75 mx-auto">
                <?php if (!isset($_POST['validerQuestRJoueur'])) { ?>
                    <input type="hidden" name="tpsDebut" value="<?php $date = date_create();
                                                                echo date_timestamp_get($date); ?>">
                <?php } ?>

                <?php require_once "../includes/modals/jouerQuestionModal.php"; ?>


                <div class="row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary center" name="validerQuestRJoueur" value="1">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php require_once('../includes/fragments/footer.php'); ?>
    <?php require_once('../includes/scripts/scripts.php'); ?>

</body>

</html>


<script>
    /* on prepare le timer dans cette page pour pouvoir recuperer la valeur du temps limité du questionnaire obtenu en php */
    function prepareTimer() {
        var temps = "<?php echo $questR['questR_tempsMax']; ?>"; //on recupere le temps maximum autorise pour faire le questionnaire

        /* Si la valeur n'est pas nulle, on recupere les minutes et les secondes et on appelle le minuteur dans la fonction timer */
        if (temps !== "00:00:00") {
            var min = parseInt(temps.substr(3, 2));
            var sec = parseInt(temps.substr(6, 2));
            alert("Temps pour réaliser ce questionnaire :" + min + " min: " + sec + " sec");
            document.getElementById("countdown").style.display ="flex";
            timer(min, sec);
        }
    }
</script>