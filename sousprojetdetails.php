<?php
include("include/fonctions.php");
$titre = "Details du sous projet";
include("include/top.php");

if(empty($_GET['spid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$spid = mysqli_real_escape_string($mysqli, $_GET['spid']);
$res1 = mysqli_query($mysqli, "SELECT ID,PID,INTITULE,PERIMETRE FROM SOUSPROJET WHERE PID=".$spid);

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
echo '<tr>';
echo '<th>';
echo 'ID';
echo '</th>';
echo '<th>';
echo 'SPID';
echo '</th>';
echo '<th>';
echo 'PhID';
echo '</th>';
echo '<th>';
echo 'PERIMETRE';
echo '</th>';
echo '<th>';
echo '</th>';
echo '</tr>';
while($row2 = mysqli_fetch_assoc($res2))
{
	$id =  stripslashes($row2['ID']);
	$spid = stripslashes($row2['SPID']);
	$phid = stripslashes($row2["PhID"]);
	$perimetre =  stripslashes($row2['PERIMETRE']);

	echo '<tr>';
	echo '<td>';
	echo ($id);
	echo '</td>';
	echo '<td>';
	echo ($spid);
	echo '</td>';
	echo '<td>';
	echo ($phid);
	echo '</td>';
	echo '<td>';
	echo ($perimetre);
	echo '</td>';
	echo '<td>';
	echo '<a href="lotsdetails.php?lid='.$id.'">détails</a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
echo '<a href="addlot.php?spid='.$row1["ID"].'">ajouter un lot</a>';

include("include/bottom.php");
?>
