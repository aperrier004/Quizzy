<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'afficher une création d'une question de type QCM
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 


 // Les if(isset($rep) permettent de savoir si l'on se situe dans modifier_questR ou pas
?>
<div class="input-group mb-3" id="rep<?=$i?><?=$j?>">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <input type="checkbox" id="reponseQCM" name="reponseJuste<?=$i?><?=$j?>" aria-label="Checkbox for following text input" <?php if(isset($rep))if($rep['rep_exacte'] == 1 && $quest['typeQ_id'] == 1) echo 'checked'?>>
        </div>
    </div>
    <input class="intituleRep" type="text" id="libReponseQCM<?=$i?><?=$j?>" name="libReponseQCM<?=$i?><?=$j?>" class="form-control repQCM" placeholder="Intitulé de la réponse" value=<?php if(isset($rep))
                                if($quest['typeQ_id'] == 1)
                                echo $rep['rep_lib'];
                                ?>>

    <input type="text" name="URLImgReponse<?=$i?><?=$j?>" id="URLImgReponse<?=$i?><?=$j?>" class="form-control" placeholder="URL de l'image (facultatif)" value=<?php if(isset($rep))
                                if($quest['typeQ_id'] == 1)
                                echo $rep['rep_URLImg'];
                                ?>>
</div>