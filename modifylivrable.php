<?php
	if(empty($_GET['livrableid'])) 
	{
		header("HTTP/1.0 404 Not Found");
		header("Location: error404.php");
	}
	
	$message = '';
	
	include("include/fonctions.php");
	$mysqli = connect();
	$livrableid = mysqli_real_escape_string($mysqli, $_GET['livrableid']);
	$req = mysqli_query($mysqli, "SELECT * FROM LIVRABLE WHERE ID=".$livrableid);

	if(mysqli_num_rows($req) <= 0) {
		header("HTTP/1.0 404 Not Found");
		header("Location: error404.php");
	}
	
	$tuple = mysqli_fetch_assoc($req);
	$intituleLivrable =  stripslashes($tuple['INTITULE']);
	$genreLivrable =  stripslashes($tuple['GENRE']);
	$fichierLivrable =  stripslashes($tuple['FICHIER']);
	$lid =  stripslashes($tuple['LID']);
	
	if(!empty($_POST['modifier'])) {
		if(!empty($_POST['intitule']) && !empty($_POST['genre'])) {
			$intitule = mysqli_real_escape_string($mysqli, $_POST['intitule']);
			$genre = mysqli_real_escape_string($mysqli, $_POST['genre']);
			
			$ok = false;
			
			if(!empty($_FILES['doc']['name'])) {
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
						
						$ok = copy($fichier_temporaire, $destination);
						
						
						if($ok) {
							unlink($fichierLivrable);
						}
					}
				}
			}
			else {
				$ok = true;
			}
			if($ok) {
				if(!empty($_FILES['doc']['name'])) {
					$res = mysqli_query($mysqli, "UPDATE LIVRABLE SET INTITULE = '".$intitule."', GENRE = '".$genre."', FICHIER = '".$destination."' WHERE ID =".$livrableid);
				}
				else {
					$res = mysqli_query($mysqli, "UPDATE LIVRABLE SET INTITULE = '".$intitule."', GENRE = '".$genre."' WHERE ID =".$livrableid);
				}
				header("location:lotsdetails.php?lid=".$lid);
			}
			else {
				$message = "Problème interne: Copie impossible";
			}
		}
		else {
			$message = "Vous n'avez pas renseigné tous les champs du formulaire.";
		}
	}
	
	$titre = "Modifier le livrable ".$intituleLivrable;
	include("include/top.php");
?>
	<h2>Modifier le livrable "<?php echo $intituleLivrable; ?>"</h2>
	<?php echo $message; ?>
	<form method="post" action="modifylivrable.php?livrableid=<?php echo $livrableid; ?>" enctype="multipart/form-data">
	
	<table>
		<tr>
			<td><label for="intitule">Intitulé :</label></td>
			<td><input type="text" name="intitule" value="<?php echo $intituleLivrable; ?>" /></td>
		</tr>
		<tr>
			<td><label for="genre">Genre :</label></td>
			<td><input type="text" name="genre" value="<?php echo $genreLivrable; ?>" /></td>
		</tr>
		<tr>
			<td><label for="doc">Document :</label></td>
			<td><input type="file" name="doc" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="modifier" value="Modifier"  class="button" /></td>
		</tr>
	</table>
	</form>

<?php

	include("include/bottom.php");
?>