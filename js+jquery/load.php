<?php
	$id 	= $_GET['id'];

	$users 	= scandir("data/$id");
	$data 	= array();

	foreach ($users as $key => $value) {
		if(!in_array($value, array(".",".."))) {
			$data[str_replace(".txt", "", $value)] = json_decode(file_get_contents("data/$id/$value"));
		}
	}

	echo json_encode($data);
?>