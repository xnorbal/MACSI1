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
				mysqli_query($mysqli, "INSERT INTO RESSOURCEM(COUT, INTITULE) VALUES(".$cout.", '".$intitule."')");
				header("location:ressourcelist.php");
				break;
			case 2:
				mysqli_query($mysqli, "INSERT INTO RESSOURCEL(COUT, INTITULE) VALUES(".$cout.", '".$intitule."')");
				header("location:ressourcelist.php");
				break;
			case 3:
				if(empty($_POST['qualifications']))
				{
					$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
				}
				else
				{
					$req = "INSERT INTO RESSOURCEH(COUT, INTITULE, QUALIFICATIONS) VALUES(".$cout.", '".$intitule."', '".$qualifications."')";
					echo $req;
					mysqli_query($mysqli, $req);
					header("location:ressourcelist.php");
				}
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
<h2>Ressource</h2>
<div id="error"><?php echo $message; ?></div>
<form method="post" action="addressource.php">
	<table>
		<tr>
			<td>
				<label for="type">Type : </label>
			</td>
			<td>
				<select name="type" id="type">
					<option value="1">Matériel</option>
					<option value="2">Logiciel</option>
					<option value="3">Personne</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="intitule">Intitulé : </label>
			</td>
			<td>
				<input type="text" name="intitule" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="cout">Coût : </label>
			</td>
			<td>
				<input type="text" name="cout" />
			</td>
		</tr>
		<tr id="qualif">
			<td>
				<label for="qualifications">Qualifications : </label>
			</td>
			<td>
				<input type="text" name="qualifications"/>
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
		$("#qualif").hide();
	});
	
	$("#type").change(function(){
		if(parseInt(this.value)==3){
			$("#qualif").show("Highlight");
		}
		else
		{
			$("#qualif").hide("Highlight");
		}
	});
</script>
