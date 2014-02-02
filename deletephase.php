<?php
include("include/fonctions.php");

if(empty($_GET['phaseid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$phaseid = mysqli_real_escape_string($mysqli, $_GET['phaseid']);
$req = mysqli_query($mysqli, "SELECT * FROM PHASE WHERE ID=".$phaseid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$pid = stripslashes($row['PID']);

$res = mysqli_query($mysqli, "DELETE FROM PHASE WHERE ID=".$phaseid);
header("location:projectdetails.php?pid=".$pid);
?>