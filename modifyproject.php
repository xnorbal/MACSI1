<?php
include("include/fonctions.php");

if(empty($_GET['pid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$pid = mysqli_real_escape_string($mysqli, $_GET['pid']);
$req = mysqli_query($mysqli, "SELECT * FROM PROJET WHERE ID=".$pid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$intituleProjet = stripslashes($row['INTITULE']);
$perimetreProjet = stripslashes($row['PERIMETRE']);

if(!empty($_POST['modifier'])) {
	if(!empty($_POST['intitule']) && !empty($_POST['perimetre'])) {
		$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
		$perimetre = mysqli_real_escape_string($mysqli, $_POST['perimetre']);
		$res = mysqli_query($mysqli, "UPDATE PROJET SET INTITULE = '".$intitule."', PERIMETRE = '".$perimetre."'");
		header("location:projectlist.php");
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

$titre = "Modifier le projet ".$intituleProjet;
include("include/top.php");
?>

<h2>Modifier le projet "<?php echo $intituleProjet; ?>"</h2>
<form method="post" action="modifyproject.php?pid=<?php echo $pid; ?>">
	<label for="intitule">Intitulé :</label>
	<input type="text" name="intitule" value="<?php echo $intituleProjet; ?>" />
	<br />
	<label for="perimetre">Périmètre :</label>
	<textarea name="perimetre">
	<?php echo $perimetreProjet; ?>
	</textarea>
	<br />
	<input type="submit" name="modifier" value="Modifier"/>
</form>
<?php
include("include/bottom.php");
?>