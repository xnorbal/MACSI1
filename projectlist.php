<?php
include("include/fonctions.php");
$titre = "Projets";
include("include/top.php");
?>
<h2>Projets</h2>
<?php
$mysqli = connect();
$res = mysqli_query($mysqli, "SELECT * FROM PROJET");
echo '<table>';
echo '<th>';
echo 'INTITULE';
echo '</th>';
echo '<th>';
echo 'PERIMETRE';
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
	echo '<a href="sprojectlist.php?pid='.$id.'">détails</a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
echo '<a href="addproject.php">ajouter un projet</a>';
include("include/bottom.php");
?>