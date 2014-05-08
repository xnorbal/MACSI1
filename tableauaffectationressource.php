<?php
include("include/fonctions.php");
$titre = "Tableau des affectations";
include("include/top.php");

$mysqli = connect();

$req1 = mysqli_query($mysqli, "SELECT TID, RHID, TXAFFECTATION  FROM TACHERH");

echo '<h2>Tableau des affectations</h2>';


echo '<table class="table">';
echo '<th>';
echo 'RESSOURCE';
echo '</th>';
echo '<th>';
echo 'TACHE';
echo '</th>';
echo '<th>';
echo 'TAUX D\'AFFECTATION';
echo '</th>';

	
echo '<tr>';
echo '<h3>Ressources Humaines</h3>';

while($row1 = mysqli_fetch_assoc($req1))
{
	$ressourceID = $row1['RHID'];
	$reqress = mysqli_query($mysqli, "SELECT INTITULE FROM RESSOURCEH WHERE ID=".$ressourceID);
	$my_ress_array = mysqli_fetch_assoc($reqress);
	$my_ress = $my_ress_array["INTITULE"];
	
	$tacheID = $row1['TID'];
	$reqtache = mysqli_query($mysqli, "SELECT OBJECTIF FROM TACHE WHERE ID=".$tacheID);
	$my_tache_array = mysqli_fetch_assoc($reqtache);
	$my_tache = $my_tache_array["OBJECTIF"];
	
	$txaffectation = $row1['TXAFFECTATION'];

	echo '<td>';
	echo ($my_ress);
	echo '</td>';
	echo '<td>';
	echo ($my_tache);
	echo '</td>';
	echo '<td>';
	echo ($txaffectation);
	echo '</td>';
	echo '</tr>';
}

$req2 = mysqli_query($mysqli, "SELECT TID, RLID, TXAFFECTATION  FROM TACHERL");
echo '<table class="table">';
echo '<th>';
echo 'RESSOURCE';
echo '</th>';
echo '<th>';
echo 'TACHE';
echo '</th>';
echo '<th>';
echo 'TAUX D\'AFFECTATION';
echo '</th>';
echo '<tr>';
echo '<h3>Ressources Logicielles</h3>';

while($row2 = mysqli_fetch_assoc($req2))
{
	$ressourceID = $row2['RLID'];
	$reqress = mysqli_query($mysqli, "SELECT INTITULE FROM RESSOURCEL WHERE ID=".$ressourceID);
	$my_ress_array = mysqli_fetch_assoc($reqress);
	$my_ress = $my_ress_array["INTITULE"];
	
	$tacheID = $row2['TID'];
	$reqtache = mysqli_query($mysqli, "SELECT OBJECTIF FROM TACHE WHERE ID=".$tacheID);
	$my_tache_array = mysqli_fetch_assoc($reqtache);
	$my_tache = $my_tache_array["OBJECTIF"];
	
	$txaffectation = $row2['TXAFFECTATION'];

	echo '<td>';
	echo ($my_ress);
	echo '</td>';
	echo '<td>';
	echo ($my_tache);
	echo '</td>';
	echo '<td>';
	echo ($txaffectation);
	echo '</td>';
	echo '</tr>';
}

$req3 = mysqli_query($mysqli, "SELECT TID, RMID, TXAFFECTATION  FROM TACHERM");
echo '<table class="table">';
echo '<th>';
echo 'RESSOURCE';
echo '</th>';
echo '<th>';
echo 'TACHE';
echo '</th>';
echo '<th>';
echo 'TAUX D\'AFFECTATION';
echo '</th>';
echo '<tr>';
echo '<h3>Ressources Materielles</h3>';

while($row3 = mysqli_fetch_assoc($req3))
{
	$ressourceID = $row3['RMID'];
	$reqress = mysqli_query($mysqli, "SELECT INTITULE FROM RESSOURCEM WHERE ID=".$ressourceID);
	$my_ress_array = mysqli_fetch_assoc($reqress);
	$my_ress = $my_ress_array["INTITULE"];
	
	$tacheID = $row3['TID'];
	$reqtache = mysqli_query($mysqli, "SELECT OBJECTIF FROM TACHE WHERE ID=".$tacheID);
	$my_tache_array = mysqli_fetch_assoc($reqtache);
	$my_tache = $my_tache_array["OBJECTIF"];
	
	$txaffectation = $row3['TXAFFECTATION'];

	echo '<td>';
	echo ($my_ress);
	echo '</td>';
	echo '<td>';
	echo ($my_tache);
	echo '</td>';
	echo '<td>';
	echo ($txaffectation);
	echo '</td>';
	echo '</tr>';
}






echo '</table>';
?>
<?php
include("include/bottom.php");
?>