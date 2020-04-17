<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Page de connexion et d'inscription du site
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

// Si on a submit le form de connexion
if (!empty($_POST['connexion'])) {
    $alert = seConnecter();
} else if (!empty($_POST['inscription'])) {
    // Si on a submit le form d'inscription
    inscription();
}

?>

<!doctype html>
<html>

<?php
$pageTitle = "Connexion";
require_once "../includes/fragments/head.php";
?>

<body>
    <?php require_once "../includes/fragments/header.php"; ?>

    <div class="container">

        <?php require_once('../includes/fragments/alert.php'); ?>

        <div class="contenu contenuConnexionPage d-flex flex-row justify-content-around flex-nowrap">
            <div id="connexion" class="w-45">
                <h2 class="text-center">Connexion</h2>
                <form action="login.php" class="shadow was-validated bg-light p-3 mt-4 form-horizontal" method="post">
                    <div class="form-group row">
                        <label for="pseudo" class="col-sm-4 col-form-label">Pseudo :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pseudo" placeholder="Entrez votre pseudo" name="pseudo" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mdp" class="col-sm-4 col-form-label">Mot de passe :</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="mdp" placeholder="mot de passe" name="mdp" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary center" name="connexion" value="1">Valider</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="inscription">
                <h2 class="text-center">Inscription</h2>
                <form action="login.php" class="shadow was-validated bg-light p-3 mt-4 form-horizontal needs-validation" novalidate method="post">
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email :</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" placeholder="Entrez votre adresse email" name="email" required>
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pseudo" class="col-sm-4 col-form-label">Pseudo :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pseudo" placeholder="Entrez votre pseudo" name="pseudo" required>
                            <div class="invalid-feedback">Merci de remplir ce champ.</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mdp" class="col-sm-4 col-form-label">Mot de passe :</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="mdp" placeholder="mot de passe" name="mdp" required>
                            <div class="invalid-feedback">Merci de remplir ce champ.</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mdpConfirmation" class="col-sm-4 col-form-label">Confirmez votre mot de passe :</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="mdp" placeholder="mot de passe" name="mdpConfirmation" required>
                            <div class="invalid-feedback">Merci de remplir ce champ</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nom" class="col-sm-4 col-form-label">Nom :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom" name="nom" required>
                            <div class="invalid-feedback">Merci de remplir ce champ.</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="prenom" class="col-sm-4 col-form-label">Prénom :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prénom" name="prenom" required>
                            <div class="invalid-feedback">Merci de remplir ce champ.</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sexe" class="col-sm-4 col-form-label">Sexe :</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="sexe" name="sexe" required searchable="Recherchez ...">
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label ">
                            <input class="form-check-input" type="checkbox" name="remember" required> J'approuve les conditions d'utilisation.
                            <div class="invalid-feedback">Merci d'approuver les conditions d'utilisation</div>
                        </label>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary center" name="inscription" value="1">Valider</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <?php require_once "../includes/fragments/footer.php"; ?>
    <?php require_once "../includes/scripts/scripts.php"; ?>
</body>

</html>