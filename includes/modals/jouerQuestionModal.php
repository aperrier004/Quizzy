<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'afficher la question et la réponse lorsque l'utilisateur veut jouer
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
?>
<?php
$i = 1;
foreach ($quests as $quest) {
    // Recup les réponses
    $reps = recupererRepParQuest($quest['quest_id']);?>
    <!-- une question -->
    <div class="question ">
        <h2 class="p-2 pl-3 mt-4 ml-3 lib_question"><?= $quest['quest_lib'] ?></h2>
        <img src="<?= $quest['quest_URLImg'] ?>" class="w-50 mx-auto d-block mb-3 img_question" />

        <h4>Réponses :</h4>
        <?php 
        $j=1; 
        // Pour chaque réponse concernant la question
        foreach($reps as $rep){    
            // Si on est pas dans soluce_QuestR et que la réponse est exacte, on incrémente le nb de réponses exactes du questionnaire
            if(!isset($correction)) if($rep['rep_exacte'] == 1) $nbRepExacte++;?> 

            <!-- une réponse -->
            <div class="reponse ml-5">
                <div class="form-check">
                    <!-- une réponse ( cas image )-->
                    <?php if(!empty($rep['rep_URLImg'])) {?>
                        <!-- si réponse image -->
                        <input type="<?php if($quest['typeQ_id'] == 1) echo 'checkbox'; else echo 'radio';?>" class="form-check-input input_image" id="<?=$rep['rep_id']?>" value ="#<?=$rep['rep_id']?>" name="rep<?=$i?>"
                             <?php //Si on est dans soluce_questR et que la réponse a été sélectionnée par le joueur, on check la réponse
                                if(isset($correction) && isset($rep))
                                if(isset($_POST["rep$i"]) &&  $_POST["rep$i"] == "#".$rep['rep_id'])
                                echo 'checked';
                                ?>>
                        <label for="<?=$rep['rep_id']?>"><figure class="figure img_reponse 
                            <?php //Si on est dans soluce_questR, et que la réponse est exacte, on entoure en vert
                                if(isset($correction)) if($rep['rep_exacte'] == 1) echo 'list-group-item-success p-2'; 
                                // Sinon en rouge
                                else echo 'list-group-item-danger p-2';
                            ?>
                        ">
                            <img src="<?= $rep['rep_URLImg'] ?>" class="figure-img img-fluid rounded w-100" alt="<?= $rep['rep_lib'] ?>">
                        </figure></label>
                        <!-- fin si réponse image -->

                    <?php } else {  ?>
                        <!-- si reponse textuelle-->
                        <input type="<?php if($quest['typeQ_id'] == 1) echo 'checkbox'; else echo 'radio';?>" class="form-check-input" id="<?=$rep['rep_id']?>" value ="#<?=$rep['rep_id']?>" name="rep<?=$i?>"
                            <?php if(isset($correction) && isset($rep))
                                if(isset($_POST["rep$i"]) &&  $_POST["rep$i"] == "#".$rep['rep_id'])
                                echo 'checked';
                                ?>>
                        <label for="<?=$rep['rep_id']?>" class="form-check-label
                            <?php //Si on est dans soluce_questR, que la réponse est exacte, on écrit en vert
                                if(isset($correction)) if($rep['rep_exacte'] == 1) echo 'text-success'; 
                                // Sinon en rouge
                                else echo 'list-group-item-danger p-2';
                            ?>
                        " for="rep<?=$i?><?=$j?>"><?= $rep['rep_lib'] ?></label>
                        <!-- fin si reponse textuelle -->
                    <?php } ?>
                </div>
            </div>
            <!-- fin une réponse -->
        <?php $j++; 
        } ?>
    </div>
    <hr/>
    <!-- fin une question -->
    <?php if(!isset($correction)) { ?>
        <!-- Pour donner le nombre de réponses exactes au formulaire -->
        <input type="hidden" name="nbRepExacte" value="<?=$nbRepExacte?>" />
    <?php } 
 $i++;
}
?>