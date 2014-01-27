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
	if(!empty($_POST['intitule']) && !empty($_POST['date'])) {
		$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
		$date = mysqli_real_escape_string($mysqli, $_POST['date']);
		$dateSQL = formatTimestampToDateSQL(strtotime(datefrToEn($date)));
		
		//On insère la phase
		$reqPhase = mysqli_query($mysqli, "INSERT INTO JALON(PID, INTITULE, SYNCPOINT) VALUES(".$pid.",'".$intitule."','".$dateSQL."')");
		header("Location: projectdetails.php?pid=".$pid);
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

$titre = "Ajout de projet";
include("include/top.php");
?>
<h2>Ajouter un jalon au projet "<?php echo $inttuleProjet; ?>"</h2>
<form method="post" action="addjalon.php?pid=<?php echo $pid;?>">
	<label for="intitule">Intitulé :</label>
	<input type="text" name="intitule"/>
	<br />
	<label for="date">Date du jalon :</label>
	<input type="text" id="datepicker" name="date" />
	<br />
	<input type="submit" name="ajouter" value="Ajouter"/>
</form>
<script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' }).val();
});
</script>
<?php
include("include/bottom.php");
?>