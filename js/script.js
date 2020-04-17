
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet de recenser les fonctions JS et Jquery nécéssaires au fonctionnement du site
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 

$(document).ready(function () {

    /* fonction pour faire apparaitre la boite de dialogue du choix de difficulté pour la création d'un nouveau 
    questionnaire */
    $('#lienAjouterQuestR').on('click', function () {
        $('#choixDiffModal').modal('show'); //affichage du modal pour sélectionner la difficulte du questionnaire à créer.
        $('#difficulte').change(function () {
            /*en fonction de la difficulté choisie, le paramètre envoyé dans l'URL change pour pouvoir adapter le 
            nombre de questions et de réponses du formulaire de ajouter_questR.php*/
            url = "ajouter_questR.php?difficulte=";
            url += $(this).val();
            $('#poursuivreAjouterQuest').attr('href', url);
        });
    })

});



function preparerBlocReponses()
{
    /* on masque par defaut les 3 blocs de réponses [réponses pour QCM, pour QCU ou VraiFaux] */
    $('.reponses').css('display', 'none');

    /*on affiche le bloc de réponse demandé par l'utilisateur en changeant les required du formulaire */
    $('.choixTypeQuestion :input').change(function () {
        afficherBlocReponses($(this));
    }); 

    /* si le type de question est déjà coché -cas page modification- on affiche le bloc de réponses associé */
    $('.choixTypeQuestion input[type="radio"]').each(function () {
        if ($(this).prop('checked')) {
            afficherBlocReponses($(this));
        }


    });
}


//gère l'affichage des blocs de réponses dans le cas de l'ajout et de la modification de questionnaires
function afficherBlocReponses(blocInput) {
        //$(this).closest('#reponses').data('changed', true);
        type = blocInput.attr('value');
        blocReponses = blocInput.parents(".blocTypeQuestion").siblings(".reponses"); /* on recupere tous les blocs de reponse (VF/QCU/QCM)*/
        blocRepQCM = blocInput.parents(".blocTypeQuestion").siblings(".repQCM"); /* on recupere le bloc QCM */
        blocRepQCU = blocInput.parents(".blocTypeQuestion").siblings(".repQCU"); /* on recupere le bloc QCU */
        blocRepVF = blocInput.parents(".blocTypeQuestion").siblings(".repVF"); /* on recupere le bloc VF */
        if (type == "1") { // QCM
            blocReponses.css('display', 'none'); /* on masque les autres blocs de réponses*/
            blocRepQCM.css('display', 'block'); /*on affiche le bloc de réponses pour une QCM*/
            blocRepVF.find('input').prop('required', false); /*on enlève l'attribut les boutons du bloc Vrai/faux*/
            blocRepQCU.find('input').prop('required', false); /* on enleve l'attribut required aux boutons du bloc QCU*/
            blocRepQCM.find('.intituleRep').prop('required', true); /* on ajoute le required aux input des noms de réponses*/
        } else if (type == "3") { // VF
            blocReponses.css('display', 'none'); /* on masque les autres blocs de réponses*/
            blocRepVF.css('display', 'block'); /*on affiche le bloc de réponses pour un vrai/faux*/
            blocRepVF.find('input[type="radio"]').prop('required', true); /*on ajoute l'attribut les boutons du bloc Vrai/faux*/
            blocRepQCU.find('input').prop('required', false); /* on enleve l'attribut required aux boutons du bloc QCU*/
            blocRepQCM.find('.intituleRep').prop('required', false); /* on enleve le required des inputs des noms de réponses sur QCM*/

        } else { //QCU
            blocReponses.css('display', 'none'); /* on masque les autres blocs de réponses*/
            blocRepQCU.css('display', 'block'); /*on affiche le bloc de réponses pour une QCU*/
            blocRepQCU.find('input[type="radio"]').prop('required', true); /*on ajoute l'attribut required aux boutons du bloc QCU*/
            blocRepQCU.find('.intituleRep').prop('required', true); /*on ajoute l'attribut required aux input du label de la réponse bloc QCU*/
            blocRepVF.find('input').prop('required', false); /* on enleve l'attribut required sur les boutons du bloc Vrai/faux*/
            blocRepQCM.find('.intituleRep').prop('required', false); /* on enleve le required des inputs des noms de réponses sur QCM*/
        }

    
}


//affiche la boite de dialogue demandant la confirmation de la suppression du questionnaire et et prépare ladite suppresion

//dupliqué
function supprimerQuestionnaireModal()
{
    $('.supprbtn').click(function () {
        $('#supprmodal').modal('show'); //fait apparaitre la boite de dialogue pour confirmer la suppression
        card = $(this).closest('.card'); // recupere toute la card
        idQuestionnaire = card.attr('id'); // recupere l'ID de la card
        $('#suppr_id').val(idQuestionnaire);
    });
    
}

//Fait apparaitre la boite de dialogue visant à déterminer la difficulté du questionnaire à créer
function ajouterQuestionnaireModal()
{
        $('#choixDiffModal').modal('show'); //affichage de la boite de dialogue pour sélectionner la difficulte du questionnaire à créer.
        $('#difficulte').change(function () {
            /*en fonction de la difficulté choisie, le paramètre envoyé dans l'URL change pour pouvoir adapter le 
            nombre de questions et de réponses du formulaire de ajouter_questR.php*/
            url = "ajouter_questR.php?difficulte=";
            url += $(this).val();
            $('#poursuivreAjouterQuest').attr('href', url);
        });
}

//fait apparaitre la boite de dialogue demander la confirmation de la réinitialisation des scores
function reinitialiserStatsModal()
{
    $('#reinitmodal').modal('show');
}


// adapte la couleur du score (fin de partie) selon ce dernier
function couleurScore()
{
    score = parseInt($('#valeurScore').text(), 10); //on recupere la valeur du score
    textPourcentageReussite = $('#pourcentageReussite'); // on recupere le span qui affiche le score

    /* Si le score est inférieur à 25%, on ajoute la classe "text-danger" qui va afficher le score en rouge */
    if (score <= 25) {
        textPourcentageReussite.addClass('text-danger');
    } 
    /* Si le score est 25<X<=50, on ajoute la classe "text-warning" qui va afficher le score en orange */
    else if (score <= 50) {
        textPourcentageReussite.addClass('text-warning');
    } /* Si le score est 50<X<=75, on ajoute la classe "text-info" qui va afficher le score en bleu */
    else if (score <= 75) {
        textPourcentageReussite.addClass('text-info');
    } /* Si le score est 75<X<=100, on ajoute la classe "text-success" qui va afficher le score en vert */
    else {
        textPourcentageReussite.addClass('text-success');
    }
}