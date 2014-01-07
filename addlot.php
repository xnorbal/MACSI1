<?php
include("include/fonctions.php");
$titre = "Ajout de sous projet";
include("include/top.php");


if(!empty $_GET["spid"]){

$mysqli = connect();
$req = mysqli_query($mysqli, "SELECT * FROM PROJET WHERE ID=".$pid);

if(mysql_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}
?>
<h2>Lot</h2>
<form method="post" action="createslot.php">
<!-- Fonction qui recupere la liste id avec nom des sous projets/phases--> 





<label for="perimetre">Périmètre :</label>
<textarea name="perimetre">
</textarea>
<br />
<input type="submit" value="Ajouter"/>
</form>
<?php
} else if(!empty $_GET["phid"]){



} else {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}
?>

<?php
include("include/bottom.php");
?>

