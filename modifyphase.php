<?php
include("include/fonctions.php");

if(empty($_GET['phaseid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$phaseid = mysqli_real_escape_string($mysqli, $_GET['phaseid']);
$req = mysqli_query($mysqli, "SELECT * FROM PHASE WHERE ID=".$phaseid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$intitulePhase = stripslashes($row['INTITULE']);
$pid = stripslashes($row['PID']);

$message = '';
if(!empty($_POST['modifier'])) {
	if(!empty($_POST['intitule'])) {
		$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
		
		//On modifie la phase
		$reqPhase = mysqli_query($mysqli, "UPDATE PHASE SET INTITULE = '".$intitule."' WHERE ID=".$phaseid);
		header("Location: projectdetails.php?pid=".$pid);
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

$titre = "Modifier la phase ".$intitulePhase;
include("include/top.php");
?>
<h2>Modifier la phase <?php echo $intitulePhase; ?></h2>
<form method="post" action="modifyphase.php?phaseid=<?php echo $phaseid;?>">
	<label for="intitule">Intitulé :</label>
	<input type="text" name="intitule" value="<?php echo $intitulePhase; ?>"/>
	<br />
	<input type="submit" name="modifier" value="Modifier"/>
</form>
<?php
include("include/bottom.php");
?>