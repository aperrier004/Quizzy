<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'afficher une fenêtre de dialogue afin de confirmer la réinitialisation des scores
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
?>
<div class="modal fade" id="reinitmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Confirmer la réinitialisation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="profil.php" method="POST">
                <div class="modal-body">
                    <input type="txt" name="suppr_id" id="suppr_id" style="display:none;">
                    Êtes vous sûr de vouloir réinitialiser les scores ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary validerbtn" name="">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>