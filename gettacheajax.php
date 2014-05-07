<?php

include("include/fonctions.php");

$mysqli = connect();

if(isset($_GET['pid'])) {
	$pid = mysqli_real_escape_string($mysqli, $_GET['pid']);
	
	$req = mysqli_query($mysqli, "SELECT ID, OBJECTIF FROM TACHE WHERE LID IN(SELECT ID FROM LOT WHERE SPID IN(SELECT ID FROM SOUSPROJET WHERE PID IN(SELECT ID FROM PROJET WHERE ID=".$pid.")))");
	echo '<td>';
	echo '<label for="task">Tache : </label>';
	echo '</td>';
	echo '<td>';
	echo '<select name="task" id="task">';
	while($row = mysqli_fetch_array($req)) {
		$id=stripslashes($row['ID']);
		$obj=stripslashes($row['OBJECTIF']);
		echo '<option value="'.$id.'">';
		echo $obj;
		echo '</option>';
	}
	echo '</select>';
	echo '<td>';
}

?>