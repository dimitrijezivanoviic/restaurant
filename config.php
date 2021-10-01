<?php
	$conn = new mysqli("localhost","root","","food-order");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>