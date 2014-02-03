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
$inttuleProjet = stripslashes($row['INTITULE']);

$message = '';
if(!empty($_POST['ajouter'])) {
	if(!empty($_POST['intitule'])) {
		$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
		
		//On insère la phase
		$reqPhase = mysqli_query($mysqli, "INSERT INTO PHASE(PID, INTITULE) VALUES(".$pid.",'".$intitule."')");
		header("Location: projectdetails.php?pid=".$pid);
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

$titre = "Ajout de projet";
include("include/top.php");
?>
<h2>Ajouter une phase au projet <?php echo $inttuleProjet; ?></h2>
<form method="post" action="addphase.php?pid=<?php echo $pid;?>">
	<label for="intitule">Intitulé :</label>
	<input type="text" name="intitule"/>
	<br />
	<input type="submit" name="ajouter" value="Ajouter"  class="button" />
</form>
<?php
include("include/bottom.php");
?>