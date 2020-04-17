<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'afficher un création d'une question
 * Inclut le choix du type de question
 * Appelle le Modal correspondant au type de question choisit
 * 
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
?>
<fieldset class="bg-gray p-4 mt-4">
    <legend>Question <?= $i ?></legend>
    <div class="form-group row">
        <label for="lib" class="col-sm-3 col-form-label">Intitulé de la question <span class="text-danger">*</span> :</label>
        <div class="col-sm-9">
            <input required type="text" class="form-control" id="lib" placeholder="Intitulé de la question" name="lib<?=$i?>"  
                <?php if(isset($quest))
                    echo "value=",$quest['quest_lib'];
                ?> required>
            <div class="invalid-feedback">Merci de remplir ce champ</div>
        </div>
    </div>

    <div class="form-group row">
        <label for="URLImg" class="col-sm-3 col-form-label">Ajouter une image :</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="URLImg" placeholder="URL de l'image" name="URLImg<?=$i?>"
            <?php if(isset($quest))
                    echo "value=",$quest['quest_URLImg'];
                ?>>
        </div>
    </div>

    <div class="blocTypeQuestion form-group row">
        <label class="col-sm-5 col-form-label">La question est-elle une Question à Choix Multiples ( QCM ), une Question à Choix
            Unique ( QCU ), ou un vrai/faux ? <span class="text-danger">*</span></label>
        <div id="choixTypeQuestion" class="choixTypeQuestion col-sm-5 d-flex justify-content-around align-items-center">
            <label><input required type="radio" name="typeQuestion<?= $i ?>" value="2" <?php if(isset($quest) && $quest['typeQ_id'] == 2) echo 'checked'?>> QCU</label>
            <label><input type="radio" name="typeQuestion<?= $i ?>" value="1" id="qcm" <?php if(isset($quest) && $quest['typeQ_id'] == 1) echo 'checked'?>> QCM</label>
            <label><input type="radio" name="typeQuestion<?= $i ?>" value="3" <?php if(isset($quest) && $quest['typeQ_id'] == 3) echo 'checked'?>> Vrai/Faux</label>
        </div>
    </div>
    <!-- bloc reponse si on choisit QCM -->
    <div class="reponsesQ<?= $i ?> reponses repQCM">
        <div class="form-group">
            <label class="form-label">Réponses possibles (cocher la ou les bonnes réponses) <span class="text-danger">*</span></label>
            <!-- une réponse :  nbReponsesQC fois-->
            <?php 
            // Si on modifie
            if(isset($quest) && $quest['typeQ_id'] == 1){
                $j=1;
                // Pour toutes les réponses en BD
                foreach($reps as $rep){
                    require "QCMModal.php";
                    $j++;
                };
            } else {
                // Si on créé le questR
                for ($j = 1; $j <= $nbReponsesQC; $j++) {
                    require "QCMModal.php";
                }
            }
            ?>
            <!-- fin réponses -->
        </div>
    </div>
    <!-- fin bloc reponse si on choisit qcm -->

    <!-- bloc reponse si on choisit QCU -->
    <div class="reponsesQ<?= $i ?> reponses repQCU">
        <div class="form-group">
            <label class="form-label">Réponses possibles (cocher la bonne réponse) <span class="text-danger">*</span></label>
            <!-- une réponse : nbReponsesQC fois -->
            <?php 
                // Si on modifie
                if(isset($quest) && $quest['typeQ_id'] == 2){
                    $j=1;
                    // Pour toutes les réponses en BD
                    foreach($reps as $rep){
                        require "QCUModal.php";
                        $j++;
                    };
                } else {
                    // Si on créé le questR
                    for ($j = 1; $j <= $nbReponsesQC; $j++) {
                        require "QCUModal.php";
                    }
                }
            ?>
            
            <!-- fin une réponse -->
        </div>
    </div>
    <!-- fin bloc reponse si on choisit qcu -->

    <!-- bloc reponse si on choisit vrai/faux -->
    <?php
        // Si on modifie
        if(isset($quest) && $quest['typeQ_id'] == 3) {
            foreach($reps as $rep){
            };
            require "QVFModal.php";
        } else {
            // Si on créé
            require "QVFModal.php";
        }
            
    ?>
    
</fieldset>