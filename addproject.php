<?php
include("include/fonctions.php");

if(!empty($_POST['ajouter']))
{
	$mysqli = connect();
	$res = mysqli_query($mysqli, "INSERT INTO PROJET(INTITULE, PERIMETRE) VALUES('".$_POST['intitule']."', '".$_POST['perimetre']."')");
	header("location:projectlist.php");
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
	<input type="submit" name="ajouter" value="Ajouter"/>
</form>
<?php
include("include/bottom.php");
?>