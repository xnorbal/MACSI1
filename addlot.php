<?php
include("include/fonctions.php");
$titre = "Ajout de lot";
include("include/top.php");

$mysqli = connect();

if(!empty($_GET["spid"])){

	echo '<h2>Lot</h2>';
	$req1 = mysqli_query($mysqli, "SELECT intitule, pid FROM SOUSPROJET WHERE ID=".$_GET["spid"]);
	$row1 = mysqli_fetch_assoc($req1);
	echo "SOUS PROJET : ".$row1["intitule"];
	echo '<br/>';
	$pid = $row1["pid"];
	$req2 = mysqli_query($mysqli, "SELECT id,intitule FROM PHASE WHERE pid=".$pid);
	?>
	<form method="post" action="addlot.php">
		<?php
			echo '<input type="hidden" name="spid" value="'.$_GET["spid"].'"/>';
		?>
		<label for="phid">Choix de la phase :</label>
		<select name="phid">
			<?php
			while($dataphase = mysqli_fetch_assoc($req2)){
				echo '<option value="'.$dataphase["id"].'">'.$dataphase["intitule"].'</option>';
			}
			?>
		</select>
		<br />
		<label for="perimetre">Périmètre :</label>
		<textarea name="perimetre">
		</textarea>
		<br />
		<input type="submit" value="Ajouter" name="fromsproj"  class="button" />
	</form>
	<?php
} else if(!empty($_GET["phid"])){
	
	echo '<h2>Lot</h2>';
	$req1 = mysqli_query($mysqli, "SELECT INTITULE, PID FROM PHASE WHERE ID=".$_GET["phid"]);
	$row1 = mysqli_fetch_assoc($req1);
	$pid = $row1["PID"];
	echo 'PHASE : '.$row1["INTITULE"];
	echo '<br/>';
	$req2 = mysqli_query($mysqli, "SELECT id,intitule FROM SOUSPROJET WHERE pid=".$pid);
	?>
	<form method="post" action="addlot.php">
		<?php
			echo '<input type="hidden" name="phid" value="'.$_GET["phid"].'"/>';
		?>
		<label for="spid">Choix du sous projet :</label>
		<select name="spid">
			<?php
			while($datasousproj = mysqli_fetch_assoc($req2)){
				echo '<option value="'.$datasousproj["id"].'">'.$datasousproj["intitule"].'</option>';
			}
			?>
		</select>
		<br />
		<label for="perimetre">Périmètre :</label>
		<textarea name="perimetre">
		</textarea>
		<br />
		<input type="submit" value="Ajouter" name="fromphase"  class="button" />
	</form>
<?php

} else if(!empty($_POST["fromsproj"]) && !empty($_POST["perimetre"]) && !empty($_POST["phid"])){
	
	//insertion dans la BD
	$reqi1 = "INSERT INTO lot (SPID,PHID,PERIMETRE) VALUES('".$_POST["spid"]."','".$_POST["phid"]."','".$_POST["perimetre"]."')";
	mysqli_query($mysqli, $reqi1);
	header("Location:sousprojetdetails.php?spid=".$_POST["spid"]);
	
} else if(!empty($_POST["fromphase"]) && !empty($_POST["perimetre"]) && !empty($_POST["spid"])){
	
	//insertion dans la BD
	$reqi2 = "INSERT INTO lot (SPID,PHID,PERIMETRE) VALUES('".$_POST["spid"]."','".$_POST["phid"]."','".$_POST["perimetre"]."')";
	mysqli_query($mysqli, $reqi2);
	header("Location:phasedetails.php?phid=".$_POST["phid"]);
} 
else
{
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

include("include/bottom.php");
?>