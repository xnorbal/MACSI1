<?php
include("include/fonctions.php");
$titre = "Details du sous projet";
include("include/top.php");

if(empty($_GET['spid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$spid = mysql_real_escape_string($_GET['spid']);
$mysqli = connect();
$res1 = mysqli_query($mysqli, "SELECT * FROM SOUSPROJET WHERE PID=".$spid);

if(mysqli_num_rows($res1) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row1 = mysqli_fetch_assoc($res1);
$intitule =  stripslashes($row1['INTITULE']);
echo "<h2>SOUS PROJET : ".$intitule."</h2>";

//AFFICHAGE DES LOTS du SOUS PROJET


$res2 = mysqli_query($mysqli, "SELECT * FROM LOT WHERE SPID=".$row1["ID"]);
echo '<table class="table">';
echo '<th>';
echo 'ID';
echo '</th>';
echo '<th>';
echo 'SPID';
echo '</th>';
echo '<th>';
echo 'PhPID';
echo '</th>';
echo '<th>';
echo 'PERIMETRE';
echo '</th>';
while($row2 = mysqli_fetch_assoc($res2))
{
	$id =  stripslashes($row2['ID']);
	$spid = stripslashes($row2['SPID']);
	$phpid = stripslashes($row2['PhPID']);
	$perimetre =  stripslashes($row2['PERIMETRE']);

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
	echo '</tr>';
}
echo '</table>';
echo '<a href="addlot.php?spid='.$row1["ID"].'">ajouter un lot</a>';

include("include/bottom.php");
?>
