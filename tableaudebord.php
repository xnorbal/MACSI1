<?php
include("include/fonctions.php");
$titre = "Tableau de bord";
include("include/top.php");

if(empty($_GET['pid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$pid = mysqli_real_escape_string($mysqli, $_GET['pid']);

$req = mysqli_query($mysqli, "SELECT * FROM PROJET WHERE ID=".$pid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$row = mysqli_fetch_assoc($req);
$intituleProjet = stripslashes($row['INTITULE']);
$perimetreProjet = stripslashes($row['PERIMETRE']);

$titre = "Tableau de bord du projet : ".$intituleProjet;

//$req = mysqli_query($mysqli, "SELECT OBJECTIF, JH_PREVU, JH_PRIS FROM TACHE WHERE LID IN(SELECT ID FROM LOT WHERE SPID IN(SELECT ID FROM SOUSPROJET WHERE PID IN(SELECT ID FROM PROJET WHERE ID=".$pid.")))");
$req = mysqli_query($mysqli, "SELECT ID, INTITULE FROM SOUSPROJET WHERE PID=".$pid);
echo '<h2>'.$titre.'</h2>';
echo '<h3>Tâches</h3>';

echo '<table class="table">';
echo '<th>';
echo 'SOUS PROJET';
echo '</th>';
echo '<th>';
echo 'LOT';
echo '</th>';
echo '<th>';
echo 'TACHE';
echo '</th>';
echo '<th>';
echo 'COMPLETION';
echo '</th>';
while($row = mysqli_fetch_assoc($req))
{
	$spid = stripslashes($row['ID']);
	$spintitule = stripslashes($row['INTITULE']);
	$reqsp = mysqli_query($mysqli, "SELECT ID, PERIMETRE FROM LOT WHERE SPID=".$pid);
	$reqspnb = mysqli_query($mysqli, "SELECT * FROM TACHE WHERE LID IN(SELECT ID FROM LOT WHERE SPID=".$pid.")");
	$nbtaches = mysqli_num_rows($reqspnb);
	$nblots = mysqli_num_rows($reqsp);
	$nblignes = $nbtaches+2*$nblots+2;
	echo '<tr>';
	echo '<td rowspan="'.$nblignes.'">';
	echo ($spintitule);
	echo '</td>';
	echo '</tr>';
	$sppris = 0;
	$spprevu = 0;
	while($rowsp = mysqli_fetch_assoc($reqsp))
	{
		$lid = stripslashes($rowsp['ID']);
		$lperimetre = stripslashes($rowsp['PERIMETRE']);
		$reql = mysqli_query($mysqli, "SELECT OBJECTIF, JH_PREVU, JH_PRIS FROM TACHE WHERE LID=".$lid);
		$lots = mysqli_num_rows($reql);
		$lignes = $lots+2;
		
		echo '<tr>';
		echo '<td rowspan="'.$lignes .'" >';
		echo $lperimetre;
		echo '</td>';
		echo '</tr>';
		$lpris = 0;
		$lprevu = 0;
		while($rowl = mysqli_fetch_assoc($reql))
		{
			$tobjectif = stripslashes($rowl['OBJECTIF']);
			$tpris = stripslashes($rowl['JH_PRIS']);
			$tprevu = stripslashes($rowl['JH_PREVU']);
			
			echo '<tr>';
			echo '<td>';
			echo ($tobjectif);
			echo '</td>';
			echo '<td>';
			echo ($tpris/$tprevu*100 ."%");
			echo '</td>';
			echo '</tr>';
			
			$sppris += $tpris;
			$spprevu += $tprevu;
			$lpris += $tpris;
			$lprevu += $tprevu;
		}
		echo '<tr>';
		echo '<td>';
		echo 'avancement';
		echo '</td>';
		echo '<td>';
		echo ($lpris/$lprevu*100 ."%");
		echo '</td>';
		echo '</tr>';
	}
	echo '<tr>';
	echo '<td colspan="2">';
	echo 'avancement';
	echo '</td>';
	echo '<td>';
	echo ($sppris/$spprevu*100 ."%");
	echo '</td>';
	echo '</tr>';
}
echo '</table>';

$reqTaches = mysqli_query($mysqli, 'SELECT * FROM TACHE WHERE LID IN(SELECT ID FROM LOT WHERE SPID IN (SELECT ID FROM sousprojet WHERE PID = '.$pid.')) ORDER BY DATEDEBUT');

$data = array();

while($row = mysqli_fetch_assoc($reqTaches))
{
	$label = stripslashes($row['OBJECTIF']);
	$start = stripslashes($row['DATEDEBUT']);
	$end = stripslashes($row['DATEFIN']);

	$data[] = array(
	  'label' => $label,
	  'start' => $start, 
	  'end'   => $end
	);
}

require('lib/gantti.php'); 

date_default_timezone_set('UTC');
setlocale(LC_ALL, 'en_US');

$gantti = new Gantti($data, array(
  'title'      => $intituleProjet,
  'cellwidth'  => 27,
  'cellheight' => 35,
  'today'      => true
));

echo $gantti;

?>
<?php
include("include/bottom.php");
?>