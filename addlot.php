<?php
include("include/fonctions.php");
$titre = "Ajout de lot";
include("include/top.php");

if(!empty($_GET["spid"])){

	$mysqli = connect();

	echo '<h2>Lot</h2>';
	$req1 = mysqli_query($mysqli, "SELECT pid,intitule FROM SOUSPROJET WHERE ID=".$_GET["spid"]);
	$row1 = mysqli_fetch_assoc($req1);
	echo "SOUS PROJET : ".$row1["intitule"];
	echo '<br/>';
	$req2 = mysqli_query($mysqli, "SELECT pid,intitule FROM PHASE");
	?>
	<form method="post" action="addlot.php">
		<label for="phid">Choix de la phase :</label>
		<select name="phid">
			<?php
			while($dataphase = mysqli_fetch_assoc($req2)){
				echo '<option value="'.$dataphase["pid"].'">'.$dataphase["intitule"].'</option>';
			}
			?>
		</select>
		<br />
		<label for="perimetre">Perimetre :</label>
		<textarea name="perimetre">
		</textarea>
		<br />
		<input type="submit" value="Ajouter" name="fromsproj"/>
	</form>
	<?php
} else if(!empty($_GET["phid"])){

	$mysqli = connect();
	
	echo '<h2>Lot</h2>';
	$req1 = mysqli_query($mysqli, "SELECT PID,INTITULE FROM PHASE WHERE ID=".$_GET["phid"]);
	$row1 = mysqli_fetch_assoc($req1);
	echo 'PHASE : '.$row1["INTITULE"];
	echo '<br/>';
	$req2 = mysqli_query($mysqli, "SELECT pid,intitule FROM SOUSPROJET");
	?>
	<form method="post" action="addlot.php">
		<label for="spid">Choix du sous projet :</label>
		<select name="spid">
			<?php
			while($datasousproj = mysqli_fetch_assoc($req2)){
				echo '<option value="'.$datasousproj["pid"].'">'.$datasousproj["intitule"].'</option>';
			}
			?>
		</select>
		<br />
		<label for="perimetre">Perimetre :</label>
		<textarea name="perimetre">
		</textarea>
		<br />
		<input type="submit" value="Ajouter" name="fromphase"/>
	</form>
<?php

} else {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

//Traitement des formulaires

if(!empty($_POST["fromsproj"]) && !empty($_POST["perimetre"]) && !empty($_POST["phid"])){
	
	//insertion dans la BD
	$reqi1 = "INSERT INTO lot (SPID,PHID,PERIMETRE) VALUES('".$_GET["spid"]."','".$_POST["phid"]."','".$_POST["perimetre"]."')";
	mysqli_query($mysqli, $reqi1);
	
} else if(!empty($_POST["fromphase"]) && !empty($_POST["perimetre"]) && !empty($_POST["spid"])){
	
	//insetion dans la BD
	$reqi2 = "INSERT INTO lot (SPID,PHID,PERIMETRE) VALUES('".$_POST["spid"]."','".$_GET["phid"]."','".$_POST["perimetre"]."')";
	mysqli_query($mysqli, $reqi2);
	
}





include("include/bottom.php");
?>

