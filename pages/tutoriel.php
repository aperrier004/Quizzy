<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Page de tutoriel du site
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */
?>
<?php
require_once "../includes/functions.php";
?>

<!DOCTYPE html>
<html lang="fr">
<?php
$pageTitle = "Quizzy Prise en main";
require_once("../includes/fragments/head.php"); ?>

<body>
    <?php require_once('../includes/fragments/header.php'); ?>
    <div class="container">
        <div class="contenu">

            <h1>Comment utiliser Quizzy ?</h1>

            <!-- DEBUT description du site -->
            <div class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                <h2>Qu'est-ce que c'est ?</h2>

                <p class="pl-4">
                    Quizzy est une plateforme de quiz tout public. Riche d'autant de questionnaires de
                    culture générale qu'à visée pédagogique, Quizzy se veut l'ami des grands comme des petits,
                    étudiants, retraités ou vacanciers.<br /><br />
                    Pour jouer, rien de plus simple, il suffit de se <a href="./login.php" alt="">se connecter</a> !<br />
                    Pas de compte ? Pas de panique mon ami, tu peux aussi <a href="./login.php" alt="">t'inscrire ! </a> C'est gratuit !
                </p>
            </div>
            <!-- FIN description du site -->

            <!-- DEBUT Menu des différents tutoriels possible -->
            <ul class="nav nav-tabs mt-5">
                <li class="nav-item"><a aria-selected="true" class="nav-link active" role="tab" data-toggle="tab" href="#tutoCommun">Tutoriel Démarrer</a></li>
                <li class="nav-item"><a aria-selected="false" class="nav-link" role="tab" data-toggle="tab" href="#tutoJoueurs">Tutoriels Joueur</a></li>
                <li class="nav-item"><a aria-selected="false" class="nav-link" role="tab" data-toggle="tab" href="#tutoAdmin">Tutoriels Administrateur</a></li>
            </ul>
            <!-- Fin Menu -->

            <div class="tab-content mt-4 mb-4">
                <!-- DEBUT Tutoriel commun / non inscrit -->
                <div id="tutoCommun" class="tab-pane fade show active">
                    <!-- DEBUT Tutoriel inscription -->
                    <div id="inscriptionTuto" class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                        <h3 class="mb-4">1. S'inscrire</h3>

                        <div class="d-flex align-items-center">
                            <img alt="S'inscrire" class="w-40 shadow" src="https://zupimages.net/up/20/16/1q7o.png" />

                            <p class="pl-4 w-60">
                                Pour s'inscrire, c'est tout simple. Il suffit de remplir les champs obligatoire.
                                Une adresse mail valide, et un mot de passe qu'il ne faudra, évidemment, ni divulguer
                                ni oublier, le tout relevé de quelques informations personnelles, puis appuyer sur "Valider" ! <br /><br />
                                Par défaut, le compte créé sera un compte "joueur".
                                Si tu veux être administrateur, demandes aux développeurs de t'attribuer les droits.
                                Si tu as été sage cette année, ils feront peut-être un effort.
                            </p>
                        </div>
                    </div>
                    <!-- FIN Tutoriel inscription -->

                    <!-- DEBUT Tutoriel connexion -->
                    <div id="inscriptionTuto" class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                        <h3 class="mb-4">2. Se connecter</h3>

                        <div class="">
                            <img alt="Se connecter" class="d-block mb-3 mx-auto w-50 shadow" src="https://zupimages.net/up/20/16/04je.png" />

                            <div class="pl-4">
                                Une fois inscrit, tu peux te <a href="login.php">connecter</a>. Il s'agit d'une étape obligatoire
                                pour la suite de l'aventure. Renseignes ton pseudo et ton mot de passe (ceux choisis à l'inscription), et go !<br />
                                Si tu es un joueur, va voir comment lancer ta première partie ! Si tu es un administrateur, tu peux
                                commencer par créer ton premier quizz qu'est-ce que tu en dis ?
                            </div>
                        </div>
                    </div>
                    <!-- FIN Tutoriel connexion -->
                </div>
                <!-- FIN Tutoriel commun / non inscrit -->

                <!-- DEBUT Tutoriels joueur -->
                <div id="tutoJoueurs" class="tab-pane fade">
                    <!-- DEBUT Tutoriel demarrer une partie -->

                    <div id="introJoueur" class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                        <p>
                            Une fois connecté, le joueur (ou "la", "lui", 'fin ... supposes que y'a l'inclusion) arrive sur
                            la <a href="liste_questR.php">liste des questionnaires</a>.
                        </p>
                        <img alt="Liste des Quizz Joueur" class="w-80 mt-5 d-block mx-auto shadow" src="https://zupimages.net/up/20/16/kr7w.png" />

                    </div>



                    <div id="demarrerPartieTuto" class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                        <h3 class="mb-4">1. Lancer une partie</h3>

                        <div class="d-flex align-items-center">
                            <p class="pl-4">

                                La liste de questionnaires se présente en une succession de "cartes" présentant les informations principales
                                du questionnaire. On voit donc :<br />
                                - Le <strong>titre</strong><br />
                                - Une <strong>image</strong> pour illustrer<br />
                                - La <strong>difficulté</strong> : d'une échelle de 0 à 5, elle se présente sous la forme d'étoiles
                                remplies <i class="fas fa-star"></i>.<br />
                                Plus la difficulté augmente, plus le nombre de questions et le nombre de réponses pour chacune d'elles augmente.
                                <br />
                                - Le <strong>thème</strong>, situé sous la difficulté <br />
                                - Une <strong>description</strong>.<br /><br />

                                Pour lancer un questionnaire -celui que tu préfères tant qu'à faire- il suffit de cliquer sur le bouton "<strong>Jouer</strong>".


                            </p>
                        </div>
                    </div>
                    <!-- FIN Tutoriel demarrer une partie -->

                    <!-- DEBUT Tutoriel jouer à un questionnaire -->
                    <div id="jouerTuto" class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                        <h3 class="mb-4">2. Jouer une partie</h3>

                        <div class="d-flex align-items-center">
                            <div class="pl-4">
                                <p>Ça y est, tu as choisi ton questionnaire ? Pas trop dur de se décider ?
                                    J'espère que non, car tu n'as pas fini. Bah oui, ne fais pas cette tête d'ahuri.
                                    C'est un peu l'objectif du jeu, faire des "choix".</p>

                                <p>Bon, présentons l'enfant à sa mère. <br />
                                    Une fois que tu as cliqué sur le bouton "Jouer", le questionnaire s'ouvre. L'objectif est de
                                    <strong>répondre aux questions le plus vite possible et en faisant le moins d'erreurs possible.</strong></p>
                                <div class="alert alert-warning mt-4" role="alert">
                                    <strong>Attention :</strong> certains questionnaires (ou quiz pour les intimes) doivent s'effectuer en un temps imparti.
                                    T'as pas fini à temps ? Bah tant pis pour toi eh.
                                </div>

                                <p>
                                    <h4>Il existe 3 types de questions.</h4><br />
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <img id="illuQCU" alt="Illustration QCU" class="shadow w-20" src="https://zupimages.net/up/20/16/vzpd.png" />
                                        <span class="w-70">- les <strong>Questions à Choix Unique QCU</strong> : plusieurs réponses, une seule vraie.</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <img id="illuQCM" alt="Illustration QCM" class="shadow w-20" src="https://zupimages.net/up/20/16/gogs.png" />
                                        <span class="w-70">- les <strong>Questions à Choix Multiple QCM</strong> : plusieurs réponses, plusieurs vraies. Plusieurs pouvant vouloir dire "0", "1", ou "15".</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <img id="illuVF" alt="Illustration Vrai/Faux" class="shadow w-20" src="https://zupimages.net/up/20/16/on5i.png" />
                                        <span class="w-70">- les <strong>Vrai/Faux</strong> : soit l'énonciation est vraie, soit elle est fausse, t'as tout compris.</span>
                                    </div>


                                </p>

                                <p>
                                    Quand tu as répondu à toutes les questions, et que tu es sûr de vouloir les envoyer, il faut appuyer sur le bouton <strong>"Valider"</strong>. Et oui, c'est tout simple.<br /><br />
                                    Quand tu as validé, ou bien que le délai est dépassé, ton score est calculé.
                                    Il apparait dans une fenêtre toute jolie toute propre (toute douce lavée avec mir laine). En dessous, tu trouveras une correction, histoire de savoir
                                    où est-ce que tu t'es trompé (ou pas, va savoir, tu feras peut-être un 100% du premier coup, auquel cas je te tirerai mon chapeau).<br /><br />
                                </p>
                                <img id="illuScore" alt="Illustration Score" class="shadow w-80 mx-auto d-block mb-3" src="https://zupimages.net/up/20/16/9o45.png" /><br />
                                <p>
                                    Quand tu as pris note de ton score et de la correction, cliques sur le bouton "Retour à la liste des questionnaires"
                                    pour, comme son nom l'indique, retourner à la liste des questionnaires.
                                </p>


                            </div>
                        </div>
                    </div>
                    <!-- FIN Tutoriel jouer à un questionnaire -->

                    <!-- DEBUT Tutoriel profil et statistiques -->
                    <div id="profilTuto" class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                        <h3 class="mb-4">3. Consulter son profil ou ses statistiques</h3>

                        <div class="">
                            <p> Désolée de te l'apprendre, mais un joueur, hormis jouer, ne peux pas faire grand chose d'autre sur ce site.
                                Enfin ... il peut parcourir en long, en large et en travers les quelques
                                pages auxquelles il a accès, mais sinon ... Il a le profil, mais c'est tout. <br /><br />

                                Pour y accéder, rien de plus simple. Il faut aller dans la barre de navigation (la barre pâle tout en haut, regardes l'image si tu sais pas de quoi je parle) puis cliquer sur "Bienvenue X" puis sur "Compte".
                            </p>
                            <img alt="Navigation" class="w-80 d-block mx-auto shadow mt-3 mb-3" src="https://zupimages.net/up/20/16/9cti.png" />
                            <p>
                                Sur le profil, il y a les infos personnelles (celles rentrées lors de l'inscription, tu ne pourras <strong>pas</strong> les changer, mais au cas où tu ais oublié comment tu t'appelles ...), et puis les statistiques.
                            </p>
                            <img alt="Profil" class="w-80 d-block mx-auto shadow mt-3 mb-3" src="https://zupimages.net/up/20/16/xena.png" />
                            <p>
                                Les statistiques. Oui. Histoire de voir toutes tes performances. Les questionnaires que tu as essayé de faire, laborieusement, ton pourcentage de réussite, ce genre de choses.<br /><br />
                                <img alt="Statistiques" class="w-80 d-block mx-auto shadow mt-3 mb-3" src="https://zupimages.net/up/20/16/qtda.png" />


                            </p>
                            <div class="alert alert-warning mt-4" role="alert">
                                <strong>Attention :</strong> Tu as la possibilité de réinitialiser tes statistiques. Si tu valides, tout sera donc perdu. Pas de retour en arrière, c'est de-fi-ni-tif.
                            </div>
                        </div>
                    </div>
                    <!-- FIN Tutoriel profil et statistiques -->
                </div>
                <!-- FIN Tutoriels joueur -->

                <!-- DEBUT Tutoriels Administrateur -->
                <div id="tutoAdmin" class="tab-pane fade">
                    <div id="introAdmin" class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                        <p> Une fois connecté en tant qu'administrateur, tu es, comme le joueur, redirigé sur la <a href="liste_questR.php">liste des questionnaires.</a>
                            Ceci dit, et contrairement à ce dernier, tu n'auras pas la possibilité de jouer (pas de repos pour les braves). Tu pourras plutôt, depuis
                            cette page, <strong>gérer</strong> les différents questionnaires existants, ou en <strong>créer de nouveaux</strong>. Il te suffira, pour celà, d'appuyer sur les boutons associés.

                            <img alt="Liste des quizz Administrateur" class="w-80 mt-5 d-block mx-auto shadow" src="https://zupimages.net/up/20/16/8grn.png" />
                        </p>
                    </div>
                    <!-- DEBUT Tutoriel créer un nouveau questionnaire -->
                    <div id="ajoutQuestRTuto" class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                        <h3 class="mb-4">1. Ajouter un questionnaire</h3>

                        <div class="">
                            <h4 class=" mb-4">Choix de la difficulté</h4>
                            <p> Pour ce qui est de <strong>l'ajout de questionnaires </strong>, il faut cliquer sur le bouton du même nom (soit sur la liste des questionnaires, soit dans la
                                barre de navigation). Il va faire apparaitre une boite de dialogue qui va te demander de <strong>choisir la difficulté
                                    du questionnaire.</strong>.<br /><br /></p>

                            <img alt="Boite de dialogue difficultés" class="w-100 mb-5 shadow" src="https://zupimages.net/up/20/16/srk4.png" />

                            <p>
                                Un questionnaire peut être de <strong>5</strong> difficultés.<br />
                                Chaque difficulté implique un certain nombre de questions et de réponses par questions. L'échelle est présentée dans la boite de dialogue.<br />
                                Une fois la difficulté sélectionnée, appuies sur <strong>Poursuivre la création</strong> pour passer à la seconde étape !

                                Tu arrives sur la page de création de questionnaire à proprement parler.<br /><br />
                                Celle-ci se divise en un nombre variable de bloc : un bloc facultatif d'ajout de thème, un bloc d'informations générales, et autant de blocs de questions qu'en implique la difficulté que tu as choisi.

                                <h4 class="mt-4 mb-4">Thème</h4>
                                Chaque questionnaire correspond à un thème. La liste que nous proposons n'est pas exhaustive, tu auras peut-être besoin d'un thème auquel
                                nous n'avons pas pensé. Pour cela il y a un bloc qui te permet de <strong>vérifier</strong> si le thème existe et
                                <strong>au besoin</strong> te permet d'en ajouter (faut remplir la case et appuyer sur valider).

                                <div class="alert alert-warning mt-4" role="alert">
                                    <strong>Attention :</strong> Ce n'est pas dans ce bloc que tu <strong>sélectionnes</strong> le thème ! Ça, ça se fait après.
                                </div>

                                <img alt="Choix du Thème" class="w-80 mb-5 mx-auto d-block shadow" src="https://zupimages.net/up/20/16/8fu5.png" />


                                <h4 class="mt-4 mb-4">Informations générales</h4>

                                <img alt="Bloc Informations générales" class="w-80 mb-5 mx-auto d-block shadow" src="https://zupimages.net/up/20/16/q36s.png" />
                                Maintenant, il suffit de suivre les consignes. Nommer le questionnaire, lui donner une courte descritpion et une illustration.<br />
                                Tu ne peux <strong>pas</strong> changer la difficulté à ce stade. Tu peux sélectionner un thème dans la liste déjà existante, ou en créer un nouveau (au bas de la page)

                                <h4 class="mt-4 mb-4">Question</h4>
                                Un questionnaire, je ne t'apprends rien j'imagine que tu l'as compris, est divisé en un nombre variable de questions. Et chaque question a au minimum 2 réponses.
                                <br />Sur quizzy, il existe <strong>3</strong> types de questions : les <strong>Questions à Choix Multiple dits "QCM"</strong>, les
                                <strong>Questions à Choix Unique dits "QCU"</strong> et les <strong>Vrai/Faux</strong>.
                                <br />
                            </p>

                            <img alt="Bloc Question" class="w-80 mb-5 mx-auto d-block shadow" src="https://zupimages.net/up/20/16/0dc5.png" />

                            <p>
                                Quand tu créés une question, tu dois donc choisir si celle-ci sera un <strong>QCU</strong>, un <strong>QCM</strong> ou un <strong>vrai/faux</strong>.
                                Pour ça, il te suffit de selectionner celui de ton choix et, MAGIE, la suite apparait. (cétipabo le JS ?)<br /><br />

                                Selon ton choix, un bloc va s'ajouter pour contenir les réponses. Dans tous les cas, il faudra remplir le libellé de la réponse. <br />
                                Pour préciser si une réponse est la/une des réponses juste à la question, il te faudra la/les cocher.<br />
                                Si tu as une illustration pour la réponse, colles l'URL de celle-ci dans le champs associé.
                                <br /><br />

                                <h4 class="mt-4 mb-4">Valider</h4>

                                Une fois que toutes tes questions sont prêtes, appuies sur le bouton "Valider", et c'est posté ! Enfin si tu n'as pas oublié de remplir un des champs obligatoires. Sinon, bah remplis les cases rouges !
                                <br />


                            </p>

                        </div>
                    </div>
                    <!-- FIN Tutoriel créer un nouveau questionnaire -->

                    <!-- DEBUT Tutoriel modifier un questionnaire -->
                    <div id="modifQuestRTuto" class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                        <h3 class="mb-4">Modifier un questionnaire</h3>

                        <div class="">
                            <p>
                                Modifier un questionnaire, c'est un peu comme ajouter un questionnaire. Tout aussi simple. Sauf que, cette fois
                                le formulaire il est rempli d'informations déjà existantes.
                                <br />
                                Tu peux tout modifier ou presque. La difficulté, là aussi, ne pourra pas être touchée.
                                <div class="alert alert-warning mt-4" role="alert">
                                    <strong>Attention :</strong>
                                    Si tu modifies un questionnaire, tu supprimes les performances des joueurs relatives à celui-ci. Bah oui, si tu changes tout le
                                    questionnaire, leur score ne vaut plus rien.
                                </div>
                            </p>

                        </div>
                    </div>
                    <!-- FIN Tutoriel modifier un questionnaire -->

                    <!-- DEBUT Tutoriel supprimer un questionnaire -->
                    <div id="supprQuestRTuto" class="shadow bg-light p-4 mt-4 w-75 mx-auto">
                        <h3 class="mb-4">Supprimer un questionnaire</h3>

                        <div class="">
                            <p>
                                Tu as la possibilité de supprimer un questionnaire en appuyant sur le bouton "<strong>supprimer</strong>".<br />
                                Lorsque tu cliques dessus, une boîte de dialogue s'ouvre pour te demander de confirmer ton choix. Si tu es décidé, acceptes, sinon annules.

                                <img alt="Boite de Dialogue Suppression" class="w-80 mb-5 mt-5 mx-auto d-block shadow" src="https://zupimages.net/up/20/16/0dc5.png" />


                                <div class="alert alert-warning mt-4" role="alert">
                                    <strong>Attention :</strong>
                                    La suppression d'un questionnaire entraînera la suppression de tous les scores associés.

                                </div>

                                <div class="alert alert-warning mt-4" role="alert">
                                    <strong>Attention :</strong>
                                    Supprimer un questionnaire est définitif, tu t'en doutes bien.
                                </div>
                            </p>

                        </div>
                    </div>
                    <!-- FIN Tutoriel modifier un questionnaire -->
                </div>

                <!-- FIN Tutoriels joueur -->
            </div>



        </div>

    </div>
    <?php require_once('../includes/fragments/footer.php'); ?>
    <?php require_once('../includes/scripts/scripts.php'); ?>

</body>

</html>

</html>