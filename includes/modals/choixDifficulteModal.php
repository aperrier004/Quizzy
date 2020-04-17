<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'afficher une fenêtre de dialogue pour choisir la difficulté du questionnaire qui va être créé
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
?>
<div class="modal fade" id="choixDiffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Choisir la difficulté du questionnaire à créer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="liste_questR.php" method="POST">
                <div class="modal-body w-70 mx-auto">
                    <input type="txt" name="choix_diff" id="choix_diff" style="display:none;">
                    <h3>Quelle sera la difficulté de ce questionnaire ?</h3>
                    <select class="form-control mt-2" id="difficulte" name="difficulte" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>

                    <div class="mt-3">
                        <div class="alert alert-warning mt-4" role="alert">
                            Le nombre de questions et de réponses diffèrera selon la difficulté choisie, voir le tableau ci dessous.
                        </div>
                        <table class="table border mt-3">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Difficulté</th>
                                    <th scope="col">Nombre de Questions</th>
                                    <th scope="col">Nombre de Réponses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-center">1</td>
                                    <td class="text-center">10</td>
                                    <td class="text-center">4</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">2</th>
                                    <td class="text-center">12</td>
                                    <td class="text-center">4</td>

                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">3</th>
                                    <td class="text-center">14</td>
                                    <td class="text-center">6</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">4</th>
                                    <td class="text-center">16</td>
                                    <td class="text-center">6</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">5</th>
                                    <td class="text-center">20</td>
                                    <td class="text-center">8</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <a href="ajouter_questR.php?difficulte=1" class="btn btn-primary validerbtn" id="poursuivreAjouterQuest"><i class="fas fa-arrow-right"></i> Poursuivre la création</a>
                </div>
            </form>
        </div>
    </div>
</div>