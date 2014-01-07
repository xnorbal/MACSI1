<?php
include("include/fonctions.php");
$titre = "Details du projet";
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
echo "<h2>PROJET : ".$intitule."</h2>";

//AFFICHAGE DES LOTS du SOUS PROJET






include("include/bottom.php");
?>
