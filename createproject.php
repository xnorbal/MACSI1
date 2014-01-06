<?php
$mysqli = connect();
$res = mysqli_query($mysqli, "INSERT INTO PROJET(INTITULE, PERIMETRE) VALUES('".$_POST['intitule']."', '".$_POST['perimetre']."')");
header("location:projectlist.php");
?>