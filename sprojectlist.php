<?php
include("include/fonctions.php");
$titre = "Sous projets";
include("include/top.php");

if(empty($_GET['pid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$pid = mysql_real_escape_string($_GET['pid']);
$mysqli = connect();
$req = mysqli_query($mysqli, "SELECT * FROM PROJET WHERE ID=".$pid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$res2 = mysqli_query($mysqli, "SELECT * FROM PROJET WHERE ID=".$_GET["pid"]);
$row = mysqli_fetch_assoc($res2);
$intitule =  stripslashes($row['INTITULE']);
echo "<h2>PROJET :".$intitule."</h2>";

//AFFICHAGE DES SOUS PROJETS

$res1 = mysqli_query($mysqli, "SELECT * FROM SOUSPROJET WHERE PID=".$_GET["pid"]);
echo '<table>';
echo '<th>';
echo 'SPID';
echo '</th>';
echo '<th>';
echo 'INTITULE';
echo '</th>';
echo '<th>';
echo 'PERIMETRE';
echo '</th>';
while($row = mysqli_fetch_assoc($res1))
{
	$id =  stripslashes($row['ID']);
	$intitule =  stripslashes($row['INTITULE']);
	$perimetre =  stripslashes($row['PERIMETRE']);

	echo '<tr>';
	echo '<td>';
	echo ($id);
	echo '</td>';
	echo '<td>';
	echo ($intitule);
	echo '</td>';
	echo '<td>';
	echo ($perimetre);
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
echo '<a href="addsproject.php?pid='.$_GET['pid'].'">ajouter un sous projet</a>';
echo '<br/><br/>';
//AFFICHAGE DES PHASES

$res3 = mysqli_query($mysqli, "SELECT * FROM PHASE WHERE PID=".$_GET["pid"]);
echo '<table>';
echo '<th>';
echo 'PPID';
echo '</th>';
echo '<th>';
echo 'INTITULE';
echo '</th>';
while($row = mysqli_fetch_assoc($res3))
{
	$id =  stripslashes($row['ID']);
	$intitule =  stripslashes($row['INTITULE']);

	echo '<tr>';
	echo '<td>';
	echo ($id);
	echo '</td>';
	echo '<td>';
	echo ($intitule);
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
echo '<a href="addphase.php?pid='.$_GET['pid'].'">ajouter une phase</a>';


include("include/bottom.php");
?>