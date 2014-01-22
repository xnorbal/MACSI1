<?php
include("include/fonctions.php");
$titre = "Ajout de sous projet";
include("include/top.php");
if(empty($_GET['pid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$pid = mysqli_real_escape_string($mysqli, $_GET['pid']);
$req = mysqli_query($mysqli, "SELECT * FROM PROJET WHERE ID=".$pid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

?>
<h2>Sous projet</h2>
<form method="post" action="createsproject.php">
<?php
echo '<input type="hidden" name="pid" value="'.$_GET['pid'].'"/>';
?>
<label for="perimetre">Périmètre :</label>
<textarea name="perimetre">
</textarea>
<br />
<input type="submit" value="Ajouter"/>
</form>
<?php
include("include/bottom.php");
?>