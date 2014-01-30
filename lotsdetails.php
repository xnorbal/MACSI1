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
		echo '</tr>';
		while($tuple = mysqli_fetch_assoc($res))
		{
			echo '<tr>';
			
			echo '<td>';
			echo $tuple['GENRE'];
			echo '</td>';
			echo '<td>';
			echo $tuple['INTITULE'];
			echo '</td>';
			
			echo '</tr>';
		}
		echo '</table>';
		echo '<a href="createlivrable.php?lid='.$_GET['lid'].'">créer un livrable</a>';
		
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
		echo '</tr>';
		while($tuple = mysqli_fetch_assoc($res))
		{
			echo '<tr>';
			
			echo '<td>';
			echo $tuple['OBJECTIF'];
			echo '</td>';
			echo '<td>';
			echo $tuple['DATEDEBUT'];
			echo '</td>';
			echo '<td>';
			echo $tuple['DATEFIN'];
			echo '</td>';
			echo '<td>';
			echo $tuple['JH_PREVU'];
			echo '</td>';
			echo '<td>';
			echo $tuple['JH_PRIS'];
			echo '</td>';
			
			echo '</tr>';
		}
		echo '</table>';
		echo '<a href="createtache.php">créer une tâche</a>';
	}
	include("include/bottom.php");
?>