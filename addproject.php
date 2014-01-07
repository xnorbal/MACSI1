<?php
include("include/fonctions.php");
$titre = "Ajout de projet";
include("include/top.php");
?>
<h2>Projets</h2>
<form method="post" action="createproject.php">
	<label for="intitule">Intitulé :</label>
	<input type="text" name="intitule"/>
	<br />
	<label for="perimetre">Périmètre :</label>
	<textarea name="perimetre">
	</textarea>
	<br />
	<input type="submit" value="Ajouter"/>
</form>
<?php
include("include/bottom.php");
?>