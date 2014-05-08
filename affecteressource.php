<?php
include("include/fonctions.php");
$message ='';
if(!empty($_POST['ajouter'])) {
	if(!empty($_POST['type']) && !empty($_POST['txaffect'])) {
		$mysqli = connect();
		$type=$_POST['type'];
		$txaffect=$_POST['txaffect'];
		$idproj=$_POST['proj'];
		$idtache=$_POST['task'];
		switch($_POST["type"])
		{
			//Verifier le tx d'affecation préalablement
			case 1:
				//enregistrer ressource personne -> TACHERH
				$idressH = $_POST["ressH"];
				$res1 = mysqli_query($mysqli, "SELECT TXAFFECTATION FROM TACHERH WHERE RHID=".$idressH."");
				$sum_txaffect = 0;
				while($row = mysqli_fetch_assoc($res1)) {
						$sum_txaffect += $row["TXAFFECTATION"];
				}
				if(($sum_txaffect + $txaffect) <= 100){
					mysqli_query($mysqli, "INSERT INTO TACHERH(TID, RHID, TXAFFECTATION) VALUES(".$idtache.", '".$idressH."', '".$txaffect."')");
					header("location:ressourcelist.php");
				} else {
					$message = "La ressource est utilisee a plus de 100%";
				}
				break;
			case 2:
				//enregistrer ressource logiciel -> TACHERL
				$idressL = $_POST["ressL"];
				$res2 = mysqli_query($mysqli, "SELECT TXAFFECTATION FROM TACHERL WHERE RLID=".$idressL."");
				$sum_txaffect = 0;
				while($row = mysqli_fetch_assoc($res2)) {
						$sum_txaffect += $row["txaffectation"];
				}
				if(($sum_txaffect + $txaffect) <= 100){
					mysqli_query($mysqli, "INSERT INTO TACHERH(TID, RHID, txaffectation) VALUES(".$idtache.", '".$idressL."', '".$txaffect."')");
					header("location:ressourcelist.php");
				} else {
					$message = "La ressource est utilisee a plus de 100%";
				}
				break;
			case 3:
				//enregistrer ressource materiel -> TACHERM
				$idressM = $_POST["ressM"];
				$res3 = mysqli_query($mysqli, "SELECT TXAFFECTATION FROM TACHERM WHERE RMID=".$idressM."");
				$sum_txaffect = 0;
				while($row = mysqli_fetch_assoc($res2)) {
						$sum_txaffect += $row["txaffectation"];
				}
				if(($sum_txaffect + $txaffect) <= 100){
					mysqli_query($mysqli, "INSERT INTO TACHERH(TID, RHID, txaffectation) VALUES(".$idtache.", '".$idressM."', '".$txaffect."')");
					header("location:ressourcelist.php");
				} else {
					$message = "La ressource est utilise a plus de 100%";
				}
				break;
		}
	}
	else {
		$message = "casse noisette";
	}
}

$titre = "Affectation de ressources";
include("include/top.php");
?>
<!-- 
	Reutiliser le script pour sélectionner le type de ressource et afficher la liste déroulante
	de la ressource correspondante.
	
	Idem lors de la selection du projet -> n'afficher que les tâches concernant le projet
-->


<?php $mysqli = connect(); ?>
<h2>Ressource</h2>
<div id="error"><?php echo $message; ?></div>
<form method="post" action="affecteressource.php">
	<table>
		<tr>
			<td>
				<label for="type">Type de ressource : </label>
			</td>
			<td>
				<select name="type" id="type">
					<option value="0"></option>
					<option value="1">Personne</option>
					<option value="2">Logiciel</option>
					<option value="3">Materiel</option>
				</select>
			</td>
		</tr>
		<tr id="ressourceH"> <!-- Requete pour avoir une liste des ressources Humaines -->
			<td>
				<label for="ressH">Ressource Humaine: </label>
			</td>
			<td>
				<select name="ressH" id="ressH">
				<?php
					$res = mysqli_query($mysqli, "SELECT * FROM RESSOURCEH");
					while($row = mysqli_fetch_assoc($res)) {
						echo '<option value="'.$row["ID"].'">'.$row['INTITULE'].'</option>';
					}
				?>
				</select>
			</td>
		</tr>
		<tr id="ressourceL"> <!-- Requete pour avoir une liste des ressources Logiciel -->
			<td>
				<label for="ressL">Ressource Logiciel: </label>
			</td>
			<td>
				<select name="ressL" id="ressL">
				<?php
					$res = mysqli_query($mysqli, "SELECT * FROM RESSOURCEL");
					while($row = mysqli_fetch_assoc($res)) {
						echo '<option value="'.$row["ID"].'">'.$row['INTITULE'].'</option>';
					}
				?>
				</select>
			</td>
		</tr>
		<tr id="ressourceM"> <!-- Requete pour avoir une liste des ressources MAtérielles -->
			<td>
				<label for="ressM">Ressource Materiel: </label>
			</td>
			<td>
				<select name="ressM" id="ressM">
				<?php
					$res = mysqli_query($mysqli, "SELECT * FROM RESSOURCEM");
					while($row = mysqli_fetch_assoc($res)) {
						echo '<option value="'.$row["ID"].'">'.$row['INTITULE'].'</option>';
					}
				?>
				</select>
			</td>
		</tr>
		
		<tr id="projet"> <!-- Requete pour avoir une liste des projets -->
			<td>
				<label for="proj">Projet : </label>
			</td>
			<td>
				<select name="proj" id="proj">
				<?php
					echo '<option value="0"></option>';
					$res = mysqli_query($mysqli, "SELECT * FROM PROJET");
					while($row = mysqli_fetch_assoc($res)) {
						echo '<option value="'.$row["ID"].'">'.$row['INTITULE'].'</option>';
					}
				?>
				</select>
			</td>
		</tr>
		<tr id="tache">  <!-- Requete pour avoir une liste des tâches -->
			<td>
				<label for="task">Tache : </label>
			</td>
			<td>
				<select name="task" id="task">
				<?php
					//MANQUE LE PID
					//$res = mysqli_query($mysqli, "SELECT * FROM TACHE WHERE LID IN
						//								(SELECT ID FROM LOT WHERE SPID IN
							//								(SELECT ID FROM SOUSPROJET WHERE PID IN
								//								(SELECT ID FROM PROJET WHERE ID=".$pid.")))");
					//while($row = mysqli_fetch_assoc($res)) {
						//echo '<option value="'.$row["ID"].'">'.$row[OBJECTIF].'</option>';
					//}
				?>
			</td>
		</tr>
		<tr id="txaffectation">
			<td>
				<label for="txaffect">Taux d'affectation : </label>
			</td>
			<td>
				<input type="text" name="txaffect" />
			</td>
		</tr>
		<tr id="valider">
			<td>
				<input type="submit" name="ajouter" value="Ajouter"  class="button" />
			</td>
		</tr>
	</table>
</form>
<?php
include("include/bottom.php");
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#ressourceH").hide();
		$("#ressourceL").hide();
		$("#ressourceM").hide();
		$("#projet").hide();
		$("#tache").hide();
		$("#txaffectation").hide();
		$("#valider").hide();
	});
	
	$("#type").change(function(){
		if(parseInt(this.value)==1){
			$("#ressourceH").show("Highlight");
			$("#projet").show("Highlight");
			$("#ressourceL").hide();
			$("#ressourceM").hide();
		} else if(parseInt(this.value)==2){
			$("#ressourceL").show("Highlight");
			$("#projet").show("Highlight");
			$("#ressourceH").hide();
			$("#ressourceM").hide();
		} else if(parseInt(this.value)==3) {
			$("#ressourceM").show("Highlight");
			$("#projet").show("Highlight");
			$("#ressourceH").hide();
			$("#ressourceL").hide();
		} else {
			$("#ressourceH").hide();
			$("#projet").hide();
			$("#ressourceL").hide();
			$("#ressourceM").hide();
		}
	});
	
	$("#proj").change(function(){
		/*$("#tache").hide();
		$("#txaffectation").hide();
		var idProjet = parseInt(this.value);
		return idProjet;*/
		getTaches(this.value);
		$("#tache").show();
		$("#txaffectation").show();
		$("#valider").show();
	});
	
	function getTaches(str) {
		if (str=="") {
			document.getElementById("tache").innerHTML="";
			return;
		} 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("tache").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","gettacheajax.php?pid="+str,true);
		xmlhttp.send();
	}
</script>