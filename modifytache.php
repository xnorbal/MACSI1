<?php
include("include/fonctions.php");

if(empty($_GET['tid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$tid = mysqli_real_escape_string($mysqli, $_GET['tid']);
$req = mysqli_query($mysqli, "SELECT * FROM TACHE WHERE ID=".$tid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$rowTache = mysqli_fetch_assoc($req);

$idTache = $rowTache["ID"];
$objTache = $rowTache["OBJECTIF"];
$dateDebTache = $rowTache["DATEDEBUT"];
$dateFinTache = $rowTache["DATEFIN"];
$JHPrevTache = $rowTache["JH_PREVU"];
$JHPrisTache = $rowTache["JH_PRIS"];
$lid = $rowTache["LID"];

$message = '';
if(!empty($_POST['modifier'])) {
	if(!empty($_POST['datedeb']) && !empty($_POST['datefin']) && !empty($_POST['jhprev']) && (!empty($_POST['jhpris']) || $_POST['jhpris'] == 0)) {
		$objectif = mysqli_real_escape_string($mysqli, $_POST['objectif']);
		$datedeb = mysqli_real_escape_string($mysqli, $_POST['datedeb']);
		$datefin = mysqli_real_escape_string($mysqli, $_POST['datefin']);
		$jhprev = mysqli_real_escape_string($mysqli, $_POST['jhprev']);
		$jhpris = mysqli_real_escape_string($mysqli, $_POST['jhpris']);
		$datedebSQL = formatTimestampToDateSQL(strtotime(datefrToEn($datedeb)));
		$datefinSQL = formatTimestampToDateSQL(strtotime(datefrToEn($datefin)));
		
		
		if(strtotime(datefrToEn($datedeb)) <= strtotime(datefrToEn($datefin))){
			//On insère la tache
			$reqTache = mysqli_query($mysqli, "UPDATE TACHE SET OBJECTIF = '".$objectif."', DATEDEBUT='".$datedebSQL."', DATEFIN='".$datefinSQL."', JH_PREVU=".$jhprev.", JH_PRIS=".$jhpris." WHERE ID='".$idTache."'");
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
<h2>Modifier la tâche <?php echo $idTache; ?> du lot <?php echo $lid; ?></h2>
<?php echo $message; ?>

<form method="post" action="modifytache.php?tid=<?php echo $idTache;?>">
	<table>
		<tr>
			<td><label for="intitule">Objectif :</label></td>
			<td><input type="text" name="objectif" value="<?php echo $objTache; ?>" /></td>
		</tr>
		<tr>
			<td><label for="date">Date de début :</label></td>
			<td><input type="text" class="datepicker" name="datedeb" value="<?php echo formatSQLToFr($dateDebTache); ?>" /></td>
		</tr>
		<tr>
			<td><label for="date">Date de fin :</label></td>
			<td><input type="text" class="datepicker" name="datefin" value="<?php echo formatSQLToFr($dateFinTache); ?>" /></td>
		</tr>
		<tr>
			<td><label for="intitule">Jours Homme prévus :</label></td>
			<td><input type="text" name="jhprev" value="<?php echo $JHPrevTache; ?>" /></td>
		</tr>
		<tr>
			<td><label for="intitule">Jours Homme pris :</label></td>
			<td><input type="text" name="jhpris" value="<?php echo $JHPrisTache; ?>"/></td>
		</tr>
		<tr><td><input type="submit" name="modifier" value="Modifier"  class="button" /></td></tr>
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