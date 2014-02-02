<?php
include("include/fonctions.php");

if(empty($_GET['spid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$spid = mysqli_real_escape_string($mysqli, $_GET['spid']);
$req = mysqli_query($mysqli, "SELECT * FROM SOUSPROJET WHERE ID=".$spid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$pid = stripslashes($row['PID']);

$res = mysqli_query($mysqli, "DELETE FROM SOUSPROJET WHERE ID=".$spid);
header("location:projectdetails.php?pid=".$pid);
?>