<?php
/* MODULE DE PROGRAMMATION WEB
 * Rôle du fichier :
 * Permet d'insérer une zone d'alerte sur la page
 *
 *
 * Copyright 2020, BINET Coline et PERRIER Alban
 * https://ensc.bordeaux-inp.fr/fr
 *
 */ 
if(isset($alert))
{
?>
	<div class="alert alert-<?= isset($alert['classAlert']) ? $alert['classAlert'] : 'danger' ?>">
		<strong><?= $alert['messageAlert'] ?></strong>
	</div>
<?php
}?>