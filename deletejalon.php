<?php
include("include/fonctions.php");

if(empty($_GET['jalonid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$jalonid = mysqli_real_escape_string($mysqli, $_GET['jalonid']);
$req = mysqli_query($mysqli, "SELECT * FROM JALON WHERE ID=".$jalonid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$pid = stripslashes($row['PID']);

$res = mysqli_query($mysqli, "DELETE FROM JALON WHERE ID=".$jalonid);
header("location:projectdetails.php?pid=".$pid);
?>