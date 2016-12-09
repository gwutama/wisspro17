<?php
     
    $gaSql['user']       = "impl";
    $gaSql['password']   = "impl2016";
    $gaSql['db']         = "impl_";
    $gaSql['server']     = "localhost";
	
	$conn = mysqli_connect($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'] );
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

?>