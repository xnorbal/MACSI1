<?php
include("include/fonctions.php");

if(!empty($_POST['ajouter'])) {
	if(!empty($_POST['intitule'])) {
		$mysqli = connect();
		$type=$_POST['type'];
		$intitule=$_POST['intitule'];
		$qualifications=$_POST['qualifications'];
		switch($_POST["type"])
		{
			case 1:
			
		}
		header("location:resourcelist.php");
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

$titre = "Ajout de ressources";
include("include/top.php");
?>
<h2>Ressource</h2>
<div><?php echo $message; ?></div>
<form method="post" action="addresource.php">
	<table>
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
				<input type="submit" name="ajouter" value="Ajouter"/>
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