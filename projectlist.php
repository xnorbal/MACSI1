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
	echo '<tr>';
	echo '<td>';
	echo ($row['INTITULE']);
	echo '</td>';
	echo '<td>';
	echo ($row['PERIMETRE']);
	echo '</td>';
	echo '<td>';
	echo '<a href="sprojectlist.php?pid='.$row['ID'].'">détails</a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
echo '<a href="addproject.php">ajouter un projet</a>';
include("include/bottom.php");
?>