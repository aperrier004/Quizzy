<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Page de profil utilisateur où l'on peut retrouver toutes ses informations
 * Si l'utilisateur n'est pas un Admin, il aura accès à un onglet Statistiques
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

if (isUserConnected()) {
    // On récupère l'id de l'utilisateur
    $util_id = $_SESSION['util_id'];
    $utilisateur = recupUtilisateurParId($util_id);
    foreach ($utilisateur as $util);

    // Si l'utilisateur n'est pas un admin
    if (!estAdmin()) {
        // on récupère ses stats concernant les questR réalisés
        $questionnairesStats = recupStatsParUtilId($util_id);

        // Regarde si on a validé la suppression des données
        if (isset($_POST['suppr_id'])) {
            supprimerStatsParUtilId($util_id);
        }
    }
} else {
    // Si l'utilisateur n'est pas connecté on le redirige
    redirect("login.php");
}

?>
<!doctype html>
<html lang="fr">

<?php
$pageTitle = "Profil";
require_once "../includes/fragments/head.php";
?>

<body>
    <?php require_once "../includes/fragments/header.php"; ?>
    <div class="container">
        <div class="contenu mb-5 pt-5">
            <div class="w-75 bg-light mx-auto shadow p-3">
                <div class="profile-head d-flex flex-column">
                    <!--d-flex justify-content-around-->
                    <h4 class="text-center">
                        Compte de : <?= $util['util_pseudo'] ?>
                    </h4>

                    <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profil-tab" data-toggle="tab" href="#profil" role="tab" aria-controls="profil" aria-selected="true">Profil</a>
                        </li>
                        <?php if (!estAdmin()) { //Affichage de l'onglet de statistiques?>
                            <li class="nav-item">
                                <a class="nav-link" id="stats-tab" data-toggle="tab" href="#stats" role="tab" aria-controls="stats" aria-selected="false">Statistiques</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="tab-content stats-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nom</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $util['util_nom'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Prénom</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $util['util_prenom'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Sexe</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $util['util_sexe'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $util['util_email'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <?php if (!estAdmin()) { // Affichage du tableau de stats?>
                                <div class="tab-pane fade" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                                    <table class="table mb-5">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Quizz</th>
                                                <th scope="col">Difficulté</th>
                                                <th scope="col">Meilleur Score</th>
                                                <th scope="col">Meilleur temps</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($questionnairesStats as $questRStats) { //dans questRStats on aura les données des différents questionnaires réalisés par l'utilisateur
                                                // On récupères les questionnaires avec leur id
                                                $questR = recupererQuestRParId($questRStats['questR_id']); ?>
                                                <!-- une ligne -->
                                                <tr>
                                                    <th scope="row" class="w-30"><?= $questR['questR_lib'] ?></th>
                                                    <td><?= afficheDifficulte($questR['questR_difficulte']) ?></td>
                                                    <td><?= $questRStats['real_score'] ?>%</td>
                                                    <td><?= $questRStats['real_tpsTotal'] ?></td>
                                                    <td><?= $questRStats['real_date'] ?></td>
                                                    <!-- fin une ligne -->
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <button id="reinitbtn" class="btn btn-primary" onclick="reinitialiserStatsModal()">Réinitialiser</button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php require_once "../includes/modals/reinitModal.php"; ?>

    </div>
    <?php require_once "../includes/fragments/footer.php"; ?>
    <?php require_once "../includes/scripts/scripts.php"; ?>
</body>

</html>