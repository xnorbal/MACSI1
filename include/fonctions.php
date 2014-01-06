<?php

function connect() {
	$mysqli = mysqli_connect('localhost', 'root', '', 'macsi1');
	return $mysqli;
}

?>