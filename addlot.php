<?php
include("include/fonctions.php");
$titre = "Ajout de sous projet";
include("include/top.php");


/*############################

Faire la liste des phase quand on est dans partit du sous projet
Faire la liste des sous projets quand on est partit de la phase

###############################*/

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

	echo '<h2>Lot</h2>';
	$req1 = mysqli_query($mysqli, "SELECT pid,intitule FROM PHASE WHERE ID=".$_GET["phid"]);
	$row1 = mysqli_fetch_assoc($req1);
	echo 'PHASE : '.$row1["intitule"];
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

if(!empty($_POST["fromsproj"]) && !empty($_POST["perimetre"])){
	
//} else if(){


} //else





include("include/bottom.php");
?>

