<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Recense toutes les fonctions PHP utiles au site
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
?>
<?php
// Pour se connecter à la base de données
// Retourne un objet PDO
function getDb() {
    // Déploiement en local
    $server = "localhost";
    $username = "quizz_user";
    $password = "admin";
    $db = "quizz";
    
    return new PDO("mysql:host=$server;dbname=$db;charset=utf8", "$username", "$password",
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

// Vérifie si l'utilisateur est connecté
// Retourne TRUE or FALSE
function isUserConnected() {
    return isset($_SESSION['pseudo']);
}

// Vérifie si l'utilisateur est un admin
// Retourne TRUE or FALSE
function estAdmin() {
    return isset($_SESSION['estAdmin']);
}

// Redirige sur une page web
// Prend un chemin d'url en paramètre
function redirect($url) {
    header("Location: $url");
}

// Enlève les caractères spéciaux
// Prend une chaîne de caractères en paramètre
// Retourne une chaîne de caractères simple
function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

// Permet de se connecter à un compte sur le site web
// Retourne une alerte pour le feedback positif ou négatif
function seConnecter(){
    // On vérifie qu'on nous envoie bien les valeurs attentdues en $_POST
    if (!empty($_POST['pseudo']) and !empty($_POST['mdp'])) {
        // On assigne les variables
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];

        // Requete préparée pour récuperer l'utilisateur avec le pseudo et le mdp donné
        $stmt = getDb()->prepare('select * from utilisateur where util_pseudo=? and util_mdp=?');
        $stmt->execute(array($pseudo, $mdp));
        
        // Si la requête a une ligne en résultat, alors les identifiants existent bien en BD et on peut confirmer la connexion
        if ($stmt->rowCount() == 1) {
            foreach ($stmt as $utilisateur)

            // Authentication réussie, on assigne des variables de SESSIONS
            $_SESSION['pseudo'] = $pseudo;
            $id = $utilisateur['util_id'];
            $_SESSION['util_id'] = $id;
    
            // On regarde si l'utilisateur est Admin
            $estAdmin = $utilisateur['util_estAdmin'];
            // Si oui, on le met en SESSION
            if($estAdmin == 1)
            {
                $_SESSION['estAdmin'] = $estAdmin;
            }

            $alert['classAlert'] = 'success';
	        $alert['messageAlert'] = 'Vous êtes connecté';
            
            // On redirige l'utilisateur sur la page liste_questR
            redirect("liste_questR.php");
            return $alert;
        } else { // Si les identifiants ne sont pas présents en BD
            $alert['classAlert'] = 'danger';
            $alert['messageAlert'] = 'Utilisateur non reconnu';

            return $alert;
        }
    }
}

// Permet de s'inscrire en BD
function inscription(){
    // On vérifie que les variables que l'on assigne sont présentes dans $_POST
    if (!empty($_POST['pseudo']) and !empty($_POST['mdp']) and !empty($_POST['email']) and !empty($_POST['mdpConfirmation']) and !empty($_POST['remember']) and !empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['sexe'])) {
       // On assigne les valeurs
       // On tronque la chaîne de caractères si elles dépassent une certaine longueur pour la cohérence avec la BD
        $email = tronquerString(escape($_POST['email']),32);
        $pseudo = tronquerString(escape($_POST['pseudo']),32);
        $mdp = tronquerString(escape($_POST['mdp']),32);
        $nom = tronquerString(escape($_POST['nom']),32, " ");
        $prenom = tronquerString(escape($_POST['prenom']),32, " ");
        $sexe = escape($_POST['sexe']);

        // Requête préparée pour insérer l'utilisateur en BD
        $stmt = getDb()->prepare('insert into utilisateur
        (util_pseudo, util_mdp, util_email, util_estAdmin, util_nom, util_prenom, util_sexe) 
        values (?, ?, ?, ?, ?, ?, ?)');
        // util_estAdmin est forcément à 0, on considère que l'on ne peut pas s'inscrire en tant qu'admin
        $stmt->execute(array($pseudo, $mdp, $email, 0, $nom, $prenom, $sexe));

        // On apppelle la fonction seConnecter() pour éviter à l'utilisateur de devoir se connecter une fois qu'il s'est inscrit
        seConnecter();

        // On redirige sur la page liste_QuestR
        redirect("liste_questR.php");
    } else { // si les variables non pas bien été transmises
        $error = "Incription impossible avec ces informations";
    }
}

// Récupère les informations sur un thème 
// Prend un entier theme_id en paramètre
// Retourne une chaîne de caractère correspondant au libellé du thème
function recupThemeParId($theme_id){
    // Requête préparée pour chercher le thème correspondant
    $stmt = getDb()->prepare('select * from theme where theme_id=? ');
    $stmt->execute(array($theme_id));

    foreach ($stmt as $theme)
    // On ne retourne que le champ theme_lib
    return $theme['theme_lib'];
}

// Affiche des icônes étoiles correspondant à la difficulté
// Prend un entier difficulté en paramètre
// Retourne une chaîne de caractère simple
function afficheDifficulte($difficulte){
    // Boucle pour afficher des étoiles pleines
    for ($i = 0; $i < $difficulte; $i++) {
        echo '<i class="fas fa-star"></i>';
    }
    // Boucle pour afficher des étoiles vides
    for ($i = $difficulte; $i < 5; $i++) {
        echo '<i class="far fa-star"></i>';
    }
}

// Supprime un questionnaire
// Prend un entier id en paramètre
function supprimerQuestRParId($id){
    // Requête préparée pour supprimer le questionnaire en BD
    $stmt = getDb()->prepare('DELETE FROM questionnaire WHERE questR_id=?');
    $stmt->execute(array($id));
    
    // Si on a bien validé la suppression
    if(isset($_POST['suppr_id'])){
        // on supprime cette variable correspondant au submit
        unset($_POST['suppr_id']);
        // On redirige
        redirect("liste_questR.php");

        $alert['classAlert'] = 'success';
	    $alert['messageAlert'] = "Le questionnaire $id a bien été supprimé ";
        return $alert;
    }
}

// Permet de générer le lien pour afficher la page pour joueur un questionnaire
// Prend un entier id en paramètre
function lienPourJouer($id){
    // Si l'utilisateur est connecté
    if(isUserConnected()) {
        // On lui affiche un lien correct
        echo "questR.php?id=$id";
    }
    else {
        // Sinon on le renvoie a la page de connexion
        $error = "Il faut se connecter pour pouvoir jouer";
        echo "login.php";
    }
}
// Ajoute un questionnaire en BD
function ajouterQuestR(){
    // Pour vérifier que les variables sont bien présentes
    if(!empty($_POST['lib']) and !empty($_POST['desc']) and !empty($_POST['difficulte']) and !empty($_POST['theme']) and !empty($_POST['URLImg'])) {
    // le questionnaire a été envoyé dans le formulaire
    // On récupère les paramètres
    $lib = tronquerString(escape($_POST['lib']),255, " ");
    $desc = tronquerString(escape($_POST['desc']),255);
    $difficulte = escape($_POST['difficulte']);
    $tempsMax = escape($_POST['tempsMax']);
    $theme = escape($_POST['theme']);
    $util = $_SESSION['util_id'];
    $nomImg = $lib;
    $URLImg = tronquerString(escape($_POST['URLImg']),20000);

    // Requête préparée pour insérer le questR dans la BD
    // NOW() permet d'avoir la date du moment
    $stmt = getDb() -> prepare('INSERT INTO questionnaire 
        (questR_lib, questR_desc, questR_difficulte, questR_tempsMax, theme_id, util_id, questR_dateAjout, questR_URLImg, questR_nomImg)
        VALUES (?,?,?,?,?,?,NOW(),?,?)');
    $stmt -> execute(array($lib, $desc, $difficulte, $tempsMax,  $theme, $util, $URLImg, $nomImg));
    } else {
        $_SESSION['error'] = 'Toutes les valeurs ne sont pas bonnes pour le questR';
    }
}
// Ajouter un thème en BD
function ajouterTheme(){
    // Pour vérifier que les variables sont bien présentes
    if (!empty($_POST['nouveauTheme'])) {
        $theme = tronquerString(escape($_POST['nouveauTheme']),255, " ");

        // On vérifie si le thème n'existe pas déjà
        $stmt = getDb() -> prepare('SELECT theme_lib FROM theme WHERE theme_lib = ?');
        $stmt -> execute(array($theme));

        // si on ne trouve pas de thème avec le même nom
        if ($stmt->rowCount() == 0) {
            // insertion du nouveau thème dans la BD
            $stmt = getDb() -> prepare('INSERT INTO theme (theme_lib) VALUES (?)');
            $stmt -> execute(array($theme));
        
            redirect("ajouter_questR.php");
        } else {
            // le thème existe déjà
            $error = "Le thème que vous essayez d'ajouter existe déjà.";
        }    
}
}
// Récupère l'id du questionnaire le plus récent ajouté en BD
// Retourne un entier id
function recupIdDernierQuestR(){
    // Requête préparée pour chercher l'id max d'un questionnaire en BD
    $stmt = getDb() -> prepare('SELECT MAX(questR_id) FROM questionnaire');
    $stmt -> execute();

    foreach ($stmt as $dernierQuestR_id);

    return $dernierQuestR_id[0];
}

// Ajoute une question en BD
// Prend un entier questR_id correspondant au questR le plus récent et un entier i correspondant a un compteur en paramètre
// Prend aussi un entier correspondant au nombre de réponses à ajouter
function ajouterQuest($dernierQuestR_id, $i, $nbReponsesQC){
    // Pour vérifier que les variables sont bien présentes
    if (!empty($_POST["lib$i"]) and !empty($_POST["typeQuestion$i"])) {
        // On récupère les paramètres
        $lib = tronquerString(escape($_POST["lib$i"]),255, " ");
        $typeQ = $_POST["typeQuestion$i"];
        $nomImg = $lib;
        $URLImg = tronquerString(escape($_POST["URLImg$i"]),20000);

        // Requête préparée pour insérer la question dans la BD
        $stmt = getDb() -> prepare('INSERT INTO question 
            (quest_lib, questR_id, quest_nomImg, quest_URLImg, typeQ_id)
            VALUES (?,?,?,?,?)');
        $stmt -> execute(array($lib, $dernierQuestR_id, $nomImg, $URLImg, $typeQ));
        
        // On recup l'id de la question qui vient d'être créée
        $quest_id = recupIdDerniereQuest();

        // On ajoute les réponses
        if($typeQ != 3){ // type question QCU ou QCM
            // On boucle pour ajouter toutes les questions
            for ($j = 1; $j <= $nbReponsesQC; $j++) {
                ajouterReponse($quest_id, $i, $typeQ, $j);
            }
        } else {
            // type de question VF
            ajouterReponseVF($quest_id, $i);
        }
    }
}

// Pour récupérer l'id de la dernière question créée
// Retourne un entier
function recupIdDerniereQuest(){
    // Requête préparée pour chercher le dernier quest_id créé en BD
    $stmt = getDb() -> prepare('SELECT MAX(quest_id) FROM question');
    $stmt -> execute();

    foreach ($stmt as $dernierQuest_id)
    return $dernierQuest_id;
}

// Ajoute une réponse de type QCM ou QCU en BD en precisant s'il s'agit de la bonne réponse
// Prend un objet question, un entier i, un entier typeQ et un entier j en paramètres
function ajouterReponse($quest_id, $i, $typeQ, $j){
    if($typeQ == 1) { // Type QCM
        if(isset($_POST["reponseJuste$i$j"])) {
            $exacte = 1; // La réponse est vraie
        } else {
            $exacte = 0; // La réponse est fausse
        }
        $lib = tronquerString(escape($_POST["libReponseQCM$i$j"]),255, " ");
    } else { // Type QCU
        if(isset($_POST["reponseQ$i"])) {
            if($_POST["reponseQ$i"] == "reponseJuste$i$j") {
                $exacte = 1; // La réponse est vraie
            } else {
                $exacte = 0; // La réponse est fausse
            }
        }
        $lib = tronquerString(escape($_POST["libReponseQCU$i$j"]),255, " ");
    }
    // On récupère les paramètres
    $nomImg = $lib;
    $URLImg = tronquerString(escape($_POST["URLImgReponse$i$j"]),20000);

    // Requête préparée pour insérer la réponse dans la BD
    $stmt = getDb() -> prepare('INSERT INTO reponse 
        (rep_exacte, rep_lib, quest_id, rep_nomImg, rep_URLImg)
        VALUES (?,?,?,?,?)');
    $stmt -> execute(array($exacte, $lib, $quest_id[0], $nomImg, $URLImg));
}

// Ajoute une réponse de type QCM ou QCU en BD
// Prend un objet question et un entier i en paramètres
function ajouterReponseVF($quest_id, $i){
    // on verifie que les variables existent
    if (!empty($_POST["libReponse$i"])) {

        $lib1 = tronquerString(escape($_POST["libReponse$i"]),255);

        if($lib1 == "Vrai"){
            $exacte1 = 1; // La réponse à la question est vraie
            $lib2 = "Faux";
            $exacte2 = 0;
        } else {
            $exacte1 = 0; // La réponse est fausse
            $lib2 = "Vrai";
            $exacte2 = 1;
        }

       // Requête préparée pour inserer la réponse exacte en BD
        $stmt = getDb() -> prepare('INSERT INTO reponse 
            (rep_exacte, rep_lib, quest_id)
            VALUES (?,?,?)');
        $stmt -> execute(array($exacte1, $lib1, $quest_id[0]));

        // Requête préparée pour inserer la réponse fausse en BD
        $stmt = getDb() -> prepare('INSERT INTO reponse 
        (rep_exacte, rep_lib, quest_id)
        VALUES (?,?,?)');
        $stmt -> execute(array($exacte2, $lib2, $quest_id[0]));
    }
}

// Récupère le questionnaire pour un id donnée
// Prend un entier id en paramètre
// Retourne un tableau de données
function recupererQuestRParId($questR_id){
    // Requête préparée pour chercher les données questR correspondant à l'id donné
    $stmt = getDb() -> prepare('SELECT * FROM questionnaire WHERE questR_id = ?');
    $stmt -> execute(array($questR_id));

    foreach ($stmt as $questR);

    return $questR;
}

// Récupère les questions associées à un questionnaire
// Prend un entier id en paramètre
// Retourne un objet PDO
function recupererQuestParQuestR($questR_id){
    // Requête préparée pour chercher les questions correspondant au questionnaire donné
    $stmt = getDb() -> prepare('SELECT * FROM question WHERE questR_id = ?');
    $stmt -> execute(array($questR_id));

    return $stmt;
}

// Récupère les réponses associées à une question
// Prend un entier id en paramètre
// Retourne un objet PDO
function recupererRepParQuest($quest_id){
    // Requête préparée pour chercher les réponses correspondant à la question
    $stmt = getDb() -> prepare('SELECT * FROM reponse WHERE quest_id = ?');
    $stmt -> execute(array($quest_id));

    return $stmt;
}

// Récupère la question associée à une réponse
// Prend un entier id en paramètre
// Retourne un objet PDO
function recupererQuestParRep($rep_id){
    // Requête préparée pour chercher les réponses correspondant à la question
    $stmt = getDb() -> prepare('SELECT * FROM reponse WHERE rep_id = ?');
    $stmt -> execute(array($rep_id));

    return $stmt;
}

// Modifie un questionnaire en BD
// Prend un entier id, un entier nbQuestions et un entier nbReponsesQC en paramètres
function modifierQuestR($questR_id, $nbQuestions, $nbReponsesQC){
    //On créé un nouveau questionnaire
    ajouterQuestR();

    // On récupère l'id le plus récent de questionnaire
    // On suppose qu'il n'y a pas d'accès concurrent, très couteux en temps de passer par des LOCK au niveau de la BD
    $dernierQuestR_id = recupIdDernierQuestR();

    // Boucle pour ajouter toutes les questions en BD
    for ($i = 1; $i <= $nbQuestions; $i++) {
        ajouterQuest($dernierQuestR_id, $i, $nbReponsesQC);
    };

    // On termine en supprimant le questR qui existait
    supprimerQuestRParId($questR_id);
    
    // On redirige
    redirect("liste_questR.php");
     
}

// Récupère les informations sur l'utilisateur donné
// Prend un entier id en paramètre
// Retourne un objet PDO
function recupUtilisateurParId($util_id){
    // Requête préparée pour chercher l'utilisateur correspondant à l'id de l'utilisateur connecté
    $stmt = getDb() -> prepare('SELECT * FROM utilisateur WHERE util_id = ?');
    $stmt -> execute(array($util_id));

    return $stmt;
}

// Récupère les stats liées à un utilisateur
// Prend un entier id en paramètre
// Retourne un objet PDO
function recupStatsParUtilId($util_id){
    // Requête préparée pour chercher les meilleurs performances réalisées par l'utilisateur que l'on donne en id
    // Cette requête permet de classer les questionnaires réalisés par score décroissant (plus grand) et par temps croissant (plus petit)
    $stmt = getDb() -> prepare('SELECT * FROM realiser WHERE util_id = ? GROUP BY real_id ORDER BY real_score DESC, real_tpsTotal ASC');
    $stmt -> execute(array($util_id));

    return $stmt;
}

// Supprime les statistiques liés à un utilisateur
// Prend un entier id en paramètre
function supprimerStatsParUtilId($util_id){
    // Requête préparée pour supprimer les informations (ici = statistiques) liés à l'utilisateur dans la table Realiser
    $stmt = getDb()->prepare('DELETE FROM realiser WHERE util_id=?');
    $stmt->execute(array($util_id));
    
    // Si la variable submit de suppression est activée
    if(isset($_POST['suppr_id'])){
        // On remet la variable à 0
        unset($_POST['suppr_id']);
        // On redirige
        redirect("profil.php");
    }
}

// Permet d'ajouter la réalisation d'un questR en BD et d'avoir toutes les données à afficher pour la page soluce
// Prend un entier id questionnaire en paramètre
// Retourne un tableau composé de deux autres tableaux
function corriger($questR_id, $questions){

    // Variable pour le score de chaque question
    $scoreQuestion = 0;
    // Variable pour compter le nombre de question dans le questR
    $nbQuestions = 0;
    // Variable pour compter le nb de réponses justes cochées
    $nbReponsesJusteCochée = 0;
    // Variable pour compter le nombre de réponses qui ont été cochées
    $nbReponsesCochée = 0;

    // Pour chaque question du questionnaire
    foreach($questions as $quest){
        // Variable pour compter le nb de réponses justes cochées dans la question
        $nbReponsesQuestionJusteCochée = 0;
        // Variable pour compter le nombre de réponses qui ont été cochées dans la question
        $nbReponsesQuestionCochée = 0;

        // Requête préparée pour  récupérer toutes les rep_id de la table Selectionner en BD correspondant à l'utilisateur et correspondant à la question que l'on corrige
        $stmt = getDb() -> prepare('SELECT * FROM selectionner WHERE util_id = ? AND quest_id = ?');
        $stmt -> execute(array($_SESSION['util_id'], $quest['quest_id']));

        // Pour chaque réponse sélectionnée
        foreach($stmt as $rep){
            // On incrémente le nb de reponsé cochée à la question
            $nbReponsesQuestionCochée++; 
    
            // Requête préparée pour récupérer la valeur de rep_exacte pour cette réponse
            $stmt2 = getDb() -> prepare('SELECT rep_exacte FROM reponse WHERE rep_id = ?');
            $stmt2 -> execute(array($rep['rep_id']));
    
            foreach($stmt2 as $repExacte);
    
            // Si la réponse est exacte
            if($repExacte['rep_exacte'] == 1){
                // On incrémente le nb de réponses justes qui ont été cochées
                $nbReponsesQuestionJusteCochée++;
            }
        }

        // Si la question avait au moins une réponse de cochée
        if($nbReponsesQuestionCochée != 0){
            // On réalise le calcul de score pour la question
            $scoreQuestion += $nbReponsesQuestionJusteCochée/$nbReponsesQuestionCochée;
        } else {
            // Sinon la question a 0 comme score
            $scoreQuestion += 0;
        }
        
        // On incrémente le nb de questions 
        $nbQuestions ++;

        // On somme les valeurs de score et de nombre de réponses cochées
        $nbReponsesJusteCochée += $nbReponsesQuestionJusteCochée;
        $nbReponsesCochée += $nbReponsesQuestionCochée;
    }

    // On calcule le score du questionnaire dans sa totalité
    $score = $scoreQuestion / $nbQuestions * 100;

    // Requête préparée pour supprimer les données de la table Selectionner en BD pour l'utilisateur en question
    // On supprime ces données car la table Selectionner ne doit servir que de mémoire temporaire pour la sélection des réponses cochées par l'utilisateur
    $stmt3 = getDb()->prepare('DELETE FROM selectionner WHERE util_id=?');
    $stmt3 ->execute(array($_SESSION['util_id']));

    // On récupère le nb de réponses exactes contenues dans le questionnaire via l'URL
    $nbRepExacteQuestR = $_GET['nbRepExacte'];

    // On calcule le nb de réponses fausses
    $nbRepFausseCochée = abs($nbReponsesJusteCochée - $nbReponsesCochée);
    // On arrondit le score
    $score = round($score, 2);

    // On récupère les variables de temps via l'URL
    $tpsDebut = $_GET['tpsDebut'];
    $tpsFin = $_GET['tpsFin'];
    
    // On stocke dans une variable la DateInterval retournée par la fonction
    // DateInterval qui correspond au temps écoulé entre le début de réalisation de questionnaire et sa fin
    $tps = tempsEcoule($tpsDebut, $tpsFin);

    // On stocke dans une variable la DateInterval sous un format que l'on veut
    // en l'occurence : 00:00:00
    // H: Heures | I: Minutes | S: Secondes
    // En majuscules pour avoir 2 zéros | minuscule pour 1 seul (0:0:0)
    $tpsTotal = $tps->format('%H:%I:%S');
    
    // Requête préparée pour insérer le questR réalisé dans la BD
    $stmt5 = getDb() -> prepare('INSERT INTO realiser 
    (util_id, questR_id, real_score, real_tpsTotal, real_date)
    VALUES (?,?,?,?,NOW())');
    $stmt5 -> execute(array($_SESSION['util_id'], $questR_id, $score, $tpsTotal));

    // Recherche du meilleur joueur
    // Fonction qui nous retourne les informations sur la meilleure performance pour le questionnaire en question
    $statsMeileurJoueur = recupMeilleurJoueur($questR_id);

    // On génère une phrase de fin pour l'affichage du score
    // Fonction qui retourne une chaîne de caractères
    $phraseScore = phraseScore($score);
    
    // Permet d'initialiser un array avec les variables correspondant aux chaînes de caractères
    // "score" correspond à la variable $score
    $resultats = array("score", "tpsTotal", "nbRepFausseCochée", "phraseScore");
    
    // On retourne un array de 2 tableaux
    // compact() permet de créer l'array que l'on a initialisé au dessus
    return array(compact($resultats), $statsMeileurJoueur);
}

// Permet de sauvegarder les réponses sélectionnées par un joueur en BD
// Prend un tableau de variables correspondant à $_POST en paramètre
function sauvergarderSelection($varPost){
    // On parcours toutes les valeurs des variables contenues dans $varPost
    foreach($varPost as $rep ){
        // si la valeur d'une des variable dans POST a un # au début, alors il s'agit d'une valeur correspondant à l'identifiant d'une réponse
        if(preg_match('/#/i', $rep, $matches, PREG_OFFSET_CAPTURE)){
            // Requête préparée pour insérer les réponses sélectionnées dans la BD
            $stmt = getDb() -> prepare('INSERT INTO selectionner 
            (util_id, rep_id, quest_id)
            VALUES (?,?,?)');

            // str_replace($search, $replace, $subject) -> on cherche le # pour le remplacer par du vide dans la valeur de rep
            $rep_id = str_replace('#', "", $rep);

            // On veut récupérer la question à laquelle cette réponse appartient
            $quests = recupererQuestParRep($rep_id);
            foreach($quests as $quest);

            // Cela nous permet d'insérer le quest_id
            $stmt -> execute(array($_SESSION['util_id'], $rep_id, $quest['quest_id']));
        }
    }
}

// On récupère l'utilisateur qui a le meilleur score/temps sur la réalisation d'un questionnaire
// Prend un entier questR_id en paramètre
// Retourne les informations sur la réalisation du joueur
function recupMeilleurJoueur($questR_id){
    // Requête préparée pour récupérer les stats du meilleur joueur
    // Réalise un classement d'abord par meilleur score = score le plus élevé et ensuite par meilleur temps = temps le plus faible
    // Ensuite on limite le résultat à une seule ligne (qui correspond au premier du classement)
    $stmt = getDb() -> prepare('SELECT * FROM realiser WHERE questR_id = ? GROUP BY real_id ORDER BY real_score DESC, real_tpsTotal ASC LIMIT 1 ');
    $stmt -> execute(array($questR_id));

    foreach($stmt as $stats);
    return $stats;
}

// Récupère le pseudo d'un utilisateur
// Prend un entier util_id en paramètre
// Retourne une chaîne de caractère
function recupPseudoParId($util_id){
    // Requête préparée pour récupérer le pseudo de l'utilisateur donné
    $stmt = getDb() -> prepare('SELECT util_pseudo FROM utilisateur WHERE util_id = ?');
    $stmt -> execute(array($util_id));

    foreach($stmt as $pseudo);
    // On retourne la première valeur du tableau pseudo qui correspond à sa chaîne de caractères
    return $pseudo[0];
}

// Génère une phrase selon le score
// Prend un entier score en paramètre
// Retourne une chaîne de caractères
function phraseScore($score){
    // On initialise la variable
    $phrase = "Insérer phrase humoristique";

    switch (true) {
        case ($score < 10): 
            $phrase = "Je ne savais même pas que c'était possible";
            break;
        case ($score < 20): 
            $phrase = "Il va t’arriver des bricoles";
            break;
        case ($score < 30): 
            $phrase = "On t'avait pourtant dit de pas laisser jouer ton petit-frère";
            break;
        case ($score < 40): 
            $phrase = "Tu t'es trompé de question quand tu as répondu ?";
            break;
        case ($score < 50): 
            $phrase = "L'aléatoire, tu connais ?";
            break;
        case ($score < 60): 
            $phrase = "Pas de quoi pousser mémé dans les orties";
            break;
        case ($score < 70): 
            $phrase = "Elementaire mon cher Jackson";
            break;
        case ($score < 80): 
            $phrase = "Vers l'infini et au-delà";
            break;
        case ($score < 90): 
            $phrase = "J'imagine que tu es fan c'est ça ?";
            break;
        case ($score < 100): 
            $phrase = "Si près du but... Tu vas y arriver!";
            break;
        case ($score == 100): 
            $phrase = "Mais qui peut te stopper?";
            break;
    }
    return $phrase ;
}

// Permet d'afficher des messages d'alerte
// Prend une chaîne de caractères en paramètre
// Retourne un tableau contenant une chaîne de caractères
function choixAlert($message)
{
  $alert = array();
  switch($message)
  {
    case 'query' :
      $alert['messageAlert'] = 'Problème d\'accès à la base de données. Contactez l\'administrateur';
      break;
    case 'url_non_valide' :
      $alert['messageAlert'] = 'Oops, la page demandée n\'existe pas !';
      break;
    default :
      $alert['messageAlert'] = "Une erreur s'est produite";
  }
  return $alert;
}

// Permet de tronquer une chaîne de caractères à la taille voulue
// Prend une chaîne de caractères, un entier 'limit' en paramètres
// Retourne une chaîne de caractères (potentiellment raccourcie)
// le break="." permet de couper la chaîne si possible lorsque l'on rencontre un point
// Par exemple dans le cas d'une description, la fonction va essayer de couper la chaîne de caractères (si elle est trop longue) à la fin de la phrase
// le pad="..." permet de rajouter ces trois caractères à la fin de la chaîne raccourcie pour notifier qu'elle a été tronquée
function tronquerString($string, $limit, $break=".", $pad="...")
{
  // retourne le string sans changement s'il est plus court que la limite donnée
  if(strlen($string) <= $limit) return $string;

  // vérifie si le point de break est présent entre la limite et la fin du string
  //strpos() renvoie la position dans la chaine du caractères $break
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
      // s'il existe ce $breakpoint avant la fin de la chaîne
    if($breakpoint < strlen($string) - 1) {
        // Alors on supprime ce qu'il y a après ce $breakpoint
        // Et on rajoute les caractères $pad
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;
}

// Permet d'obtenir le temps écoulé entre deux timestamp
// Prend deux timestamps en paramètres
// Retourne un objet DateInterval
function tempsEcoule($tpsDebut, $tpsFin){
    // On créé des objets date temporaires
    $date1 = date_create();
    $date2 = date_create();
    // On leur attribue la valeur des timestamps donnés en paramètres
    date_timestamp_set($date1,$tpsDebut);
    date_timestamp_set($date2,$tpsFin);

    // avec date_diff on fait la différence entre les deux
    $tpsTotal = date_diff($date2, $date1);
    
    // On return un objet DateInterval
    return $tpsTotal;
}

// Récupère le nombre de questions et le nombre de réponses que doit avoir un questionnaire selon sa difficulté
// Prend un entier difficulte en paramètre
// Retourne un tableau d'entiers
function recupeNbQuestionsReponses($difficulte){
    // Par défaut pour la définition des variables
    $nbQuestions = 10 ;
    $nbReponsesQC = 4 ;

    switch ($difficulte) {
        case 1:
            $nbQuestions = 10; 
            $nbReponsesQC = 4;
            break;
        case 2:
            $nbQuestions = 12; 
            $nbReponsesQC = 4;
            break;
        case 3:
            $nbQuestions = 14; 
            $nbReponsesQC = 6;
            break;
        case 4:
            $nbQuestions = 16; 
            $nbReponsesQC = 6;
            break;
        case 5:
            $nbQuestions = 20; 
            $nbReponsesQC = 8;
            break;
    }

    return array($nbQuestions, $nbReponsesQC);
}