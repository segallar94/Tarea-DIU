<?php
	$user 	= $_GET['username'];
	$id 	= $_GET['id'];

	$value = json_decode(file_get_contents("data/$id/" . $user . ".txt"));
	echo json_encode($value);
?>