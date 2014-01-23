<?php
include("include/fonctions.php");
$mysqli = connect();
$res = mysqli_query($mysqli, "INSERT INTO SOUSPROJET(PID, INTITULE, PERIMETRE) VALUES(".$_POST['pid'].", ".$_POST['intitule']." , ".$_POST['perimetre'].")");
header("location:projectdetails.php?pid=".$_POST['pid']);

?>