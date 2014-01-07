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
	if(!empty($_POST['intitule']) && !empty($_POST['dateDebut']) && !empty($_POST['dateFin'])) {
		$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
		$dateDebut = mysqli_real_escape_string($mysqli, $_POST['dateDebut']);
		$dateFin = mysqli_real_escape_string($mysqli, $_POST['dateFin']);
		
		$timestamp1 = strtotime(datefrToEn($dateDebut));
		$timestamp2 = strtotime(datefrToEn($dateFin));
		
		if($timestamp1 > $timestamp2) {
			$message = "Le jalon de début ne peut être postérieur au jalon de fin.";
		}
		else {
			
			$verifExist = mysqli_query($mysqli, "SELECT * FROM JALON WHERE SYNCPOINT='".formatTimestampToDateSQL($timestamp1)."' OR SYNCPOINT='".formatTimestampToDateSQL($timestamp2)."'");
			
			$listeJalonsIdSlectionnes = array();
			$listeJalonsDateSlectionnes = array();
			
			while($tuple = mysqli_fetch_assoc($verifExist)) {
				$idJalon = stripslashes($tuple['ID']);
				$dateJalon = stripslashes($tuple['SYNCPOINT']);
				
				array_push($listeJalonsIdSlectionnes,  $idJalon );
				array_push($listeJalonsDateSlectionnes,  $dateJalon );
			}
			
			//Si la date de début existe dans la base
			$key = array_search(formatTimestampToDateSQL($timestamp1),$listeJalonsDateSlectionnes);

			if($key !== false) {
				$idJalon1 = $listeJalonsIdSlectionnes[$key];
			}
			else {
				$res1 = mysqli_query($mysqli, "INSERT INTO JALON(SYNCPOINT) VALUES('".formatTimestampToDateSQL($timestamp1)."')");
				$idJalon1 = mysqli_insert_id($mysqli);
			}
			
			//Si la date de fin existe dans la base
			$key2 = array_search(formatTimestampToDateSQL($timestamp2),$listeJalonsDateSlectionnes);
			
			if($key2 !== false) {
				$idJalon2 = $listeJalonsIdSlectionnes[$key2];
			}
			else {
				$res2 = mysqli_query($mysqli, "INSERT INTO JALON(SYNCPOINT) VALUES('".formatTimestampToDateSQL($timestamp2)."')");
				$idJalon2 = mysqli_insert_id($mysqli);
			}
			
			//On insère la phase
			
			$reqPhase = mysqli_query($mysqli, "INSERT INTO PHASE(PID, JID1, JID2, INTITULE) VALUES(".$pid.",".$idJalon1.",".$idJalon2.",'".$intitule."')");
		}
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

$titre = "Ajout de projet";
include("include/top.php");
?>
 <script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' }).val();
$( "#datepicker2" ).datepicker({ dateFormat: 'dd/mm/yy' }).val();
});
</script>
<h2>Ajouter une phase au projet <?php echo $inttuleProjet; ?></h2>
<form method="post" action="addphase.php?pid=<?php echo $pid;?>">
	<label for="intitule">Intitulé :</label>
	<input type="text" name="intitule"/>
	<br />
	<label for="dateDebut">Jalon de début :</label>
	<input type="text" id="datepicker" name="dateDebut" /><br />
	<label for="dateFin">Jalon de fin :</label>
	<input type="text" id="datepicker2" name="dateFin" /><br />
	<br />
	<input type="submit" name="ajouter" value="Ajouter"/>
</form>
<?php
include("include/bottom.php");
?>