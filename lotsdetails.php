<?php
	include("include/fonctions.php");
	$titre = "Détails du lot";
	include("include/top.php");
	if(!empty($_GET['lid']))
	{
		$mysqli = connect();
	
		$res = mysqli_query($mysqli, "SELECT * FROM LOT WHERE ID=".$_GET['lid']);
		$row = mysqli_fetch_assoc($res);
		$intitule =  stripslashes($row['PERIMETRE']);
		echo "<h2>Lot : ".$intitule."</h2>";
		
		$req = "SELECT * FROM LIVRABLE WHERE LID=".$_GET['lid'];
		$res = mysqli_query($mysqli, $req);
		
		echo '<h3>Livrables</h3>';
		
		echo '<table class="table">';
		echo '<tr>';
		echo '<th>';
		echo 'GENRE';
		echo '</th>';
		echo '<th>';
		echo 'INTITULE';
		echo '</th>';
		echo '<th>';
		echo 'ACTIONS';
		echo '</th>';
		echo '</tr>';
		while($tuple = mysqli_fetch_assoc($res))
		{
			$id =  stripslashes($tuple['ID']);
			
			echo '<tr>';
			echo '<td>';
			echo stripslashes($tuple['GENRE']);
			echo '</td>';
			echo '<td>';
			echo stripslashes($tuple['INTITULE']);
			echo '</td>';
			echo '<td>';
			echo '<a href="modifylivrable.php?livrableid='.$id.'" class="modifier"></a>';
			echo '<a href="deletelivrable.php?livrableid='.$id.'" class="supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\');"></a>';
			echo '</td>';			
			echo '</tr>';
		}
		echo '</table>';
		echo '<a href="createlivrable.php?lid='.$_GET['lid'].'"  class="button" >Ajouter un livrable</a>';
		
		//Tâches
		
		$req = "SELECT * FROM TACHE WHERE LID=".$_GET['lid'];
		$res = mysqli_query($mysqli, $req);
		
		echo '<h3>Tâches</h3>';
		
		echo '<table class="table">';
		echo '<tr>';
		echo '<th>';
		echo 'OBJECTIF';
		echo '</th>';
		echo '<th>';
		echo 'DATE DEBUT';
		echo '</th>';
		echo '<th>';
		echo 'DATE FIN';
		echo '</th>';
		echo '<th>';
		echo 'JH PREVU';
		echo '</th>';
		echo '<th>';
		echo 'JH PRIS';
		echo '</th>';
		echo '<th>';
		echo 'ACTIONS';
		echo '</th>';
		echo '</tr>';
		while($tuple = mysqli_fetch_assoc($res))
		{
			echo '<tr>';
			
			echo '<td>';
			echo $tuple['OBJECTIF'];
			echo '</td>';
			echo '<td>';
			echo formatSQLToFr($tuple['DATEDEBUT']);
			echo '</td>';
			echo '<td>';
			echo formatSQLToFr($tuple['DATEFIN']);
			echo '</td>';
			echo '<td>';
			echo $tuple['JH_PREVU'];
			echo '</td>';
			echo '<td>';
			echo $tuple['JH_PRIS'];
			echo '</td>';
			echo '<td>';
			echo '<a href="modifytache.php?tid='.$tuple['ID'].'" class="modifier"></a>';
			echo '<a href="deletetache.php?tid='.$tuple['ID'].'" class="supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\');"></a>';
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '<a href="addtache.php?lid='.$_GET["lid"].'"  class="button" >Ajouter une tâche</a>';
	}
	include("include/bottom.php");
?>