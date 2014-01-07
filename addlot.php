<?php
include("include/fonctions.php");
$titre = "Ajout de sous projet";
include("include/top.php");


if(!empty($_GET["spid"])){

$mysqli = connect();

?>
<h2>Lot</h2>
<form method="post" action="createslot.php">
<!-- Fonction qui recupere la liste id avec nom des sous projets/phases--> 
<?php
$req1 = mysqli_query($mysqli, "SELECT * FROM SOUSPROJET WHERE ID=".$_GET["spid"]);
$row1 = mysqli_fetch_assoc($req1);
echo 'SOUS PROJET : '.$row1["INTITULE"];
echo '<br/>';
 //Manque encore le listing pour choisir la phase
?>
<label for="perimetre">Périmètre :</label>
<textarea name="perimetre">
</textarea>
<br />
<input type="submit" value="Ajouter"/>
</form>
<?php
} else if(!empty($_GET["phid"])){

	//Faire la meme chose mais venant de la phase

} else {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}
?>

<?php
include("include/bottom.php");
?>

