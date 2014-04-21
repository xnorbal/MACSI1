<?php
include("include/fonctions.php");
$titre = "Details de la phase";
include("include/top.php");

if(empty($_GET['phid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$phid = mysqli_real_escape_string($mysqli, $_GET['phid']);
$res = mysqli_query($mysqli, "SELECT * FROM PHASE WHERE ID=".$phid);

if(mysqli_num_rows($res) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($res);
$intitule =  stripslashes($row['INTITULE']);
echo "<h2>PHASE : ".$intitule."</h2>";

//AFFICHAGE DES LOTS de la PHASE


$res3 = mysqli_query($mysqli, "SELECT ID,SPID,PHID,PERIMETRE FROM LOT WHERE PHID=".$phid);

echo '<h3>Lots</h3>';
echo '<table class="table">';
echo '<tr>';
echo '<th>';
echo 'ID';
echo '</th>';
echo '<th>';
echo 'SPID';
echo '</th>';
echo '<th>';
echo 'PHID';
echo '</th>';
echo '<th>';
echo 'PERIMETRE';
echo '</th>';
echo '<th>';
echo 'ACTIONS';
echo '</th>';
echo '</tr>';

while($row1 = mysqli_fetch_assoc($res3))
{
	$id =  stripslashes($row1['ID']);
	$spid = stripslashes($row1['SPID']);
	$phpid = stripslashes($row1['PHID']);
	$perimetre =  stripslashes($row1['PERIMETRE']);

	echo '<tr>';
	echo '<td>';
	echo ($id);
	echo '</td>';
	echo '<td>';
	echo ($spid);
	echo '</td>';
	echo '<td>';
	echo ($phpid);
	echo '</td>';
	echo '<td>';
	echo ($perimetre);
	echo '</td>';
	echo '<td>';
	echo '<a href="modifylot.php?phid='.$_GET['phid'].'&lid='.$id.'" class="modifier"></a>';
	echo '<a href="deletelot.php?from=phase&lid='.$id.'" class="supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\');"></a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
echo '<a href="addlot.php?phid='.$_GET['phid'].'" class="button">ajouter un lot</a>';





include("include/bottom.php");
?>
