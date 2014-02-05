<?php
	if(empty($_GET['lid'])) 
	{
		header("HTTP/1.0 404 Not Found");
		header("Location: error404.php");
	}
	
	$message = '';
	
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
			
			if ($_FILES['doc']['error'] > 0) {
				$message = "Erreur lors du transfert";
			}
			else {
				$extension_upload = strtolower(  substr(  strrchr($_FILES['doc']['name'], '.')  ,1)  );
				
				if( $extension_upload == "php") {
					$message = "Vilain pirate!";
				}
				else {
					$fichier_temporaire= mysqli_real_escape_string($mysqli, $_FILES[doc]['tmp_name']);
					$destination="Livrable/"."livrable-".time().'.'.$extension_upload;
					
					if(copy($fichier_temporaire, $destination))
					{
						$res = mysqli_query($mysqli, "INSERT INTO LIVRABLE(LID, INTITULE, GENRE, FICHIER ) VALUES(".$lid.", '".$intitule."', '".$genre."', '".$destination."')");
						header("location:lotsdetails.php?lid=".$_POST['lid']);
					}
					else {
						$message = "Problème interne: Copie impossible";
					}
				}
			}
		}
		else {
			$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
		}
	}
	
	$titre = "Nouveau livrable";
	include("include/top.php");
?>	
	<h2>Livrables</h2>
	<?php echo $message; ?>
	<form method="post" action="createlivrable.php?lid=<?php echo $lid; ?>" enctype="multipart/form-data">
	
	<table>
		<tr>
			<td><label for="intitule">Intitulé :</label></td>
			<td><input type="text" name="intitule" /></td>
		</tr>
		<tr>
			<td><label for="genre">Genre :</label></td>
			<td><input type="text" name="genre" /></td>
		</tr>
		<tr>
			<td><label for="doc">Document :</label></td>
			<td><input type="file" name="doc" /></td>
		</tr>
		<tr>
			<td colspan="2">
			<?php echo '<input type="hidden" name="lid" value="'.$_GET['lid'].'"/>';?>
			<input type="submit" name="ajouter" value="Ajouter"  class="button" />
			</td>
		</tr>
	</table>
	</form>

<?php

	include("include/bottom.php");
?>