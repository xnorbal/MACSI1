<?php
include("include/fonctions.php");

$types = array('humaine', 'logiciel', 'materiel');

if(empty($_GET['rid']) || empty($_GET['type']) || ! in_array($_GET['type'], $types)) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$ressourceid = mysqli_real_escape_string($mysqli, $_GET['rid']);
$type = mysqli_real_escape_string($mysqli, $_GET['type']);

if($type == "humaine") {
	$req = mysqli_query($mysqli, "SELECT * FROM RESSOURCEH WHERE ID=".$ressourceid);
}
elseif($type == "logiciel") {
	$req = mysqli_query($mysqli, "SELECT * FROM RESSOURCEL WHERE ID=".$ressourceid);
}
else {
	$req = mysqli_query($mysqli, "SELECT * FROM RESSOURCEM WHERE ID=".$ressourceid);
}

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

if($type == "humaine") {
	$res = mysqli_query($mysqli, "DELETE FROM RESSOURCEH WHERE ID=".$ressourceid);
}
elseif($type == "logiciel") {
	$res = mysqli_query($mysqli, "DELETE FROM RESSOURCEL WHERE ID=".$ressourceid);
}
else {
	$res = mysqli_query($mysqli, "DELETE FROM RESSOURCEM WHERE ID=".$ressourceid);
}
header("location:ressourcelist.php");
?>