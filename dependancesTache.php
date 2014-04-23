<?php

include("include/fonctions.php");
$titre = "Ajout de dépendances";

if(empty($_GET['tid'])) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$mysqli = connect();
$tid = mysqli_real_escape_string($mysqli, $_GET['tid']);
$req = mysqli_query( $mysqli, "SELECT * FROM TACHE WHERE ID=".$tid);

if(mysqli_num_rows($req) <= 0) {
	header("HTTP/1.0 404 Not Found");
	header("Location: error404.php");
}

$message='';


$tupleTache = mysqli_fetch_assoc($req);
$nomTache = stripslashes($tupleTache['OBJECTIF']);

$reqTache = mysqli_query($mysqli, 'SELECT * FROM chronotache, tache WHERE TID2 = ID AND TID1 = '.$tid);

$valeurHidden ='';
$listeTachesGraphique ='';

$listeTachesDejaAjoutes = array();

while($tuple = mysqli_fetch_assoc($reqTache)) {
	if($valeurHidden == '') {
		$valeurHidden .= $tuple['TID2'];
	}
	else {
		$valeurHidden .= '+separator+'.$tuple['TID2'];
	}
	$listeTachesGraphique .='<li class="label label-default" id="bijou'.$tuple['TID2'].'">'.$tuple['OBJECTIF'].' <span class="deleteCross" onclick="$(\'#bijou'.$tuple['TID2'].'\').remove(); majHiddenInputTaches('.$tuple['TID2'].');">X</span></li> ';
	array_push($listeTachesDejaAjoutes, $tuple['TID2']);
}

//Traitement du formulaire
if(!empty($_POST['envoyer']))
{
	//Informations du formulaire

	$tachesAjoutees = stripslashes($_POST['tachesAjoutees']);
	
	if(!empty($tachesAjoutees)){
	
			//Traitement des taches ajoutées: séparateur: +separator+
			$listeTachesAjoutes = explode( '+separator+', $tachesAjoutees );
			foreach($listeTachesAjoutes as $key => $val) {
				if(!in_array($val, $listeTachesDejaAjoutes)) {
					mysqli_query($mysqli, 'INSERT INTO chronotache VALUES('.$tid.', '.$val.')');
				}
				array_splice($listeTachesDejaAjoutes, array_search($val, $listeTachesDejaAjoutes), 1);
			}
			
			$reqDelete = 'DELETE FROM chronotache WHERE TID1 = '.$tid.' AND (';
			$i = 0;
			foreach ($listeTachesDejaAjoutes as $key => $value) {
				if($i == 0) {
					$reqDelete .= 'TID2='.$value;
				}
				else {
					$reqDelete .= ' OR TID2='.$value;
				}
				$i++;
			}
			$reqDelete .= ')';
			
			if(count($listeTachesDejaAjoutes) > 0) {
				mysqli_query($mysqli, $reqDelete);
			}
			unset($listeTachesDejaAjoutes);
		
			$message= 'Les dépendances ont bien été modifiées.';
			
			
			//Réévaluer la liste des taches
			$reqTache = mysqli_query($mysqli, 'SELECT * FROM chronotache, tache WHERE TID2 = ID AND TID1 = '.$tid);

			$valeurHidden ='';
			$listeTachesGraphique ='';

			$listeTachesDejaAjoutes = array();

			while($tuple = mysqli_fetch_assoc($reqTache)) {
				if($valeurHidden == '') {
					$valeurHidden .= $tuple['TID2'];
				}
				else {
					$valeurHidden .= '+separator+'.$tuple['TID2'];
				}
				$listeTachesGraphique .='<li class="label label-default" id="bijou'.$tuple['TID2'].'">'.$tuple['OBJECTIF'].' <span class="deleteCross" onclick="$(\'#bijou'.$tuple['TID2'].'\').remove(); majHiddenInputTaches('.$tuple['TID2'].');">X</span></li> ';
				array_push($listeTachesDejaAjoutes, $tuple['TID2']);
			}
	
	}
	else {
		$message= 'Les dépendances ont bien été modifiées.';
	}
} 

?>

<?php include("include/top.php"); ?>

		 <script>
			function majHiddenInputTaches(tid) {
				var listeTaches = document.getElementById("tachesAjoutees").value;
				var myArray = listeTaches.split("+separator+");
				document.getElementById("tachesAjoutees").value = "";
				var newValueInput = "";
				for (var i = 0; i < myArray.length; i++) {
					if(tid != myArray[i]) {
						if( newValueInput == "") {
							newValueInput += myArray[i];
						}
						else {
							newValueInput += "+separator+" + myArray[i];
						}
					}
				}
				document.getElementById("tachesAjoutees").value = newValueInput;
				if(newValueInput == '') {
					$("#listeTachesAjoutees").html('Aucune tâche ajoutée.');
				}
			};
		 
			$(document).ready(function(){
				$("#tags").autocomplete({
					source:'listeTachesAjax.php?tid=<?php echo $tid; ?>',
					minLength:1,
					select: function( event, ui ) {
						if($("#listeTachesAjoutees").text() == 'Aucune tâche ajoutée.') {
							$("#listeTachesAjoutees").html('');
						}
						
						if(!(document.getElementById("tachesAjoutees").value.indexOf(ui.item.id) >= 0)) {
							if(document.getElementById("tachesAjoutees").value == "") {
								document.getElementById("tachesAjoutees").value += ui.item.id;
							}
							else {
								document.getElementById("tachesAjoutees").value += "+separator+" + ui.item.id;
							}
							$("#listeTachesAjoutees").append('<li class="label label-default" id="tache'+ui.item.id+'">'+ui.item.value+' <span class="deleteCross" onclick="$(\'#tache'+ui.item.id+'\').remove(); majHiddenInputTaches('+ui.item.id+');">X</span></li> ');
						}
						else {
							alert('Vous avez déjà ajouté cette tache!');
						}
					}
				}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
				return $( "<li>" )
				.append( "<a>" + item.value + "</a>" )
				.appendTo( ul );
				};
			});
		</script>
		
		<h2>Ajouter une dépendance à la tâche <?php echo $tid; ?></h2>
			
			<?php echo $message; ?>
			
			 <form action="dependancesTache.php?tid=<?php echo $tid; ?>" method="post">
				 <div>
					<label for="tags">Ajouter des tâches prérequises:</label>
                    <div class="col-lg-9">
					 <input type="text" name="tags" class="form-control" id="tags" value="" onclick="this.value = '';" />
					 <input type="hidden" name="tachesAjoutees" class="form-control" id="tachesAjoutees" value="<?php echo($valeurHidden); ?>" />
                    </div>
                 </div>
				 <div>
					<label>Tâches pré-requises ajoutées:</label>
                    <ul id="listeTachesAjoutees"><?php echo($listeTachesGraphique); ?></ul>
                 </div>
				 <div>
                    <div>
						<input type="submit" name="envoyer" value="Valider les dépendances" class="button" />
                    </div>
                 </div>
			</form>
			
			<p>/!\ Attention à ne pas créer de dépendances circulaires!</p>

	<?php include("include/bottom.php"); ?>