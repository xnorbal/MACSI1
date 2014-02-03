<?php
include("include/fonctions.php");
$titre = "Projets";
include("include/top.php");
?>
<h2>Ressources</h2>
<?php
$mysqli = connect();
$res = mysqli_query($mysqli, "SELECT * FROM RESSOURCEH");
echo '<h3>Personnel</h3>';
echo '<table class="table">';
echo '<th>';
echo 'INTITULE';
echo '</th>';
echo '<th>';
echo 'COUT';
echo '</th>';
echo '<th>';
echo 'QUALIFICATIONS';
echo '</th>';
echo '<th>';
echo 'ACTIONS';
echo '</th>';
while($row = mysqli_fetch_assoc($res))
{
	$id =  stripslashes($row['ID']);
	$intitule =  stripslashes($row['INTITULE']);
	$perimetre =  stripslashes($row['COUT']);
	$qualifications =  stripslashes($row['QUALIFICATIONS']);
	echo '<tr>';
	echo '<td>';
	echo ($intitule);
	echo '</td>';
	echo '<td>';
	echo ($perimetre);
	echo '</td>';
	echo '<td>';
	echo ($qualifications);
	echo '</td>';
	echo '<td>';
	echo '<a href="modifyressource.php?type=humaine&rid='.$id.'" class="modifier"></a>';
	echo '<a href="deleteressource.php?type=humaine&rid='.$id.'" class="supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\');"></a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';

$res = mysqli_query($mysqli, "SELECT * FROM RESSOURCEL");
echo '<h3>Logiciel</h3>';
echo '<table class="table">';
echo '<th>';
echo 'INTITULE';
echo '</th>';
echo '<th>';
echo 'COUT';
echo '</th>';
echo '<th>';
echo 'ACTIONS';
echo '</th>';
while($row = mysqli_fetch_assoc($res))
{
	$id =  stripslashes($row['ID']);
	$intitule =  stripslashes($row['INTITULE']);
	$perimetre =  stripslashes($row['COUT']);
	echo '<tr>';
	echo '<td>';
	echo ($intitule);
	echo '</td>';
	echo '<td>';
	echo ($perimetre);
	echo '</td>';
	echo '<td>';
	echo '<a href="modifyressource.php?type=logiciel&rid='.$id.'" class="modifier"></a>';
	echo '<a href="deleteressource.php?type=logiciel&rid='.$id.'" class="supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\');"></a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';

$res = mysqli_query($mysqli, "SELECT * FROM RESSOURCEM");
echo '<h3>Materiel</h3>';
echo '<table class="table">';
echo '<th>';
echo 'INTITULE';
echo '</th>';
echo '<th>';
echo 'COUT';
echo '</th>';
echo '<th>';
echo 'ACTIONS';
echo '</th>';
while($row = mysqli_fetch_assoc($res))
{
	$id =  stripslashes($row['ID']);
	$intitule =  stripslashes($row['INTITULE']);
	$perimetre =  stripslashes($row['COUT']);
	echo '<tr>';
	echo '<td>';
	echo ($intitule);
	echo '</td>';
	echo '<td>';
	echo ($perimetre);
	echo '</td>';
	echo '<td>';
	echo '<a href="modifyressource.php?type=materiel&rid='.$id.'" class="modifier"></a>';
	echo '<a href="deleteressource.php?type=materiel&rid='.$id.'" class="supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\');"></a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';

echo '<a href="addressource.php"  class="button">ajouter une ressource</a>';
include("include/bottom.php");
?>