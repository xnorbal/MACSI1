<?php
include("include/fonctions.php");
$message ='';

$types = array('humaine', 'logiciel', 'materiel');

if(empty($_GET['rid']) || empty($_GET['type']) || ! in_array($_GET['type'], $types)) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$ressourceid = mysqli_real_escape_string($mysqli, $_GET['rid']);
$type = mysqli_real_escape_string($mysqli, $_GET['type']);

if($type == "humaine") {
	$req = mysqli_query($mysqli, "SELECT * FROM RESSOURCEH WHERE ID=".$ressourceid);
}
elseif($type == "logiciel") {
	$req = mysqli_query($mysqli, "SELECT * FROM RESSOURCEL WHERE ID=".$ressourceid);
}
else {
	$req = mysqli_query($mysqli, "SELECT * FROM RESSOURCEM WHERE ID=".$ressourceid);
}

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$intituleRessource = stripslashes($row['INTITULE']);
$coutRessource = stripslashes($row['COUT']);
$qualificationsRessource = '';
if($type == "humaine") {
	$qualificationsRessource = stripslashes($row['QUALIFICATIONS']);
}


if(!empty($_POST['modifier'])) {
	if(!empty($_POST['intitule']) && !empty($_POST['cout'])) {
		$mysqli = connect();
		$intitule=$_POST['intitule'];
		$cout=$_POST['cout'];
		if($type == "humaine") {
			$qualifications=$_POST['qualifications'];
		}
		switch($type)
		{
			case "materiel":
				mysqli_query($mysqli, "UPDATE RESSOURCEM SET COUT = ".$cout.", INTITULE = '".$intitule."' WHERE ID = ".$ressourceid);
				header("location:ressourcelist.php");
				break;
			case "logiciel":
				mysqli_query($mysqli, "UPDATE RESSOURCEL SET COUT = ".$cout.", INTITULE = '".$intitule."' WHERE ID = ".$ressourceid);
				header("location:ressourcelist.php");
				break;
			case "humaine":
				if(!empty($_POST['qualifications']))
				{
					mysqli_query($mysqli, "UPDATE RESSOURCEH SET COUT = ".$cout.", INTITULE = '".$intitule."', QUALIFICATIONS = '".$qualifications."' WHERE ID = ".$ressourceid);
					header("location:ressourcelist.php");
				}
				else
				{
					$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
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
<form method="post" action="modifyressource.php?type=<?php echo $type; ?>&rid=<?php echo $ressourceid; ?>">
	<table>
		<tr>
			<td>
				<label for="type">Type : </label>
			</td>
			<td>
				<?php echo $type; ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="intitule">Intitulé : </label>
			</td>
			<td>
				<input type="text" name="intitule" value="<?php echo $intituleRessource; ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="intitule">Coût : </label>
			</td>
			<td>
				<input type="text" name="cout" value="<?php echo $coutRessource; ?>" />
			</td>
		</tr>
		<tr id="qualif">
			<td>
				<label for="qualifications">Qualifications : </label>
			</td>
			<td>
				<input type="text" name="qualifications" value="<?php echo $qualificationsRessource; ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="modifier" value="Modifier"  class="button" />
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
		if("<?php echo $type; ?>" == "humaine"){
			$("#qualif").show("Highlight");
		}
	});
	
	$("#type").change(function(){
		if(this.value == "humaine"){
			$("#qualif").show("Highlight");
		}
		else
		{
			$("#qualif").hide("Highlight");
		}
	});
</script>
