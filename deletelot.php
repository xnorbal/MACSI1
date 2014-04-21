<?php
include("include/fonctions.php");

if(empty($_GET['lid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$lid = mysqli_real_escape_string($mysqli, $_GET['lid']);
$req = mysqli_query($mysqli, "SELECT * FROM LOT WHERE ID=".$lid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$spid = stripslashes($row['SPID']);
$phid = stripslashes($row['PhID']);

$res = mysqli_query($mysqli, "DELETE FROM LOT WHERE ID=".$lid);

if($_GET['from'] == 'sprojet') {
	header("location:sousprojetdetails.php?spid=".$spid);
}
else {
	header("location:phasedetails.php?phid=".$phid);
}
?>