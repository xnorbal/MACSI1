<?php
include("include/fonctions.php");

if(empty($_GET['lid'])) {
	header("HTTP/1.0 404 Not Found");
	//header("Location: error404.php");
}

$mysqli = connect();
$lid = mysqli_real_escape_string($mysqli, $_GET['lid']);
$req = mysqli_query($mysqli, "SELECT * FROM LOT WHERE ID=".$lid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	//header("Location: error404.php");
}

//$row = mysqli_fetch_assoc($req);
//$inttuleProjet = stripslashes($row['INTITULE']);

$message = '';
if(!empty($_POST['ajouter'])) {
	if(!empty($_POST['datedeb']) && !empty($_POST['datefin']) && !empty($_POST['jhprev']) && !empty($_POST['jhpris'])) {
		$objectif = mysqli_real_escape_string($mysqli, $_POST['objectif']);
		$datedeb = mysqli_real_escape_string($mysqli, $_POST['datedeb']);
		$datefin = mysqli_real_escape_string($mysqli, $_POST['datefin']);
		$jhprev = mysqli_real_escape_string($mysqli, $_POST['jhprev']);
		$jhpris = mysqli_real_escape_string($mysqli, $_POST['jhpris']);
		$datedebSQL = formatTimestampToDateSQL(strtotime(datefrToEn($datedeb)));
		$datefinSQL = formatTimestampToDateSQL(strtotime(datefrToEn($datefin)));
		
		
		if(strtotime(datefrToEn($datedeb)) <= strtotime(datefrToEn($datefin))){
			//On insère la tache
			$reqTache = mysqli_query($mysqli, "INSERT INTO TACHE(LID, OBJECTIF, DATEDEBUT, DATEFIN, JH_PREVU, JH_PRIS) 
			VALUES(".$lid.",'".$objectif."','".$datedebSQL."','".$datefinSQL."','".$jhprev."','".$jhpris."')");
			header("Location: lotsdetails.php?lid=".$lid);
		} else {
			$message = "La date de fin précéde la date de début de la tâche";
		}
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

$titre = "Nouvelle tâche";
include("include/top.php");
?>
<h2>Ajout d'une tâche au lot <?php echo $lid; ?></h2>
<?php echo $message; ?>

<form method="post" action="addtache.php?lid=<?php echo $lid;?>">
	<table>
		<tr>
			<td><label for="intitule">Objectif :</label></td>
			<td><input type="text" name="objectif"/></td>
		</tr>
		<tr>
			<td><label for="date">Date de début :</label></td>
			<td><input type="text" class="datepicker" name="datedeb" /></td>
		</tr>
		<tr>
			<td><label for="date">Date de fin :</label></td>
			<td><input type="text" class="datepicker" name="datefin" /></td>
		</tr>
		<tr>
			<td><label for="intitule">Jours Homme prévus :</label></td>
			<td><input type="text" name="jhprev"/></td>
		</tr>
		<tr>
			<td><label for="intitule">Jours Homme pris :</label></td>
			<td><input type="text" name="jhpris"/></td>
		</tr>
		<tr><td><input type="submit" name="ajouter" value="Ajouter"  class="button" /></td></tr>
	</table>
</form>

<script>
$(function() {
$( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' }).val();
});
</script>

<?php
include("include/bottom.php");
?>