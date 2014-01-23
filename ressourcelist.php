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
while($row = mysqli_fetch_assoc($res))
{
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
while($row = mysqli_fetch_assoc($res))
{
	$intitule =  stripslashes($row['INTITULE']);
	$perimetre =  stripslashes($row['COUT']);
	echo '<tr>';
	echo '<td>';
	echo ($intitule);
	echo '</td>';
	echo '<td>';
	echo ($perimetre);
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
while($row = mysqli_fetch_assoc($res))
{
	$intitule =  stripslashes($row['INTITULE']);
	$perimetre =  stripslashes($row['COUT']);
	echo '<tr>';
	echo '<td>';
	echo ($intitule);
	echo '</td>';
	echo '<td>';
	echo ($perimetre);
	echo '</td>';
	echo '</tr>';
}
echo '</table>';

echo '<a href="addressource.php">ajouter une ressource</a>';
include("include/bottom.php");
?>