<?php
include("include/fonctions.php");

if(empty($_GET['spid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$spid = mysqli_real_escape_string($mysqli, $_GET['spid']);
$req = mysqli_query($mysqli, "SELECT * FROM SOUSPROJET WHERE ID=".$spid);

$message = "";

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}
else {
	$row = mysqli_fetch_assoc($req);
	$pid = stripslashes($row['PID']);
	$intituleSousProjet = stripslashes($row['INTITULE']);
	$perimetreSousProjet = stripslashes($row['PERIMETRE']);

	if(!empty($_POST['modifier'])) {
		$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
		$perimetre = mysqli_real_escape_string($mysqli, $_POST['perimetre']);
		if(!empty($intitule) && !empty($perimetre)) {
			$res = mysqli_query($mysqli, 'UPDATE SOUSPROJET SET INTITULE =\''.$intitule.'\', PERIMETRE=\''.$perimetre.'\' WHERE ID ='.$spid);
			header("location:projectdetails.php?pid=".$pid);
		}
		else {
			$message = "<p class=\"error\">";
			$message .= "Vous n'avez pas renseigné tous les champs.";
			$message .= "</p>";
		}
	}
}

$titre = "Modifier le sous-projet ".$intituleSousProjet;
include("include/top.php");

?>
<h2>Modifier le sous-projet "<?php echo $intituleSousProjet; ?>"</h2>
<form method="post" action="modifysproject.php?spid=<?php echo $spid; ?>">
	<label for="intitule">Intitulé :</label>
	<input type="text" name="intitule" value="<?php echo $intituleSousProjet; ?>" />
	<br />
	<label for="perimetre">Périmètre :</label>
	<textarea name="perimetre">
	<?php echo $perimetreSousProjet; ?>
	</textarea>
	<br />
	<input type="submit" value="Modifier" name="modifier" />
</form>
<?php
include("include/bottom.php");
?>