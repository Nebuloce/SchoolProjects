<?php
	$link = mysqli_connect("localhost", "conn", "conn")
		or die("Access to db server denied");
	@mysqli_select_db($link, "course")
		or die("Access to course denied");

?>

