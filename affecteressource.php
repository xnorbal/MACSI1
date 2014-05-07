<?php
include("include/fonctions.php");
$message ='';
if(!empty($_POST['ajouter'])) {
	if(!empty($_POST['intitule']) && !empty($_POST['cout'])) {
		$mysqli = connect();
		$type=$_POST['type'];
		$intitule=$_POST['intitule'];
		$cout=$_POST['cout'];
		$qualifications=$_POST['qualifications'];
		switch($_POST["type"])
		{
			case 1:
				
				break;
			case 2:
				
				break;
			case 3:
				
				break;
		}
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

$titre = "Ajout de ressources";
include("include/top.php");
?>
<!-- //Affichage dans menu déroulant
	echo '<tr><td>Dossier:</td>';
	echo '<td><select name="dossier">';
	while($cpt >= 0){
		echo '<option value="'.$contenu_galeries[$cpt].'">'.$contenu_galeries[$cpt].'</option>';
		$cpt = $cpt - 1;
	}
	echo '</select></td></tr>';
	
	
	Reutiliser le script pour sélectionner le type de ressource et afficher la liste déroulante
	de la ressource correspondante.
	
	Idem lors de la selection du projet -> n'afficher que les tâches concernant le projet
-->


<?php $mysqli = connect(); ?>
<h2>Ressource</h2>
<div id="error"><?php echo $message; ?></div>
<form method="post" action="addressource.php">
	<table>
		<tr>
			<td>
				<label for="type">Type de ressource : </label>
			</td>
			<td>
				<select name="type" id="type">
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
						echo '<option value="'.$row["id"].'">'.$row[INTITULE].'</option>';
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
						echo '<option value="'.$row["id"].'">'.$row[INTITULE].'</option>';
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
						echo '<option value="'.$row["id"].'">'.$row[INTITULE].'</option>';
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
					<option value="1">Materiel</option>
					<option value="2">Logiciel</option>
					<option value="3">Personne</option>
				</select>
			</td>
		</tr>
		<tr id="tache">  <!-- Requete pour avoir une liste des tâches -->
			<td>
				<label for="task">Tache : </label>
			</td>
			<td>
				<select name="task" id="task">
					<option value="1">Materiel</option>
					<option value="2">Logiciel</option>
					<option value="3">Personne</option>
				</select>
			</td>
		</tr>
		<tr id="txaffectation">
			<td>
				<label for="txaffect">Taux d'affectation : </label>
			</td>
			<td>
				<!-- Mettre un simple type input / vérifier taux < 100 -->
			</td>
		</tr>
		<tr>
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
	});
	
	$("#type").change(function(){
		if(parseInt(this.value)==1){
			$("#ressourceH").show("Highlight");
		} else if(parseInt(this.value==2){
			$("#ressourceL").show("Highlight");
		} else if(parseInt(this.value==3)) {
			$("#ressourceM").show("Highlight");
		} else {
			$("#ressourceH").hide();
			$("#ressourceL").hide();
			$("#ressourceM").hide();
		}
	});
</script>