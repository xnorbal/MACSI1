<?php
include("include/fonctions.php");
$titre = "Projets";
include("include/top.php");
?>
<h2>Projets</h2>
<?php
$mysqli = connect();
$res = mysqli_query($mysqli, "SELECT * FROM PROJET");
echo '<table class="table">';
echo '<th>';
echo 'INTITULE';
echo '</th>';
echo '<th>';
echo 'PERIMETRE';
echo '</th>';
echo '<th>';
echo 'DETAILS';
echo '</th>';
echo '<th>';
echo 'ACTIONS';
echo '</th>';
while($row = mysqli_fetch_assoc($res))
{
	$id =  stripslashes($row['ID']);
	$intitule =  stripslashes($row['INTITULE']);
	$perimetre =  stripslashes($row['PERIMETRE']);
	echo '<tr>';
	echo '<td>';
	echo ($intitule);
	echo '</td>';
	echo '<td>';
	echo ($perimetre);
	echo '</td>';
	echo '<td>';
	echo '<a href="projectdetails.php?pid='.$id.'">détails</a>';
	echo '</td>';
	echo '<td>';
	echo '<a href="modifyproject.php?pid='.$id.'" class="modifier"></a>';
	echo '<a href="deleteproject.php?pid='.$id.'" class="supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\');"></a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
echo '<a href="addproject.php" class="button">ajouter un projet</a>';
include("include/bottom.php");
?>