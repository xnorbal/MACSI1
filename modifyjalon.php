<?php
include("include/fonctions.php");

if(empty($_GET['jalonid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$jalonid = mysqli_real_escape_string($mysqli, $_GET['jalonid']);
$req = mysqli_query($mysqli, "SELECT * FROM JALON WHERE ID=".$jalonid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$intituleJalon = stripslashes($row['INTITULE']);
$dateJalon = stripslashes($row['SYNCPOINT']);
$pid = stripslashes($row['PID']);

$message = '';
if(!empty($_POST['modifier'])) {
	if(!empty($_POST['intitule']) && !empty($_POST['date'])) {
		$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
		$date = mysqli_real_escape_string($mysqli, $_POST['date']);
		$dateSQL = formatTimestampToDateSQL(strtotime(datefrToEn($date)));
		
		//On insère la phase
		$reqPhase = mysqli_query($mysqli, "UPDATE JALON SET INTITULE = '".$intitule."', SYNCPOINT = '".$dateSQL."' WHERE ID=".$jalonid);
		header("Location: projectdetails.php?pid=".$pid);
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

$titre = "Modifier le jalon ".$intituleJalon;
include("include/top.php");
?>
<h2>Modifier le jalon "<?php echo $intituleJalon; ?>"</h2>
<form method="post" action="modifyjalon.php?jalonid=<?php echo $jalonid;?>">
	<label for="intitule">Intitulé :</label>
	<input type="text" name="intitule" value="<?php echo $intituleJalon; ?>" />
	<br />
	<label for="date">Date du jalon :</label>
	<input type="text" id="datepicker" name="date" value="<?php echo formatSQLToFr($dateJalon); ?>" />
	<br />
	<input type="submit" name="modifier" value="Modifier"/>
</form>
<script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' }).val();
});
</script>
<?php
include("include/bottom.php");
?>