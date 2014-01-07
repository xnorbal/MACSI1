<?php
include("include/fonctions.php");
$titre = "Details de la phase";
include("include/top.php");

if(empty($_GET['phid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$pid = mysql_real_escape_string($_GET['phid']);
$mysqli = connect();
$req = mysqli_query($mysqli, "SELECT * FROM PROJET WHERE ID=".$pid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$res2 = mysqli_query($mysqli, "SELECT * FROM PHASE WHERE PID=".$_GET["pid"]);
$row = mysqli_fetch_assoc($res2);
$intitule =  stripslashes($row['INTITULE']);
echo "<h2>PHASE : ".$intitule."</h2>";

//AFFICHAGE DES LOTS de la PHASE


$res3 = mysqli_query($mysqli, "SELECT * FROM LOT WHERE PhPID=".$row["ID"]);
echo '<table>';
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
while($row1 = mysqli_fetch_assoc($res3))
{
	$id =  stripslashes($row1['ID']);
	$spid = stripslashes($row1['SPID']);
	$phpid = stripslashes($row1['PhPID']);
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
	echo '</tr>';
}
echo '</table>';
echo '<a href="addlot.php?phid='.$_GET['pid'].'">ajouter un lot</a>';





include("include/bottom.php");
?>
