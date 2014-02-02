<?php
include("include/fonctions.php");
$titre = "Details du projet";
include("include/top.php");

if(empty($_GET['pid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$pid = mysqli_real_escape_string($mysqli, $_GET['pid']);
$req = mysqli_query($mysqli, "SELECT * FROM PROJET WHERE ID=".$pid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$res2 = mysqli_query($mysqli, "SELECT * FROM PROJET WHERE ID=".$pid);
$row1 = mysqli_fetch_assoc($res2);
$intitule =  stripslashes($row1['INTITULE']);
echo "<h2>PROJET : ".$intitule."</h2>";

//AFFICHAGE DES SOUS PROJETS

echo '<h3>Sous projets</h3>';

$res1 = mysqli_query($mysqli, "SELECT * FROM SOUSPROJET WHERE PID=".$pid);
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
while($row = mysqli_fetch_assoc($res1))
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
	echo '<a href="sousprojetdetails.php?spid='.$id.'">détails</a>';
	echo '</td>';
	echo '<td>';
	echo '<a href="modifysproject.php?spid='.$id.'" class="modifier"></a>';
	echo '<a href="deletesproject.php?spid='.$id.'" class="supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\');"></a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
echo '<a href="addsproject.php?pid='.$_GET['pid'].'">ajouter un sous projet</a>';
echo '<br/><br/>';

//AFFICHAGE DES PHASES

echo '<h3>Phases</h3>';

$res3 = mysqli_query($mysqli, "SELECT * FROM PHASE WHERE PID=".$_GET["pid"]);
echo '<table class="table">';
echo '<th>';
echo 'INTITULE';
echo '</th>';
echo '<th>';
echo 'DETAILS';
echo '</th>';
echo '<th>';
echo 'ACTIONS';
echo '</th>';
while($row = mysqli_fetch_assoc($res3))
{
	$id =  stripslashes($row['ID']);
	$intitule =  stripslashes($row['INTITULE']);

	echo '<tr>';
	echo '<td>';
	echo ($intitule);
	echo '</td>';
	echo '<td>';
	echo '<a href="phasedetails.php?phid='.$id.'">détails</a>';
	echo '</td>';
	echo '<td>';
	echo '<a href="modifyphase.php?phaseid='.$id.'" class="modifier"></a>';
	echo '<a href="deletephase.php?phaseid='.$id.'" class="supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\');"></a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
echo '<a href="addphase.php?pid='.$_GET['pid'].'">ajouter une phase</a>';

//AFFICHAGE DES JALONS

echo '<h3>JALONS</h3>';

$res3 = mysqli_query($mysqli, "SELECT * FROM JALON WHERE PID=".$_GET["pid"]);
echo '<table class="table">';
echo '<th>';
echo 'INTITULE';
echo '</th>';
echo '<th>';
echo 'DATE';
echo '</th>';
echo '<th>';
echo 'ACTIONS';
echo '</th>';
while($row = mysqli_fetch_assoc($res3))
{
	$jalonid =  stripslashes($row['ID']);
	$intitule =  stripslashes($row['INTITULE']);
	$date =  stripslashes($row['SYNCPOINT']);
	
	echo '<tr>';
	echo '<td>';
	echo ($intitule);
	echo '</td>';
	echo '<td>';
	echo (formatSQLToFr($date));
	echo '</td>';
	echo '<td>';
	echo '<a href="modifyjalon.php?jalonid='.$jalonid.'" class="modifier"></a>';
	echo '<a href="deletejalon.php?jalonid='.$jalonid.'" class="supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer?\');"></a>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
echo '<a href="addjalon.php?pid='.$_GET['pid'].'">ajouter un jalon</a>';

include("include/bottom.php");
?>