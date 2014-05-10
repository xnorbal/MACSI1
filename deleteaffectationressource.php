<?php
include("include/fonctions.php");

if(empty($_GET['tid']) && empty($_GET['type']) && empty($_GET['rtid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$tid = mysqli_real_escape_string($mysqli, $_GET['tid']);
$type = mysqli_real_escape_string($mysqli, $_GET['type']);
$rtid = mysqli_real_escape_string($mysqli, $_GET['rtid']);

switch($type) {
	case "M":
		$table = "tacherm";
		$attr = "RMID";
		break;
	case "L":
		$table = "tacherl";
		$attr = "RLID";
		break;
	case "H":
		$table = "tacherh";
		$attr = "RHID";
		break;
}

$req = mysqli_query($mysqli, "SELECT * FROM ".$table." WHERE TID=".$tid." AND ".$attr."=".$rtid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$res = mysqli_query($mysqli, "DELETE FROM ".$table." WHERE TID=".$tid." AND ".$attr."=".$rtid);
header("location:tableauaffectationressource.php");
?>