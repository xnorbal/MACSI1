<?php

include("include/fonctions.php");

$mysqli = connect();

// si on reçoit une donnée
if(isset($_GET['term'])) {
    $q = mysqli_real_escape_string($mysqli,$_GET['term']); // protection
	$tid = mysqli_real_escape_string($mysqli,$_GET['tid']);
	
	 $reqProjet = 'SELECT ID FROM projet WHERE ID IN (SELECT PID FROM sousprojet WHERE ID IN(SELECT SPID FROM lot WHERE ID IN(SELECT LID FROM tache WHERE ID = '.$tid.')))';
     $numeroProjetRes = mysqli_query($mysqli,$reqProjet);
	 $numeroProjet = mysqli_fetch_assoc($numeroProjetRes);
	 $numeroProj = $numeroProjet['ID'];
	
    // écriture de la requête
    $reqTaches = 'SELECT * FROM TACHE WHERE OBJECTIF LIKE \'%'. $q .'%\' AND LID IN(SELECT ID FROM LOT WHERE SPID IN (SELECT ID FROM sousprojet WHERE PID = '.$numeroProj.')) LIMIT 0, 10';
   // exécution de la requête
    $resultat = mysqli_query($mysqli,$reqTaches);
	
	if(mysqli_num_rows($resultat) > 0) {
		$json=array();

		while($tache=mysqli_fetch_array($resultat)){
			 $json[]=array(
						'value'=> $tache["OBJECTIF"],
						'label'=>$tache["OBJECTIF"],
						'id'=>$tache["ID"]
							);
		}
	 
		echo json_encode($json);
	}
}
?>