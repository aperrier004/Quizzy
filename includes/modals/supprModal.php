<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'afficher une fenêtre de dialogue afin de confirmer la suppression d'un questionnaire
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
?>
<div class="modal fade" id="supprmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Confirmer la suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="liste_questR.php" method="POST">
                <div class="modal-body">
                    <input type="txt" name="suppr_id" id="suppr_id" style="display:none;">
                    Êtes vous sûr de vouloir supprimer ce questionnaire ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary validerbtn" name="supprQuestR">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>