<?php
	$schedule 	= $_POST['schedule'];
	$name 		= $_POST['name'];
	$id 		= $_GET['id'];

	if(!file_exists("data/$id"))
		mkdir("data/$id");
	
	$file = fopen("data/$id/" . $name . ".txt", "w+");
	fwrite($file, $schedule);
	fclose($file);

	header('Location: index.html?success=1');
?>