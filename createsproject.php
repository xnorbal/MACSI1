<?php
$mysqli = connect();
$res = mysqli_query($mysqli, "INSERT INTO SOUSPROJET(PID, PERIMETRE) VALUES(".$_POST['pid'].", '".$_POST['perimetre']."')");
header("location:sprojectlist.php?pid=".$_POST['pid']);
?>