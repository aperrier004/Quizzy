<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Page d'ajout d'un questionnaire
 * Contient les formulaires nécéssaire à cet ajout
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


// sécurité pour que seulement les admin accède à cette page et que l'on ai bien une difficulté en URL
if (estAdmin() && $_GET['difficulte'] != "") {
    // Recupere tous les themes
    $themesAjout = getDb()->query('select * from theme order by theme_lib');
    $themes = getDb()->query('select * from theme order by theme_lib');

    // Recupère la difficulté
    $difficulte = escape($_GET['difficulte']);

    // Ajout d'un nouveau thème
    if (isset($_POST['validerTheme']) && !empty($_POST['nouveauTheme'])) {
        ajouterTheme();
    }
    // On récupère un tableau d'entiers
    $nb = recupeNbQuestionsReponses($difficulte);

    // On assigne les variables
    $nbQuestions = $nb[0]; // Nombre de questions selon la difficulté
    $nbReponsesQC = $nb[1]; // Nombre de réponses selon la difficulté

    // form questR validé
    if (isset($_POST['validerQuestR'])) {
        // On ajoute le questR
        ajouterQuestR();
        // On suppose qu'il n'y a pas d'accès concurrent, très couteux en temps de passer par des LOCK au niveau de la BD
        $dernierQuestR_id = recupIdDernierQuestR();

        // On appelle l'ajout de question pour le nombre de questions à ajouter
        for ($i = 1; $i <= $nbQuestions; $i++) {
            // On donne le $i afin que l'on retrouve la valeur du bon input
            // On donne le nombre de réponses que la questions aura dans le cas d'une Question à Choix (= pas VF)
            ajouterQuest($dernierQuestR_id, $i, $nbReponsesQC);
        }
        // On redirige une fois que l'on a fini
        redirect("liste_questR.php");
    }
} else {
    redirect("liste_questR.php");
}
?>

<!doctype html>
<html lang="fr">

<?php
$pageTitle = "Ajouter un Questionnaire";
require_once "../includes/fragments/head.php";
?>

<body onload="preparerBlocReponses()">
    <?php require_once "../includes/fragments/header.php"; ?>
    <div class="container">

        <div class="contenu">
            <h2>Créer un questionnaire</h2>
            <!-- Ajouter un thème -->
            <form action="ajouter_questR.php" method="POST" class="shadow bg-light p-4 mt-4 form-horizontal w-75 mx-auto form-disable">
                <fieldset class="p-4">
                    <legend>Création du thème</legend>
                    <div class="form-group mb-3">
                        <div class="p-3 mb-2 alert alert-info"><i class="fas fa-info-circle"></i> Veuillez vérifier si le thème de votre questionnaire est dans la liste.
                            <br />Si ce n'est pas le cas, veuillez en <strong>créer un nouveau</strong>. <br />
                            Sinon, <strong><a href="#formAjoutQuestR">passez au bloc suivant !</a></strong>
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

            <form id="formAjoutQuestR" action="ajouter_questR.php?difficulte=<?= $difficulte ?>" method="post" class="shadow bg-light p-4 mt-4 form-horizontal w-75 mx-auto form-disable">
                <fieldset class="bg-gray p-4 shadow-sm">
                    <legend>Informations générales</legend>
                    <div class="form-group row">
                        <label for="lib" class="col-sm-3 col-form-label">Intitulé du questionnaire <span class="text-danger">*</span> :</label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="lib" placeholder="Nom du questionnaire" name="lib">
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desc" class="col-sm-3 col-form-label">Description du questionnaire <span class="text-danger">*</span> :</label>
                        <div class="col-sm-9">
                            <textarea required type="text" class="form-control" id="desc" placeholder="Description du questionnaire" name="desc" value="" rows="<?= nbLignesDesc ?>"></textarea>
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="URLImg" class="col-sm-3 col-form-label">Image du questionnaire <span class="text-danger">*</span> :</label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="URLImg" placeholder="URL de l'image du questionnaire" name="URLImg" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="difficulte" class="col-sm-3 col-form-label">Difficulté <span class="text-danger">*</span> :</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="difficulte" name="difficulte" required>
                                <option value="<?= $difficulte ?>"><?= $difficulte ?></option>
                            </select>
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempsMax" class="col-sm-3 col-form-label">Temps limité :</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="time" id="tempsMax" name="tempsMax" min="00:00" max="01:00" value="00:00">
                        </div>
                    </div>
                    <div class="mb-2 alert alert-info mx-auto text-center">
                        <i class="fas fa-info-circle"></i> Si "00:00", le temps ne sera pas limité.
                        <p>Format = Heures : Minutes</p>
                    </div>
                    <!-- Affichage de tous les thèmes en BD -->
                    <div class="form-group row">
                        <label for="theme" class="col-sm-3 col-form-label">Thème <span class="text-danger">*</span> :</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="theme" name="theme" searchable="Recherchez ..." required>
                                <?php foreach ($themes as $th) { ?>
                                    <option value=<?= $th['theme_id'] ?>><?= $th['theme_lib'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                    </div>
                </fieldset>


                <!-- Questions -->
                <?php
                for ($i = 1; $i <= $nbQuestions; $i++) {
                    require "../includes/modals/questionModal.php";
                }
                ?>
                <!-- fin questions -->

                <div class="row mt-4">
                    <div class="col text-center">
                        <button type="reset" class="btn btn-secondary" name="annuler" value="1">Réinitialiser</button>
                        <button type="submit" class="btn btn-primary" name="validerQuestR" value="1">Valider</button>
                    </div>
                </div>
            </form>



        </div>

    </div>
    <?php require_once "../includes/fragments/footer.php"; ?>
    <?php require_once "../includes/scripts/scripts.php"; ?>
</body>

</html>