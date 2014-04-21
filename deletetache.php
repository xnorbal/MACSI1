<?php
include("include/fonctions.php");

if(empty($_GET['tid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$tid = mysqli_real_escape_string($mysqli, $_GET['tid']);
$req = mysqli_query($mysqli, "SELECT * FROM TACHE WHERE ID=".$tid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$lid = stripslashes($row['LID']);

$res = mysqli_query($mysqli, "DELETE FROM TACHE WHERE ID=".$tid);

header("location:lotsdetails.php?lid=".$lid);
?>