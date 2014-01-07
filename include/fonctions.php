<?php

function connect() {
	$mysqli = mysqli_connect('localhost', 'root', '', 'macsi1');
	return $mysqli;
}

function datefrToEn($date) { 
$split = explode("/",$date); 
$jour = $split[0]; 
$mois = $split[1]; 
$annee = $split[2]; 
return "$mois"."/"."$jour"."/"."$annee"; 
}

function formatTimestampToDateSQL($timestamp) {  
return date("Y-m-d",$timestamp); 
} 

?>