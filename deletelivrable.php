<?php
include("include/fonctions.php");

if(empty($_GET['livrableid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$livrableid = mysqli_real_escape_string($mysqli, $_GET['livrableid']);
$req = mysqli_query($mysqli, "SELECT * FROM LIVRABLE WHERE ID=".$livrableid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$lid = stripslashes($row['LID']);
$fichierLivrable = stripslashes($row['FICHIER']);

$res = mysqli_query($mysqli, "DELETE FROM LIVRABLE WHERE ID=".$livrableid);
unlink($fichierLivrable);

header("location:lotsdetails.php?lid=".$lid);
?>