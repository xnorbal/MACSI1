<?php
	if(empty($_GET['lid'])) 
	{
		header("HTTP/1.0 404 Not Found");
		header("Location: error404.php");
	}
	
	include("include/fonctions.php");
	$mysqli = connect();
	$lid = mysqli_real_escape_string($mysqli, $_GET['lid']);
	$req = mysqli_query($mysqli, "SELECT * FROM LOT WHERE ID=".$lid);

	if(mysqli_num_rows($req) <= 0) {
		header("HTTP/1.0 404 Not Found");
		header("Location: error404.php");
	}
	
	if(!empty($_POST['ajouter'])) {
		if(!empty($_POST['intitule']) && !empty($_POST['genre'])) {
			$lid = mysqli_real_escape_string($mysqli, $_POST['lid']);
			$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
			$genre = mysqli_real_escape_string($mysqli, $_POST['genre']);
			$res = mysqli_query($mysqli, "INSERT INTO LIVRABLE(LID, INTITULE,GENRE ) VALUES(".$lid.", '".$intitule."', '".$genre."')");
			header("location:lotsdetails.php?lid=".$_POST['lid']);
		}
		else {
			$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
		}
	}
	
	$titre = "Nouveau livrable";
	include("include/top.php");
?>	
	<h2>Livrables</h2>
	<form method="post" action="createlivrable.php?lid=<?php echo $lid; ?>">
	
	<label for="intitule">Intitulé :</label>
	<input type="text" name="intitule"/>
	
	<label for="genre">Genre :</label>
	<input type="text" name="genre"/>
	
	<input type="submit" name="ajouter" value="Ajouter"  class="button" />
	<?php echo '<input type="hidden" name="lid" value="'.$_GET['lid'].'"/>';?>
	</form>

<?php

	include("include/bottom.php");
?>