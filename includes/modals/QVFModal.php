<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'afficher une création d'une question de type VF
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 


// Les if(isset($rep) permettent de savoir si l'on se situe dans modifier_questR ou pas
?>
<div class="reponsesQ<?= $i ?> reponses repVF">
    <div class="form-group row">
        <label class="col-sm-5 col-form-label">Cocher la bonne réponse :<span class="text-danger">*</span></label>
        <div class="col-sm-3 col-form-label d-flex justify-content-around" id="">
            <label class="inputVrai"><input type="radio" name="libReponse<?= $i ?>" value="Vrai" <?php if (isset($rep)) if ($rep['rep_exacte'] == 0 && $rep['rep_lib'] == "Faux") echo 'checked' ?>> Vrai</label>
            <label class="inputFaux"><input type="radio" name="libReponse<?= $i ?>" value="Faux" <?php if (isset($rep)) if ($rep['rep_exacte'] == 1 && $rep['rep_lib'] == "Vrai") echo 'checked' ?>> Faux</label>
        </div>
    </div>
</div>