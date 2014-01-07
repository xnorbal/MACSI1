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
$message = '';
if(!empty($_POST['ajouter'])) {
	if(!empty($_POST['intitule']) && !empty($_POST['perimetre'])) {
		$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
		$perimetre = mysqli_real_escape_string($mysqli, $_POST['perimetre']);
		$res = mysqli_query($mysqli, "INSERT INTO SOUSPROJET(PID, INTITULE, PERIMETRE) VALUES(".$pid.", '".$intitule."', '".$perimetre."')");
		header("location:sprojectlist.php?pid=".$pid);
	}
	else {
		$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
	}
}

?>
<h2>Sous projet</h2>
<div><?php echo $message; ?></div>
<form method="post" action="addsproject.php?pid=<?php echo $pid; ?>">
<?php
echo '<input type="hidden" name="pid" value="'.$_GET['pid'].'"/>';
?>
<label for="intitule">Intitulé :</label>
<input name="intitule" value="" /><br/>
<label for="perimetre">Périmètre :</label>
<textarea name="perimetre">
</textarea>
<br />
<input type="submit" value="Ajouter" name="ajouter"/>
</form>
<?php
include("include/bottom.php");
?>