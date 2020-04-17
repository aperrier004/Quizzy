<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Page de modification d'un questionnaire
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */
?>
<?php
require_once "../includes/functions.php";
require_once "../includes/constantes.php";
session_start();

// sécurité pour que seulement les admin accède à cette page et qu'on ai bien un id en URL
if (estAdmin() && $_GET['id'] != "") {
    // On récupère l'id du questionnaire
    $questR_id = $_GET['id'];

    // Recupere tous les themes
    $themes = getDb()->query('select * from theme order by theme_lib');


    // Ajout d'un nouveau thème
    if (isset($_POST['validerTheme']) && !empty($_POST['nouveauTheme'])) {
        ajouterTheme();
    }

    // Recupere les données du questR
    $questR = recupererQuestRParId($questR_id);
    // Recup les questions
    $quests = recupererQuestParQuestR($questR_id);

    // Recupère la difficulté
    $difficulte = $questR['questR_difficulte'];


    // On récupère un tableau d'entiers
    $nb = recupeNbQuestionsReponses($difficulte);

    // On assigne les variables
    $nbQuestions = $nb[0]; // Nombre de questions selon la difficulté
    $nbReponsesQC = $nb[1]; // Nombre de réponses selon la difficulté

    // form questR modifié et validé
    if (isset($_POST['validerModifQuestR'])) {
        // On appelle modifierQuestR en lui donnant l'id du questR dont on parle ainsi que les nb de questions et réponses
        modifierQuestR($questR_id, $nbQuestions, $nbReponsesQC);
    }
} else {
    // Si on est pas admin ou qu'on a pas d'id on redirige
    redirect("liste_questR.php");
}
?>

<!doctype html>
<html lang="fr">

<?php
$pageTitle = "Modifier un questionnaire";
require_once "../includes/fragments/head.php";
?>

<body onload="preparerBlocReponses()">
    <?php require_once "../includes/fragments/header.php"; ?>
    <div class="container">
        <?php require_once('../includes/fragments/alert.php'); ?>
        <div class="contenu">
            <h2>Modifier le questionnaire "<?php echo $questR['questR_lib']; ?>"</h2>

            <!-- Ajouter un thème -->
            <form action="ajouter_questR.php" method="POST" class="shadow bg-light p-4 mt-4 form-horizontal w-75 mx-auto form-disable">
                <fieldset class="p-4">
                    <legend>Création du thème</legend>
                    <div class="form-group mb-3">
                        <div class="p-3 mb-2 alert alert-info"><i class="fas fa-info-circle"></i> Veuillez vérifier si le thème de votre questionnaire est dans la liste.
                            <br />Si ce n'est pas le cas, veuillez en <strong>créer un nouveau</strong>. <br />
                            Sinon, <strong><a href="#formModifQuestR">passez au bloc suivant !</a></strong>
                        </div>
                        <label class="">Voici la liste des thèmes existants : </label>
                        <div class="">
                            <select class="form-control" name="theme" searchable="Recherchez ...">
                                <?php foreach ($themesAjout as $th) { ?>
                                    <option><?= $th['theme_lib'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group mt-3">
                        <label for="nouveauTheme" class=" row-form-label">
                            <h4>Créer un nouveau thème :</h4>
                        </label>
                        <div class="">
                            <input type="text" class="form-control" id="nouveauTheme" placeholder="Intitulé du nouveau thème" name="nouveauTheme" value="">
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" name="validerTheme" value="1">Ajouter un thème</button>
                    </div>
                </fieldset>
            </form>
            <!-- FIN Ajouter un thème -->

            <form id="formModifQuestR" action="modifier_questR.php?id=<?= $questR_id ?>&difficulte=<?= $difficulte ?>" method="POST" class="shadow bg-light p-4 mt-4 form-horizontal w-75 mx-auto form-disable">
                <!-- Informations générales -->
                <fieldset class="bg-gray p-4 shadow-sm">
                    <legend>Informations générales</legend>
                    <div class="form-group row">
                        <label for="lib" class="col-sm-3 col-form-label">Intitulé du questionnaire <span class="text-danger">*</span> :</label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="lib" placeholder="Nom du questionnaire" name="lib" value=<?php
                                                                                                                                            echo $questR['questR_lib'];
                                                                                                                                            ?>>
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desc" class="col-sm-3 col-form-label">Description du questionnaire <span class="text-danger">*</span> :</label>
                        <div class="col-sm-9">
                            <textarea required type="text" class="form-control" id="desc" placeholder="Description du questionnaire" name="desc" rows="<?= nbLignesDesc ?>" required><?php
                                                                                                                                                                                        echo $questR['questR_desc'];
                                                                                                                                                                                        ?></textarea>
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="URLImg" class="col-sm-3 col-form-label">Image du questionnaire :</label>
                        <div class="col-sm-5">
                            <input required type="text" class="form-control" id="URLImg" placeholder="URL de l'image du questionnaire" name="URLImg" value=<?php
                                                                                                                                                            echo $questR['questR_URLImg'];
                                                                                                                                                            ?> required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="difficulte" class="col-sm-3 col-form-label">Difficulté <span class="text-danger">*</span> :</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="difficulte" name="difficulte" required>
                                <option value="<?= $questR['questR_difficulte'] ?>" selected><?= $questR['questR_difficulte'] ?></option>

                            </select>
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempsMax" class="col-sm-3 col-form-label">Temps limité :</label>
                        <div class="col-sm-5">
                            <p> Si 00:00:00, le temps ne sera pas limité.</p>
                            <input class="form-control" type="time" id="tempsMax" name="tempsMax" min="00:00" max="01:00" value=<?php
                                                                                                                                echo $questR['questR_tempsMax'];
                                                                                                                                ?> required>
                        </div>
                        <div class="col-sm-4">
                            <p>Heures : Minutes : Secondes</p>
                        </div>
                    </div>
                    <!-- Affichage de tous les thèmes en BD -->
                    <div class="form-group row">
                        <label for="theme" class="col-sm-3 col-form-label">Thème <span class="text-danger">*</span> :</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="theme" name="theme" searchable="Recherchez ..." required>
                                <?php foreach ($themes as $th) { ?>
                                    <option value="<?= $th['theme_id'] ?>" <?php if ($questR['theme_id'] == $th['theme_id']) echo 'selected' ?>><?= $th['theme_lib'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                    </div>
                </fieldset>
                <!-- FIN Informations générales -->

                <!-- Questions -->
                <?php
                $i = 1;
                foreach ($quests as $quest) {
                    // Recup les réponses
                    $reps = recupererRepParQuest($quest['quest_id']);

                    require "../includes/modals/questionModal.php";

                    $i++;
                }
                ?>
                <!-- fin questions -->

                <div class="row mt-4">
                    <div class="col text-center">
                        <button type="reset" class="btn btn-secondary" name="annuler" value="1">Réinitialiser</button>
                        <button type="submit" class="btn btn-primary" name="validerModifQuestR" value="1">Valider</button>
                    </div>
                </div>
            </form>

            

        </div>

    </div>
    <?php require_once "../includes/fragments/footer.php"; ?>
    <?php require_once "../includes/scripts/scripts.php"; ?>
</body>

</html>