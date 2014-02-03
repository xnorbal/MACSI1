<?php
include("include/fonctions.php");

if(!empty($_POST['ajouter'])) {
	if(!empty($_POST['intitule']) && !empty($_POST['perimetre'])) {
		$mysqli = connect();
		$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
		$perimetre = mysqli_real_escape_string($mysqli, $_POST['perimetre']);
		$res = mysqli_query($mysqli, "INSERT INTO PROJET(INTITULE, PERIMETRE) VALUES('".$intitule."', '".$perimetre."')");
		header("location:projectlist.php");
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

$titre = "Ajout de projet";
include("include/top.php");
?>

<h2>Projets</h2>
<form method="post" action="addproject.php">
	<label for="intitule">Intitulé :</label>
	<input type="text" name="intitule"/>
	<br />
	<label for="perimetre">Périmètre :</label>
	<textarea name="perimetre">
	</textarea>
	<br />
	<input type="submit" name="ajouter" value="Ajouter"  class="button" />
</form>
<?php
include("include/bottom.php");
?>